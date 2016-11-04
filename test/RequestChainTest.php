<?php

namespace VideoShare\Tests;

use VideoShare\Request\FtpFileHandler;
use VideoShare\Request\LocalFileHandler;
use VideoShare\Request\RequestClient;

class RequestChainTest extends \PHPUnit_Framework_TestCase
{
    public function testFtpFileHandlerHandlesLocalFileRequest()
    {
        $mockedFtpRequestHandler = $this->getMockBuilder(FtpFileHandler::class)
            ->setMethods(['ftpFileGetContents'])
            ->getMock();

        $mockedFtpRequestHandler
            ->expects($this->once())
            ->method('ftpFileGetContents')
        ->will($this->returnValue('file contents'));

        $handlersChain = new RequestClient([
            new LocalFileHandler(),
            new LocalFileHandler(),
            new LocalFileHandler(),
            $mockedFtpRequestHandler,
            new LocalFileHandler(),
            $mockedFtpRequestHandler
        ]);
        $handlersChain->handleRequest(['type' => 'ftp_file']);
    }

    public function testLocalFileHandlerHandlesLocalFileRequest()
    {
        $mockedLocalFileRequestHandler = $this->getMockBuilder(LocalFileHandler::class)
            ->setMethods(['localFileGetContents'])
            ->getMock();

        $mockedLocalFileRequestHandler
            ->expects($this->once())
            ->method('localFileGetContents')
            ->will($this->returnValue('file contents'));

        $handlersChain = new RequestClient([
            $mockedLocalFileRequestHandler,
            new FtpFileHandler(),
            new FtpFileHandler(),
            new FtpFileHandler(),
            $mockedLocalFileRequestHandler
        ]);
        $handlersChain->handleRequest(['type' => 'local_file']);
    }
}
