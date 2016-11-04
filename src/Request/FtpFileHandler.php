<?php

namespace VideoShare\Request;

/**
 * Class FtpFileHandler
 * @package VideoShare\Request
 */
class FtpFileHandler extends RequestHandler
{
    /**
     * @param $requestData
     * @return mixed|null
     */
    public function doRequest($requestData)
    {
        if ($requestData['type'] === 'ftp_file') {
            return $this->ftpFileGetContents($requestData);
        }

        return null;
    }

    /**
     * @param $requestData
     * @return mixed
     */
    protected function ftpFileGetContents($requestData)
    {
        return file_get_contents(
            'ftps://' .
            $requestData['ftp_user'] . ':' .
            $requestData['ftp_password'] . '@' .
            $requestData['ftp_server'] .
            $requestData['remote_file']
        );
    }
}
