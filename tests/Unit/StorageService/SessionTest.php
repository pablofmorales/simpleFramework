<?php

class SessionTest extends \PHPUnit_Framework_TestCase
{

    public function testSaveAndGetDataShouldBeValid()
    {
        $expected = ['id' => 1, 'test' => 1];
        $driver = new Framework\Storage\Drivers\Session();
        $driver->insert('dumyCollection', ['test' => 1]);

        $rowset = $driver->fetchAll('dumyCollection');

        $this->assertEquals([$expected], $rowset);
    }

    public function testSaveAndGetMultipleDataShouldBeValid()
    {
        $expected = [
            ['id' => 1, 'test' => 1],
            ['id' => 2, 'test' => 1],
        ];
        $driver = new Framework\Storage\Drivers\Session();
        $driver->insert('dumyCollection', ['test' => 1]);
        $driver->insert('dumyCollection', ['test' => 2]);

        $rowset = $driver->fetchAll('dumyCollection');

        $this->assertEquals($expected, $rowset);
    }
}
