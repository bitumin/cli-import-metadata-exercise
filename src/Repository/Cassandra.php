<?php

namespace VideoShare\Repository;

/**
 * Class Cassandra
 * @package VideoShare\Repository
 */
class Cassandra implements Storage
{
    private $cluster;

    /**
     * MySQL constructor.
     */
    public function __construct()
    {
        $this->cluster = new FakeDriver();
    }

    /**
     * @param $data
     * @return int
     */
    public function persist($data)
    {
        return $this->cluster->insert($data);
    }

    /**
     * @param $id
     * @return Video
     */
    public function retrieve($id)
    {
        $data = $this->cluster->selectWhenIdEquals($id);

        return Video::getVideoInstance($data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->cluster->delete($id);
    }
}
