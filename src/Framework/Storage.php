<?php

namespace Framework;

class Storage
{

    private $adapter;

    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    public function insert($name, $data)
    {
        return $this->adapter->insert($name, $data);
    }

    public function fetchAll($name)
    {
        return $this->adapter->fetchAll($name);
    }
}
