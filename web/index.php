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

$app->get('/addresses', function () use ($app) {
    $driver = new Framework\Storage\Drivers\Session();
    $storage = new Framework\Storage($driver);

    $addressModel = new Models\Addresses($storage);
    $address = new Controllers\Addresses($addressModel);
    return $address->importFromCSV();
});

echo $app->run();
