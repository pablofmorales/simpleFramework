<?php

include '../src/Framework/Autoload.php';

\session_start();

$app = new Framework\Application($_SERVER, $_POST, $_GET);

$app->get('/home', function() use ($app) {
    return "test";
});

$app->get('/addresses/import', function () use ($app) {
    $driver = new Framework\Storage\Drivers\Session();
    $storage = new Framework\Storage($driver);

    $addressModel = new Models\Addresses($storage);
    $address = new Controllers\Addresses($addressModel);
    return $address->importFromCSV();
});

$app->get('/addresses', function () use ($app) {
    $driver = new Framework\Storage\Drivers\Session();
    $storage = new Framework\Storage($driver);

    $addressModel = new Models\Addresses($storage);
    $address = new Controllers\Addresses($addressModel);
    return $address->getById($app);
});

echo $app->run();
