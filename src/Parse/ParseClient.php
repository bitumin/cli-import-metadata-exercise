<?php

namespace VideoShare\Parse;

/**
 * Class ParseClient
 * @package VideoShare\Parse
 */
class ParseClient
{
    /**
     * @var ParseHandler
     */
    private $firstHandler;

    /**
     * ParseClient constructor.
     * @param array $handlers
     */
    public function __construct($handlers)
    {
        $this->setChainOfParsers($handlers);
    }

    /**
     * @param array $handlers
     */
    protected function setChainOfParsers($handlers)
    {
        $this->firstHandler = $handlers[0];

        $nHandlers = count($handlers);
        foreach ($handlers as $key => $handler) {
            if ($key + 1 < $nHandlers) {
                $handler->setSuccessor($handlers[$key + 1]);
            }
        }
    }

    /**
     * @param $parseData
     * @param $rawContent
     * @return mixed
     */
    public function handleParse($parseData, $rawContent)
    {
        return $this->firstHandler->parse($parseData, $rawContent);
    }
}
