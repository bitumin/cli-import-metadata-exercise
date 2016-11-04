<?php

namespace VideoShare\Repository;

/**
 * Interface Storage
 * @package VideoShare\Repository
 */
interface Storage
{
    public function persist($data);
    public function retrieve($id);
    public function delete($id);
}
