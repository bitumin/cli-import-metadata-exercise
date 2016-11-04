<?php

namespace VideoShare\Command;

/**
 * Class CliApp
 * @package VideoShare\Command
 */
class App
{
    /**
     * @var Command $command
     */
    private $command;

    /**
     * Set command
     * @param Command $cmd
     */
    public function setCommand(Command $cmd)
    {
        $this->command = $cmd;
    }

    /**
     * Run command
     */
    public function run()
    {
        $this->command->execute();
    }
}
