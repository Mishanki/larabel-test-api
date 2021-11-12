<?php

namespace App\Exceptions\Http;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ForbiddenHttpException extends HttpException
{
    /**
     * ForbiddenHttpException constructor.
     * @param string|null $message
     * @param int $code
     * @param array $headers
     */
    public function __construct(?string $message = '',  int $code = 0, array $headers = [])
    {
        parent::__construct(403, $message, null, $headers, $code);
    }
}
