<?php 
declare(strict_types=1);

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    // protected $table = 'users';//指定表名
    // 
    public $timestamps = false;

    // protected $fillable = ['username,age,created_at'];//设置字段允许批量赋值

    public function createUser(array $data):self
    {
        $user = new self;
        $user->username = trim($data['username']);
        $user->age = intval($data['age']);
        $user->password = generatePassword($data['password']);
        $user->created_at = getTimestamp();
        
    }
}