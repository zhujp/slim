<?php 
declare(strict_types=1);

namespace app\controllers;

use app\common\Error;

class UserController extends Controller
{
    public function __construct(Error $error)
    {
        var_dump($error);exit;
    }
    public function index($request, $response, $args)
    {
        $users = [
            'name' => $args,
            'age' => 20
        ];
        
        return $this->respondWithData($response, $users);
    }
}