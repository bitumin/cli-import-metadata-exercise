<?php

namespace VideoShare\Command;

/**
 * Class Input
 * @package VideoShare\Command
 */
class ArgvInput implements InputInterface
{
    protected $arguments = [];

    /**
     * Input constructor.
     */
    public function __construct()
    {
        $argv = $_SERVER['argv'];

        // strip the application name
        array_shift($argv);

        $this->setArguments($argv);
    }

    /**
     * @param $args
     */
    protected function setArguments($args)
    {
        $this->arguments = (array) $args;
    }

    /**
     * @param $position
     * @return mixed|null
     */
    public function getArgument($position)
    {
        return isset($this->arguments[$position]) ? $this->arguments[$position] : null;
    }

    /**
     * @return mixed|null
     */
    public function getFirstArgument()
    {
        return $this->getArgument(0);
    }
}
