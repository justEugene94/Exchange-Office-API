<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Exception $e)
    {

        $e = $this->prepareException($e);

        if ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        }

        if ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        return $this->prepareResponse($request, $e);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        return JsonResponse::create([
            'result' => [
                'status' => 'error',
                'message' => $exception->getMessage(),
            ],
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request): JsonResponse
    {
        return JsonResponse::create([
            'result' => [
                'status' => 'error',
                'message' => $e->getMessage(),
                'validation' => $e->errors()
            ],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     *
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function prepareResponse($request, Exception $e)
    {
        $statusCode   = $this->isHttpException($e) ? $e->getStatusCode() : 500;

        return JsonResponse::create([
            'result' => [
                'status' => 'error',
                'message' => $e->getMessage(),
                'trace' => $this->getBacktrace($e)
            ],
        ], $statusCode);
    }

    /**
     * @param Exception $e
     *
     * @return array
     */
    protected function getBacktrace(Exception $e): array
    {
        $backtrace = [];

        if (config('app.debug')) {
            $backtrace = $this->convertExceptionToArray($e);
        }

        return $backtrace;
    }
}
