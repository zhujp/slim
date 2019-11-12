<?php
declare(strict_types=1);

use DI\Container;

return function (Container $container) {
    $container->set('db', function () use($container) {
        $config = $container->get('config');
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($config['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    });
};
