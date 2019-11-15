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

    public static function createUser(array $data):self
    {
        $user = new self;
        $user->username = trim($data['username']);
        $user->age = intval($data['age']);
        $user->password = generatePassword($data['password']);
        $user->created_at = getTimestamp();
        $user->save();

        return $user;
    }


    public static function updateUser(int $user_id, array $data):self
    {
        $user = self::find($user_id);
        foreach ($data as $key=>$val) {
            if ($key == 'password') {
                $user->$key = generatePassword($val);
            } else {
                $user->$key = $val;
            }
        }

        $user->save();

        return $user;
    }
}