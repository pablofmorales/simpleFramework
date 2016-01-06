<?php

class Collection extends \PHPUnit_Framework_TestCase
{

    public function testTryToInsertReturnTrue()
    {
        $expected = ['test' => 1];
        $driver = new Framework\Storage\Drivers\Collection();
        $storage = new Framework\Storage($driver);
        $storage->insert('dumyCollection', $expected);

        $collection = $storage->fetchAll('dumyCollection');

        $this->assertEquals([$expected], $collection);
    }

}
