<?php 
declare(strict_types=1);

namespace app\controllers;

use app\models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    public function lists($request, $response, $args)
    {

    }


    public function index($request, $response, $args)
    {
        
        $user = User::find($args['id']);
        
        if (empty($user)) {
            return $this->respondWithData(null,0);
        }
        return $this->respondWithData($user);
    }


    public function create()
    {
        $data = $this->getFormData();
        // $user = new User;
        // $user = $user->createUser($data);
        $user = User::createUser($data);
        return $this->respondWithData($user);
    }


    public function update($request, $response, $args)
    {
        $data = $this->getFormData();
        $user = User::updateUser((int)$args['id'], $data);

        return $this->respondWithData($user);
    }


    public function destory($request, $response, $args)
    {
        $user = User::find($args['id']);
        $user->delete();

        return $this->respondWithData(null,200,'删除成功');
    }
}