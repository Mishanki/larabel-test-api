<?php

namespace App\Exceptions\Http;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedHttpException extends HttpException
{
    /**
     * UnauthorizedHttpException constructor.
     * @param string|null $message
     * @param int $code
     * @param array $headers
     */
    public function __construct(?string $message = '',  int $code = 0, array $headers = [])
    {
        parent::__construct(401, $message, null, $headers, $code);
    }
}
