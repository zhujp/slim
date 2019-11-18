<?php 
/**
 * 工具库
 */
declare(strict_types=1);

namespace app\extends;

class Utils
{

    /**
     * 生成密码
     * @param  string      $password 需要加密的字符串
     * @param  string|null $algo     加密算法
     * @return string               加密后的密码
     */
    public function generatePassword(string $password, ?string $algo=null):string
    {
        switch ($algo) {
            case 'password_hash':
                $password = password_hash($password, PASSWORD_BCRYPT);
                break;

            case 'md5':
                $password = md5(md5($password).'KcIThICYnKIWtIce');
                break;
            default:
                $password = password_hash($password, PASSWORD_BCRYPT);
                break;
        }

        return $password;
    }


    /**
     * 密码验证
     * @param  string $password 用户密码
     * @param  string $hash     系统存储的hash密码
     * @param  string $algo     加密算法
     * @return bool           密码是否正确
     */
    public function verifyPassword(string $password, string $hash, ?string $algo):bool
    {
        switch ($algo) {
            case 'password_hash':
                $result = password_verify($password, $hash);
                break;
            
            case 'md5':
                $result = generatePassword($password,'md5') == $hash;
                break;
            default:
                $result = password_verify($password, $hash);
                break;
        }


        return $result;
    }


    /**
     * 验证手机号是否合法
     * @param  string $mobile 手机号
     * @return [type] [description]
     */
    public function validateMobile(?string $mobile=null):bool
    {
        $pattern = '/^1\d{10}$/';

        if (is_null($mobile)) {
            return false;
        }

        if (preg_match($pattern,$mobile)) {
            return true;
        }

        return false;
    }


    /**
     * 验证邮箱
     * @param  string|null $email [description]
     * @return [type]             [description]
     */
    public function validateEmail(?string $email=null):bool
    {
        $pattern = '/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/';

        if (is_null($email)) {
            return false;
        }

        if (preg_match($pattern,$email)) {
            return true;
        }

        return false;
    }
}