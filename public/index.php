<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);

$app = AppFactory::create();
$app->addErrorMiddleware($container->get('config')['displayErrorDetails'], true, true);

$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

$app->run();