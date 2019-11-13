<?php
declare(strict_types=1);

use DI\Container;
use app\controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use app\common\Error;

return function (Container $container) {
    $container->set('db', function () use($container) {
        $config = $container->get('config');
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($config['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    });

    $container->set(Error::class, function (){
        return new Error('json',null);
    });
};
