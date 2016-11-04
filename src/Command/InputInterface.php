<?php

namespace VideoShare\Command;

/**
 * Interface InputInterface
 * @package VideoShare\Command
 */
interface InputInterface
{
    public function getArgument($position);
    public function getFirstArgument();
}
