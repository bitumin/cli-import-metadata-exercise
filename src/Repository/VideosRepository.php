<?php

namespace VideoShare\Repository;

/**
 * Class VideosRepository
 * @package VideoShare\Repository
 */
class VideosRepository
{
    protected $persistence;

    /**
     * VideoRepository constructor.
     * @param $persistence
     */
    public function __construct(Storage $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * @param $id
     * @return Video
     * @throws \Exception
     */
    public function findById($id)
    {
        $dataArray = $this->persistence->retrieve($id);

        if (false === $dataArray) {
            throw new \Exception(sprintf('Video with ID %d does not exist.', $id));
        }

        return Video::getVideoInstance($dataArray);
    }

    /**
     * @param Video $video
     * @return mixed
     * @throws \Exception
     */
    public function save(Video $video)
    {
        $id = $this->persistence->persist([
            'tags' => $video->getTags(),
            'title' => $video->getTitle(),
            'url' => $video->getUrl()
        ]);

        if (false === $id) {
            throw new \Exception('Unable to save video.');
        }

        return $id;
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function delete($id)
    {
        if (!$this->persistence->delete($id)) {
            throw new \Exception(sprintf("Couldn't delete video with ID %d.", $id));
        }
    }
}
