<?php

namespace App\Core;

use ArgumentCountError;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as ComponentNotFoundHttpException;
use Throwable;

class ApiErrorHandler
{
    /**
     * @param Throwable $e
     * @return JsonResponse
     */
    public function customApiResponse(Throwable $e): JsonResponse
    {
        if(method_exists($e, 'getStatusCode')) {
            $statusCode = $e->getStatusCode();
        } else {
            $statusCode = 400;
        }

        $code = $e->getCode();
        $message = $e->getMessage();

        if ($e instanceof ArgumentCountError) {
            $message = 'Argument count error';
            $code = Errors::INTERNAL_ERROR;
        } elseif ($e instanceof ComponentNotFoundHttpException) {
            $message = 'Method is not found';
            $code = Errors::INTERNAL_ERROR;
        }

        if (config('app.debug')) {
//            $response['trace'] = $exception->getTrace();
//            $response['code'] = $exception->getCode();
        }

        // logger
        /*
        $this->logger->log($level, $e->getMessage(), [
            'class' => get_class($e),
            'code' => $code,
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
        */

        return response()->json(['message' => $message, 'code' => $code], $statusCode);
    }
}
