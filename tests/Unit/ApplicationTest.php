<?php

class Application extends \PHPUnit_Framework_TestCase
{
    public function testURIWithRegexShouldMatch()
    {
        $server = ['PATH_INFO' => '/test/users/1', 'REQUEST_METHOD' => 'GET'];
        $app = new Framework\Application($server, [], []);
        $app->get('/test/users/{id}', function() {
            return 'test';
        });
        $response = $app->run();

        $this->assertEquals(1, $app->getParameter());
        $this->assertEquals('test',$response);
    }

    /**
     * @expectedException Framework\Exceptions\PageNotFoundException
     */
    public function testGetInValidMethodShouldReturn404()
    {
        $server = ['PATH_INFO' => '/notexists/123', 'REQUEST_METHOD' => 'POST'];
        $app = new Framework\Application($server, [], []);
        $app->run();
    }

    public function testGetValidMethodShouldReturnValidOutput()
    {
        $server = [null, 'REQUEST_METHOD' => 'GET'];
        $app = new Framework\Application($server, [], []);
        $app->get('/', function() {
            return 'test';
        });
        $this->assertEquals('test', $app->run());
    }

    public function testPostValidMethodShouldReturnValidOutput()
    {
        $server = ['PATH_INFO' => '/home', 'REQUEST_METHOD' => 'POST'];
        $app = new Framework\Application($server, [], []);
        $app->post('/home', function() {
            return 'test';
        });
        $this->assertEquals('test', $app->run());
    }

    public function testMethodNeedToReadPostAndGetParameters()
    {
        $server = ['PATH_INFO' => '/home', 'REQUEST_METHOD' => 'POST'];
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
