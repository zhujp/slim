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



