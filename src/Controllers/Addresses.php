<?php

namespace Controllers;

class Addresses
{

    private $address;

    public function __construct($address)
    {
        $this->address = $address;
    }

    public function getById($request)
    {
        $id = $request->getValues['id'];

        $response = $this->address->fetchById($id);

        return \json_encode($response);
    }

    public function importFromCSV()
    {
        $processed = $this->address->import();

        return \json_encode([
            'processed' => $processed
        ]);
    }
}

