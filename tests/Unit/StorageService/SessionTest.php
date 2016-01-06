<?php

class SessionTest extends \PHPUnit_Framework_TestCase
{

    public function testSaveAndGetDataShouldBeValid()
    {
        $expected = ['test' => 1];
        $driver = new Framework\Storage\Drivers\Session();
        $driver->insert('dumyCollection', $expected);

        $rowset = $driver->fetchAll('dumyCollection');

        $this->assertEquals([$expected], $rowset);
    }
}
