<?php

namespace App\Exceptions;

use App\Exceptions\http\BadRequestHTTPException;
use App\Exceptions\http\ForbiddenHttpException;
use App\Exceptions\http\NotFoundHttpException;
use App\Exceptions\http\UnauthorizedHttpException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        parent::render($request, $e);
        return $this->handleApiException($request, $e);
    }

    private function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }


        return $this->customApiResponse($exception);
    }

    /**
     * @param Throwable $exception
     * @return JsonResponse
     */
    private function customApiResponse(Throwable $exception): JsonResponse
    {
        $statusCode = 400;
        $code = $exception->getCode();
        $message = $exception->getMessage();

        if ($exception instanceof BadRequestHTTPException) {
            $statusCode = 400;
        } elseif ($exception instanceof UnauthorizedHttpException) {
            $statusCode = 401;
        } elseif ($exception instanceof ForbiddenHttpException) {
            $statusCode = 403;
        } elseif ($exception instanceof NotFoundHttpException) {
            $statusCode = 404;
        }

        if (config('app.debug')) {
//            $response['trace'] = $exception->getTrace();
//            $response['code'] = $exception->getCode();
        }

        $response['message'] = $message;
        $response['code'] = $code;

        // logger

        return response()->json($response, $statusCode);
    }
}
