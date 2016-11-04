<?php

namespace VideoShare\Repository;

/**
 * Class FakeDBDriver
 * @package VideoShare\Repository
 */
class FakeDriver
{
    private $id;

    /**
     * FakeDriver constructor.
     * @param null $host
     * @param null $username
     * @param null $passwd
     * @param null $dbname
     */
    public function __construct($host = null, $username = null, $passwd = null, $dbname = null)
    {
        $this->id = 0;
    }

    /**
     * Returns an increment by 1 integer
     * @return int
     */
    public function getAutoincrementId()
    {
        return ++$this->id;
    }

    /**
     * Emulates a select by id statement
     * @param $id
     * @return array
     */
    public function selectWhenIdEquals($id)
    {
        return [
            'id' => $id,
            'labels' => 'dogs, cats, cute',
            'name' => 'cute dogs and cats',
            'url' => 'http://some.video.com/dogs-and-cats'
        ];
    }

    /**
     * Emulates an insert statement
     * @param $data
     * @return int
     */
    public function insert($data)
    {
        return $this->getAutoincrementId();
    }

    /**
     * Emulates a delete statement
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return true;
    }
}
