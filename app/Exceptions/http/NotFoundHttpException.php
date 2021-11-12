<?php

namespace App\Exceptions\http;

class NotFoundHttpException extends HttpException
{
    public function __construct($message, $code = 400, \Exception $previous = null)
    {
        parent::__construct(404, $message, $code, $previous);
    }
}
