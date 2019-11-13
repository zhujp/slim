<?php 
declare(strict_types=1);

namespace app\controllers;

class UserController extends Controller
{
    
    public function index($request, $response, $args)
    {
        $users = [
            'name' => $args,
            'age' => 20
        ];
        
        return $this->respondWithData($response, $users);
    }
}