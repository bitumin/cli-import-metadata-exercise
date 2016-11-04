<?php

namespace VideoShare\Parse;

/**
 * Class Json
 * @package VideoShare\Parse
 */
class Json extends ParseHandler
{
    /**
     * @param $parseData
     * @param $rawContent
     * @return mixed|null
     */
    public function doParse($parseData, $rawContent)
    {
        if ($parseData['type'] === 'json') {
            return $this->decodeJson($rawContent);
        }

        return null;
    }

    /**
     * @param $rawContent
     * @return mixed
     */
    protected function decodeJson($rawContent)
    {
        return json_decode($rawContent, true);
    }
}
