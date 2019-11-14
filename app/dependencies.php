<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseFactoryInterface;

return function (ContainerBuilder $containerBuilder) {

    $containerBuilder->addDefinitions([

        'config' => function () {
            return require __DIR__ . '/../config/config.php';
        },

        'db' => function (ContainerInterface $container) {
            $config = $container->get('config');
            $capsule = new \Illuminate\Database\Capsule\Manager;
            $capsule->addConnection($config['db']);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        },

        App::class => static function (ContainerInterface $container) {
            AppFactory::setContainer($container);
            $app = AppFactory::create();
            return $app;
        },

        ResponseFactoryInterface::class => static function (ContainerInterface $container) {
            $app = $container->get(App::class);

            return $app->getResponseFactory();
        },
    ]);
    
};
