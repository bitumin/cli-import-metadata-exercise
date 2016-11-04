<?php

namespace VideoShare\Command;

/**
 * Class Output
 * @package VideoShare\Command
 */
class StreamOutput implements OutputInterface
{
    private $stream;

    /**
     * Output constructor.
     */
    public function __construct()
    {
        $this->stream = $this->setStream();
    }

    /**
     * @return resource
     */
    protected function setStream()
    {
        return fopen('php://output', 'w');
    }

    /**
     * @param $message
     */
    public function write($message)
    {
        @fwrite($this->stream, $message);
        @fwrite($this->stream, PHP_EOL);
        fflush($this->stream);
    }

    /**
     * @param $message
     */
    public function error($message)
    {
        $this->write('Error: ' . $message);
    }

    public function callExit()
    {
        exit();
    }
}
