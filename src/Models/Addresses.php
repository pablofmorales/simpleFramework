<?php

namespace Models;

class Addresses
{
    protected $hardcodedCSV;
    private $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
        $this->hardcodedCSV = '../data/addresses.csv';
    }

    public function import()
    {

        $file = fopen($this->hardcodedCSV, 'r');
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
