<?php

namespace VideoShare\Repository;

/**
 * Class MySQL
 * @package VideoShare\Repository
 */
class MySQL implements Storage
{
    private $mysqli;

    /**
     * MySQL constructor.
     */
    public function __construct()
    {
        $this->mysqli = new FakeDriver();
    }

    /**
     * @param $data
     * @return int
     */
    public function persist($data)
    {
        return $this->mysqli->insert($data);
    }

    /**
     * @param $id
     * @return Video
     */
    public function retrieve($id)
    {
        $data = $this->mysqli->selectWhenIdEquals($id);

        return Video::getVideoInstance($data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->mysqli->delete($id);
    }
}
