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
        $data['id'] = $this->getNextId($name);
        $_SESSION[self::STORAGE_NAME][$name][] = $data;
        return true;
    }

    private function getNextId($name)
    {
        $current = $this->getLastId($name);
        return ++ $current;
    }

    private function getLastId($name)
    {
        if (! isset($_SESSION[self::STORAGE_NAME][$name])) {
            return 0;
        }

        $lastRow = \end($_SESSION[self::STORAGE_NAME][$name]);

        return $lastRow['id'];

    }
}
