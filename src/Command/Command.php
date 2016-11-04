<?php

namespace VideoShare\Command;

/**
 * Class Command
 * @package VideoShare\Command
 */
abstract class Command
{
    /**
     * @var InputInterface
     */
    protected $input;
    /**
     * @var OutputInterface
     */
    protected $output;
    /**
     * @var array|mixed
     */
    protected $config;

    /**
     * Command constructor.
     * @param array $cmdConfig
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct($cmdConfig, InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->config = $cmdConfig;
    }

    /**
     * Run command.
     */
    abstract public function execute();
}
