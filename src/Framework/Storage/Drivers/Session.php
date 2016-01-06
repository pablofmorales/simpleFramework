<?php

namespace Framework\Storage\Drivers;

class Session
{
    const STORAGE_NAME = 'storage';

    public function fetchAll($name)
    {
        return $_SESSION[self::STORAGE_NAME][$name];
    }

    public function insert($name, $data)
    {
        $_SESSION[self::STORAGE_NAME][$name][] = $data;
        return true;
    }
}
