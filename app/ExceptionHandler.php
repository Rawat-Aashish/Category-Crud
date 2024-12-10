<?php

namespace App;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Configuration\Exceptions;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionHandler
{
    public static function handelApiException(Exceptions $exceptions)
    {
        if (request()->is('*api*')) {
            $exceptions->render(function (QueryException $e) {
                return ApiResponser::errorResponse($e->getMessage());
            });
            $exceptions->render(function (ValidationException $e) {
                return ApiResponser::errorResponse($e->getMessage());
            });
            $exceptions->render(function (ModelNotFoundException $e) {
                return ApiResponser::errorResponse($e->getMessage(), 404);
            });
            $exceptions->render(function (AuthenticationException $e) {
                return ApiResponser::errorResponse($e->getMessage(), 401);
            });
            $exceptions->render(function (MethodNotAllowedHttpException $e) {
                return ApiResponser::errorResponse($e->getMessage(), 405);
            });
            $exceptions->render(function (NotFoundHttpException $e) {
                return ApiResponser::errorResponse($e->getMessage(), 404);
            });
            $exceptions->render(function (HttpException $e) {
                return ApiResponser::errorResponse($e->getMessage());
            });
        }
    }
}
