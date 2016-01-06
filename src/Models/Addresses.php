<?php

namespace Models;

class Addresses
{
    const HARDCODED_CSV = 'data/addresses.csv';
    private $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function import()
    {

        $file = fopen(self::HARDCODED_CSV, 'r');
        $i = 0;
        while (($line = fgetcsv($file)) !== FALSE) {
            $this->storage->insert('addresses', [
                "name" => $line[0],
                "phone" => $line[1],
                "street" => $line[2]
            ]);
            $i ++;
        }

        fclose($file);

        return $i;
    }
}
