<?php

use App\Controllers\ProductController;

require_once __DIR__ . '/../env.php';
require_once __DIR__ . "/../app/helpers.php";

flash_next_request();
// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->get('/', function () {
    echo "HOME PAGE";
    die;
});

//code router mới ở đây
$router->mount('/products', function () use ($router) {
    $router->get('/',           ProductController::class . "@index");
    $router->get('/create',     ProductController::class . "@create");
    $router->post('/store',     ProductController::class . "@store");
    $router->get('/{id}/edit',  ProductController::class . "@edit");
    $router->post('/{id}/update',  ProductController::class . "@update");
    $router->get('/{id}/delete',    ProductController::class . "@destroy");
});


$router->set404(function () {
    return view('404');
});
// Run it!
$router->run();
