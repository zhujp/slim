<?php 
declare(strict_types=1);

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Container\ContainerInterface;
use app\responder\JsonResponder;
use Slim\Exception\HttpBadRequestException;

class Controller
{
    /**
     * @var Response
     */
    protected $response;

    protected $container;
    
    protected $db;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {

       $this->container = $container;
       $this->db = $this->container->get('db');
       $this->response = $this->container->get(ResponseFactoryInterface::class)->createResponse();
    }
    

    /**
     * @return array|object
     * @throws HttpBadRequestException
     */
    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'),true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param  array|object|null $data
     * @return Response
     */
    // protected function respondWithData(Response $response, $data = null): Response
    protected function respondWithData($data = null, int $statusCode = 200, ?string $message=null): Response
    {
        $responder = new JsonResponder($statusCode, $data, $message);
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