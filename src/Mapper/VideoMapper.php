<?php

namespace VideoShare\Mapper;

/**
 * Class VideoMapper
 * @package VideoShare\Mapper
 */
class VideoMapper
{
    /**
     * @var string|null
     */
    protected $parentKey;
    /**
     * @var array
     */
    protected $fieldsMap;

    /**
     * VideoMapper constructor.
     * @param $mapConfig
     */
    public function __construct($mapConfig)
    {
        $this->parentKey = isset($mapConfig['parent_key']) ? $mapConfig['parent_key'] : null;
        $this->fieldsMap = $mapConfig['fields'];
    }

    /**
     * @param array $unmappedFields
     * @return array
     */
    public function map($unmappedFields)
    {
        /** @var array $rawVideoList */
        $rawVideoList = null !== $this->parentKey ? $unmappedFields[$this->parentKey] : $unmappedFields;
        $videoList = [];
        foreach ($rawVideoList as $key => $video) {
            foreach ($this->fieldsMap as $originalName => $targetName) {
                $videoList[$key][$targetName] = isset($video[$originalName]) ? $video[$originalName] : '';
            }
        }

        return $videoList;
    }
}
