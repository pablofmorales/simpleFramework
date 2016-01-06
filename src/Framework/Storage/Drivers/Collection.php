<?php

namespace Framework\Storage\Drivers;

class Collection
{
    private $collection = [];

    public function fetchAll($name)
    {
        return $this->collection[$name];
    }

    public function insert($name, $data)
    {
        $this->collection[$name][] = $data;
        return true;
    }
}
