<?php

namespace VideoShare\Parse;

/**
 * Class ParseHandler
 * @package VideoShare\Parse
 */
abstract class ParseHandler
{
    /**
     * @var ParseHandler
     */
    protected $successor;

    /**
     * @param ParseHandler|null $handler
     */
    public function setSuccessor(ParseHandler $handler = null)
    {
        $this->successor = $handler;
    }

    /**
     * @param $parseData
     * @param $rawContent
     * @return mixed
     */
    final public function parse($parseData, $rawContent)
    {
        $parsed = $this->doParse($parseData, $rawContent);

        if (null === $parsed && null !== $this->successor) {
            $parsed = $this->successor->parse($parseData, $rawContent);
        }

        return $parsed;
    }

    /**
     * @param $parseData
     * @param $rawContent
     * @return mixed
     */
    abstract public function doParse($parseData, $rawContent);
}
