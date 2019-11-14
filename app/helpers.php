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




