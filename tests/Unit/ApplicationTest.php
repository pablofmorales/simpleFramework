<?php

class Application extends \PHPUnit_Framework_TestCase
{

    public function testGetValidMethodShouldReturnValidOutput()
    {
        $server = ['REQUEST_URI' => '/home', 'REQUEST_METHOD' => 'GET'];
        $app = new Framework\Application($server, [], []);
        $app->get('/home', function() {
            return 'test';
        });
        $server = ['REQUEST_URI' => '/home', 'REQUEST_METHOD' => 'GET'];
        $this->assertEquals('test', $app->run($server));
    }

    public function testPostValidMethodShouldReturnValidOutput()
    {
        $server = ['REQUEST_URI' => '/home', 'REQUEST_METHOD' => 'POST'];
        $app = new Framework\Application($server, [], []);
        $app->post('/home', function() {
            return 'test';
        });
        $this->assertEquals('test', $app->run());
    }

    public function testMethodNeedToReadPostAndGetParameters()
    {
        $server = ['REQUEST_URI' => '/home', 'REQUEST_METHOD' => 'POST'];
        $app = new Framework\Application($server, ['val' => 1], ['val' => 2]);
        $app->post('/home', function() use ($app) {
            $response = [
                'get' => $app->getValues,
                'post' => $app->postValues,
            ];
            return \json_encode($response);
        });
        $expected = \json_encode([
            'get' => ['val' => 2],
            'post' => ['val' => 1],
        ]);
        $this->assertEquals($expected, $app->run());
    }

}
