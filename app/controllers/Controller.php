<?php 
declare(strict_types=1);

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Psr\Container\ContainerInterface;
use app\common\Payload;

class Controller
{
    /**
     * @var Response
     */
    protected $response;

    // protected $container;
    //默认以容器作为参数传入构造方法
    // constructor receives container instance
    // public function __construct(ContainerInterface $container) {
    //    $this->container = $container;
    //    echo "<pre>";
    //    var_dump($this->container);exit;
    // }
    // 

    /**
     * @return array|object
     * @throws HttpBadRequestException
     */
    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param  string $name
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    /**
     * @param  array|object|null $data
     * @return Response
     */
    protected function respondWithData(Response $response, $data = null): Response
    {
        $this->response = $response;
        $payload = new Payload(200, $data);
        return $this->respond($payload);
    }

    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(Payload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);
        return $this->response->withHeader('Content-Type', 'application/json');
    }
    
}