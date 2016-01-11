<?php

namespace Framework\Storage\Drivers;

class Session
{
    const STORAGE_NAME = 'storage';

    public function fetchAll($name)
    {
        return $_SESSION[self::STORAGE_NAME][$name];
    }

    public function fetch($name, $id)
    {
        if (! isset($_SESSION[self::STORAGE_NAME])
            || count($_SESSION[self::STORAGE_NAME][$name]) < $id) {
            return [];
        }
        return $_SESSION[self::STORAGE_NAME][$name][$id];
    }

    public function insert($name, $data)
    {
        $index = $this->getIndex($name);
        $_SESSION[self::STORAGE_NAME][$name][$index] = $data;
        return true;
    }

    private function getIndex($name)
    {
        if (! isset($_SESSION[self::STORAGE_NAME][$name])) {
            return 1;
        }

        $elements = count($_SESSION[self::STORAGE_NAME][$name]);
        return ++ $elements;
    }

}
