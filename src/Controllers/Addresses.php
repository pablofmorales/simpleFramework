<?php

namespace Controllers;

class Addresses
{

    private $address;

    public function __construct($address)
    {
        $this->address = $address;
    }

    public function importFromCSV()
    {
        $processed = $this->address->import();

        return \json_encode([
            'processed' => $processed
        ]);
    }
}

