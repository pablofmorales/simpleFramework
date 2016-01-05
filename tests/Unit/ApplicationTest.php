<?php

class Application extends \PHPUnit_Framework_TestCase
{

    public function testGetValidMethodShouldReturnValidOutput()
    {
        $app = new Framework\Application();
        $app->get('/home', function() {
            return 'test';
        });
        $server = ['REQUEST_URI' => '/home', 'REQUEST_METHOD' => 'GET'];
        $this->assertEquals('test', $app->run($server));
    }

    public function testPostValidMethodShouldReturnValidOutput()
    {
        $app = new Framework\Application();
        $app->post('/home', function() {
            return 'test';
        });
        $server = ['REQUEST_URI' => '/home', 'REQUEST_METHOD' => 'POST'];
        $this->assertEquals('test', $app->run($server));

    }

}
