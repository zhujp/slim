<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });
    
    $app->group('/users', function (Group $group) {
        $group->get('', \app\controllers\UserController::class . ':lists');
        $group->get('/{id:[0-9]+}', \app\controllers\UserController::class . ':index');
        $group->post('', \app\controllers\UserController::class . ':create');
        $group->post('/{id:[0-9]+}', \app\controllers\UserController::class . ':update');
        $group->post('/delete/{id:[0-9]+}', \app\controllers\UserController::class . ':destory');
    });
};