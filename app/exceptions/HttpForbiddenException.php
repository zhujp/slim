<?php 
declare(strict_types=1);

namespace app\exceptions;

use Slim\Exception\HttpException;

class HttpForbiddenException extends HttpException
{
    protected $code = 504;
    protected $message = 'Gateway Timeout.';
    protected $title = '504 Gateway Timeout';
    protected $description = 'Timed out before receiving response from the upstream server.';
}