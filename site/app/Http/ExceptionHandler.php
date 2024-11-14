<?php

namespace App\Http;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionHandler
{
    /**
     * Renders exception response.
     *
     * @param Exception $e
     * @param Request $request
     * @return JsonResponse|null
     */
    public static function render(Exception $e, Request $request): ?JsonResponse
    {
        if (!$request->is('api/*')) {
            return null;
        }
        $responseCode = 500;

        if($e instanceof NotFoundHttpException) {
            $responseCode = 404;
        }
        if($e instanceof AccessDeniedHttpException) {
            $responseCode = 403;
        }

        return response()->json([
            'message' => $e->getMessage(),
        ], $responseCode);
    }
}
