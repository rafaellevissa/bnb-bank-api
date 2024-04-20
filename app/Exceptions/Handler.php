<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
