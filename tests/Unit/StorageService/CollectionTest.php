<?php

class Collection extends \PHPUnit_Framework_TestCase
{

    public function testTryToInsertReturnTrue()
    {
        $expected = [
            1 => ['test' => 1],
            2 => ['test' => 2]
        ];
        $driver = new Framework\Storage\Drivers\Collection();
        $storage = new Framework\Storage($driver);
        $storage->insert('dumyCollection', $expected[1]);
        $storage->insert('dumyCollection', $expected[2]);

        $collection = $storage->fetchAll('dumyCollection');

        $this->assertEquals($expected, $collection);
    }

    public function testGivenAnIdShouldReturnAnItem()
    {
        $expected = ['test' => 1];
        $driver = new Framework\Storage\Drivers\Collection();
        $storage = new Framework\Storage($driver);
        $storage->insert('dumyCollection', $expected);

        $collection = $storage->fetch('dumyCollection', 1);

        $this->assertEquals($expected, $collection);
    }

}
