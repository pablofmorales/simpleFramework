<?php

// autoloading
// Dependency Injection
// Controllers declarations
// Routing
// Request

include '../src/Framework/Autoload.php';

$app = new Framework\Application($_SERVER, $_POST, $_GET);

$app->get('/home', function() use ($app) {
    return "test";
});

echo $app->run();
