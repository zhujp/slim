<?php 
declare(strict_types=1);

function dump($data, $is_exit=true):void
{
    if ($is_exit) {
        var_dump($data);
        exit;
    }

    var_dump($var_dump);
    return;
}


/**
 * 生成密码
 * @param  string      $password 需要加密的字符串
 * @param  string|null $algo     加密算法
 * @return string               加密后的密码
 */
function generatePassword(string $password, ?string $algo=null):string
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
function verifyPassword(string $password, string $hash, ?string $algo):bool
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
 * 格式化时间
 * @param  int|string|null $time eg.1573741882|20190934|null
 * @return [type]       [description]
 */
function getTimestamp($time=null):string
{
    if (is_null($time)) {
        $time = time();
    } else if (is_string($time)) {
        $time = strtotime($time);
    } 

    return date('Y-m-d H:i:s',$time);
}



