<?php

class Application extends \PHPUnit_Framework_TestCase
{

    public function testGetValidMethodShouldReturnValidInformation()
    {

        $app = new Framework\Application();

        $app->get('/home', function() {
            return 'test';
        });

        $server = ['uri' => '/home'];
        $this->assertEquals('test', $app->run($server));
    }
}
