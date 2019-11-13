<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/../config/config.php';
$container = new Container();

//Set up config
$container->set('config',$config);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($container);

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware($config['displayErrorDetails'], true, true);

$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

$app->run();