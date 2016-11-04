<?php

namespace VideoShare\Request;

/**
 * Class LocalFileHandler
 * @package VideoShare\Request
 */
class LocalFileHandler extends RequestHandler
{
    /**
     * @param $requestData
     * @return mixed|null
     */
    public function doRequest($requestData)
    {
        if ($requestData['type'] === 'local_file') {
            return $this->localFileGetContents($requestData);
        }

        return null;
    }

    /**
     * @param $requestData
     * @return mixed
     */
    protected function localFileGetContents($requestData)
    {
        $file = $requestData['base'] . $requestData['filename'];
        if (file_exists($file)) {
            return file_get_contents($file);
        }

        return false;
    }
}
