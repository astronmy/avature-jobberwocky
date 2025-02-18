<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ResponseHandler {

    public function responseOk(int $code, array $data = null): JsonResponse {
        $response = $data ?? [];
        return response()->json($response, $code);
    }

    public function responseError(
        int $responseCode,
        ?string $errorCode =  null,
        ?string $message = null,
        ?array $extraData = []
    ): JsonResponse {

        $response = [
            'error' => $errorCode,
            'message' => $message,
        ];

        $response = array_merge($response, $extraData);

        return response()->json($response, $responseCode);
    }

    public function handleException(
        \Throwable $exception,
        ?string $errorCode,
        ?string $message
    ): JsonResponse {
        $exceptionClass = $exception::class;
        return  match ($exceptionClass) {
            ModelNotFoundException::class => $this->responseError(404, 100, "Resource not found"),
            ConflictHttpException::class => $this->responseError(409, $exception->getCode(), $exception->getMessage()),
            BadRequestException::class => $this->responseError(400, $exception->getCode(), $exception->getMessage()),
            ValidationException::class => $this->responseError(400, $exception->getCode(), $exception->getMessage(), ['errors_details' => $exception->errors()]),
            default => $this->responseError(500, $exception->getCode(), $exception->getMessage()),
        };
    }
}
