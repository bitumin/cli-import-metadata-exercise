<?php

namespace VideoShare\Command;

use VideoShare\Mapper\VideoMapper;
use VideoShare\Parse\Json;
use VideoShare\Parse\ParseClient;
use VideoShare\Parse\Yaml;
use VideoShare\Repository\MySQL;
use VideoShare\Repository\Video;
use VideoShare\Repository\VideosRepository;
use VideoShare\Request\FtpFileHandler;
use VideoShare\Request\LocalFileHandler;
use VideoShare\Request\RequestClient;

/**
 * Class ImportCommand
 * @package VideoShare\Command
 */
class ImportCommand extends Command
{
    /**
     * Run import command.
     * @internal param array $videoFeed
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $site = $this->input->getFirstArgument();

            // validate site
            if (!$this->siteIsValid($site)) {
                $this->output->callExit();
            }

            $siteConfig = $this->getSiteConfiguration($site);

            // obtain the video feed
            $requestClient = new RequestClient($this->getRequestHandlers());
            $rawVideoFeed = $requestClient->handleRequest($siteConfig['request']);

            // validate raw video feed
            if (null === $rawVideoFeed) {
                $this->output->callExit();
            }

            // parse the video feed
            $parseClient = new ParseClient($this->getResponseParsers());
            $parsedVideoFeed = $parseClient->handleParse($siteConfig['parse'], $rawVideoFeed);

            // translate parsed fields to storage-ready video fields
            $videoMapper = new VideoMapper($siteConfig['map']);
            $videoFeed = $videoMapper->map($parsedVideoFeed);

            // save the feed in some persistent data storage
            $videosRepository = new VideosRepository(new MySQL());
            foreach ($videoFeed as $video) {
                $Video = Video::getVideoInstance($video);
                if ($videosRepository->save($Video)) {
                    $this->output->write($Video);
                }
            }
        } catch (\Exception $e) {
            $this->output->error('Import exited with code 1');
        }
    }

    /**
     * @return array
     */
    protected function getAllowedSites()
    {
        return array_keys($this->config['sites']);
    }

    /**
     * @param $site
     * @return bool
     */
    protected function siteIsValid($site)
    {
        if (null === $site) {
            $this->output->error('Required site parameter is missing');

            return false;
        }

        if (!in_array($site, $this->getAllowedSites(), true)) {
            $this->output
                ->error('Unknown site provided. List of allowed sites: ' . implode(', ', $this->getAllowedSites()));

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    protected function getRequestHandlers()
    {
        return [
            new FtpFileHandler(),
            new LocalFileHandler()
        ];
    }

    /**
     * @return array
     */
    protected function getResponseParsers()
    {
        return [
            new Yaml(),
            new Json()
        ];
    }

    /**
     * @param $site
     * @return array
     */
    protected function getSiteConfiguration($site)
    {
        return $this->config['sites'][$site];
    }
}
