<?php 
declare(strict_types=1);

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Psr\Container\ContainerInterface;
use app\responder\JsonResponder;

class Controller
{
    /**
     * @var Response
     */
    protected $response;

    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {

       $this->container = $container;
       $this->response = $this->container->get(ResponseFactoryInterface::class)->createResponse();
    }
    

    /**
     * @param  array|object|null $data
     * @return Response
     */
    // protected function respondWithData(Response $response, $data = null): Response
    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $responder = new JsonResponder($statusCode, $data);
        return $this->respond($responder);
    }

    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(JsonResponder $responder): Response
    {
        $json = json_encode($responder, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);
        return $this->response->withHeader('Content-Type', 'application/json');
    }
    
}