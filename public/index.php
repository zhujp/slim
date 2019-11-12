<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$container->set('db', function () {
    $settings = [...];
    return new MyService($settings);
});
AppFactory::setContainer($container);
$app = AppFactory::create();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$routes = require __DIR__ . '/../config/routes.php';
$routes($app);

$app->run();