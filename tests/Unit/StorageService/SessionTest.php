<?php

class SessionTest extends \PHPUnit_Framework_TestCase
{

    public function testSaveAndGetDataShouldBeValid()
    {
        $expected = [ 'test' => 1];
        $driver = new Framework\Storage\Drivers\Session();
        $driver->insert('dumyCollection', ['test' => 1]);

        $rowset = $driver->fetchAll('dumyCollection');

        $this->assertEquals([1 => $expected], $rowset);
    }

    public function testSaveAndGetMultipleDataShouldBeValid()
    {
        $expected = [
            1 => ['test' => 1],
            2 => ['test' => 2],
            3 => ['test' => 3],
        ];
        $driver = new Framework\Storage\Drivers\Session();
        $driver->insert('dumyCollection', ['test' => 2]);
        $driver->insert('dumyCollection', ['test' => 3]);

        $rowset = $driver->fetchAll('dumyCollection');

        $this->assertEquals($expected, $rowset);
    }

    public function testGivenAnInexistentIdSHouldReturnEmpty()
    {
        $driver = new Framework\Storage\Drivers\Session();
        $rowset = $driver->fetch('dumyCollection', 6);

        $this->assertEquals([], $rowset);
    }


    public function testGivenAnIdSHouldReturnValidData()
    {
        $expected = ['test' => 5];
        $driver = new Framework\Storage\Drivers\Session();
        $driver->insert('dumyCollection', ['test' => 5]);

        $rowset = $driver->fetch('dumyCollection', 4);

        $this->assertEquals($expected, $rowset);

    }
}
