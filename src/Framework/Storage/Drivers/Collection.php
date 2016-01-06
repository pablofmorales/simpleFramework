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
        $index = $this->getIndex($name);
        $this->collection[$name][$index] = $data;
        return true;
    }

    private function getIndex($name)
    {
        if (! isset($this->collection[$name])) {
            return 1;
        }
        $elements = count($this->collection[$name]);

        return ++ $elements;
    }

    public function fetch($name, $id)
    {
        return $this->collection[$name][$id];
    }
}
