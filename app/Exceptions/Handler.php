<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception)
    {
        return $this->handleApiException($request, $exception);
    }

    protected function handleApiException($request, Throwable $exception)
    {
        $status = $this->getStatusCode($exception);
        $message = $this->getMessage($exception);

        return response()->json([
            'error' => [
                'message' => $message,
                'status' => $status,
            ]
        ], $status);
    }

    protected function getStatusCode(Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return 401;
        } elseif ($exception instanceof ValidationException) {
            return 422;
        } elseif ($exception instanceof NotFoundHttpException) {
            return 404;
        } elseif ($exception instanceof AuthorizationException) {
            return 403;
        } elseif ($exception instanceof ModelNotFoundException) {
            return 404;
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            return 405;
        } elseif ($exception instanceof QueryException) {
            return 500;
        } elseif ($exception instanceof TooManyRequestsHttpException) {
            return 429;
        }

        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }
        return 500;
    }

    protected function getMessage(Throwable $exception)
    {
        return $exception->getMessage();
    }
}
