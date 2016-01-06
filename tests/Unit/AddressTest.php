<?php

class AddressTest extends \PHPUnit_Framework_TestCase
{

    public function testImportCSVShouldReturnOk()
    {

        $expected = ['processed' => 4];

        $storage = new \StorageDummy();

        $addressModel = new Models\Addresses($storage);

        $address = new Controllers\Addresses($addressModel);

        $response = $address->importFromCSV();
        $this->assertEquals(\json_encode($expected), $response);

    }
}


class StorageDummy
{

    public function insert()
    {

        return true;
    }
}
