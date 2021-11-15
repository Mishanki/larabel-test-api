<?php

namespace App\Core;

use ArgumentCountError;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as ComponentNotFoundHttpException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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

        $response['code'] = $e->getCode();
        $response['message'] = $e->getMessage();

        if ($e instanceof ArgumentCountError) {
            $response['message'] = 'Argument count error';
            $response['code'] = Errors::INTERNAL_ERROR;
        } elseif ($e instanceof ComponentNotFoundHttpException) {
            $response['message'] = 'Method is not found';
            $response['code'] = Errors::INTERNAL_ERROR;
        } elseif ($e instanceof ValidationException) {
            $response['errors'] = $e->errors();
            $statusCode = $e->status;
            $response['code'] = Errors::VALIDATION_ERROR;
        } elseif ($e instanceof AccessDeniedHttpException) {
            $response['code'] = Errors::AUTHORIZATION_ERROR;
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

        return response()->json($response, $statusCode);
    }
}
