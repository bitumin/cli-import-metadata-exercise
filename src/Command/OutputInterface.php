<?php

namespace VideoShare\Command;

/**
 * Interface OutputInterface
 * @package VideoShare\Command
 */
interface OutputInterface
{
    public function write($message);
    public function error($message);
    public function callExit();
}
