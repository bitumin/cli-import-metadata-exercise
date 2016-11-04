<?php

namespace VideoShare\Parse;

/**
 * Class Yaml
 * @package VideoShare\Parse
 */
class Yaml extends ParseHandler
{
    /**
     * @param $parseData
     * @param $rawContent
     * @return mixed|null
     */
    public function doParse($parseData, $rawContent)
    {
        if ($parseData['type'] === 'yaml') {
            return $this->parseYaml($rawContent);
        }

        return null;
    }

    /**
     * @param $rawContent
     * @return mixed
     * @throws \Symfony\Component\Yaml\Exception\ParseException
     */
    protected function parseYaml($rawContent)
    {
        return \Symfony\Component\Yaml\Yaml::parse($rawContent);
    }
}
