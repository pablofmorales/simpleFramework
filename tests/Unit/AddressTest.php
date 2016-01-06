<?php

class AddressTest extends \PHPUnit_Framework_TestCase
{

    public function testImportCSVShouldReturnOk()
    {

        $expected = ['processed' => 4];

        $storage = $this->getMockBuilder('Framework\Storage')
            ->disableOriginalConstructor()
            ->getMock();

        $storage->method('insert')
            ->willReturn(true);

        $addressModel = new \AddressModelDummy($storage);

        $address = new Controllers\Addresses($addressModel);

        $response = $address->importFromCSV();
        $this->assertEquals(\json_encode($expected), $response);

    }
}


class AddressModelDummy extends Models\Addresses
{

    public function __construct($storage)
    {
         parent::__construct($storage);
         $this->hardcodedCSV = 'data/addresses.csv';
    }

}
