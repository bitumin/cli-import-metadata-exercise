<?php

namespace VideoShare\Request;

/**
 * Class RequestClient
 * @package VideoShare\Request
 */
class RequestClient
{
    /**
     * @var RequestHandler
     */
    private $firstHandler;

    /**
     * Client constructor.
     * @param array $handlers
     */
    public function __construct($handlers)
    {
        $this->setChainOfRequests($handlers);
    }

    /**
     * @param array $handlers
     */
    protected function setChainOfRequests($handlers)
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
     * @param $requestData
     * @return mixed
     */
    public function handleRequest($requestData)
    {
        return $this->firstHandler->fetchResponse($requestData);
    }
}
