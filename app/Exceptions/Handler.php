<?php

namespace App\Exceptions;

use App\Helpers\ResponseHandler;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    public function render($request, \Throwable $e): JsonResponse
    {
        $handler = app(ResponseHandler::class);
        return $handler->handleException($e, 'EXCEPTION_ERROR', $e->getMessage());
    }
}
