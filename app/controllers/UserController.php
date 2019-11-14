<?php 
declare(strict_types=1);

namespace app\controllers;

use app\common\Error;

class UserController extends Controller
{
    
    public function lists($request, $response, $args)
    {

    }


    public function index($request, $response, $args)
    {
        $users = [
            'name' => $args,
            'age' => 20
        ];
        
        return $this->respondWithData($users);
    }


    public function create()
    {
        $data = $this->getFormData();
        dump($data);
    }


    public function update($request, $response, $args)
    {

    }


    public function destory($request, $response, $args)
    {

    }
}