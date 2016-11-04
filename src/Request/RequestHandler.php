<?php

namespace VideoShare\Request;

/**
 * Class RequestHandler
 * @package VideoShare\Request
 */
abstract class RequestHandler
{
    /**
     * @var RequestHandler
     */
    protected $successor;

    /**
     * @param RequestHandler|null $handler
     */
    public function setSuccessor(RequestHandler $handler = null)
    {
        $this->successor = $handler;
    }

    /**
     * @param $requestData
     * @return mixed
     */
    final public function fetchResponse($requestData)
    {
        $fetched = $this->doRequest($requestData);

        if (null === $fetched && null !== $this->successor) {
            $fetched = $this->successor->fetchResponse($requestData);
        }

        return $fetched;
    }

    /**
     * @param $requestData
     * @return mixed
     */
    abstract public function doRequest($requestData);
}
