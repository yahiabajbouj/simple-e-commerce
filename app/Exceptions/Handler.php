<?php

namespace App\Exceptions;

use Throwable;
use App\Helpers\JsonResponse;
use App\Helpers\ResponseStatus;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


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
        $this->renderable(function (MethodNotAllowedHttpException $exception, $request) {
            return JsonResponse::respondError(trans(JsonResponse::MSG_NOT_ALLOWED),ResponseStatus::NOT_ALLOWED);
        });
        $this->renderable(function (NotFoundHttpException $exception, $request) {
            return JsonResponse::respondError(trans(JsonResponse::MSG_NOT_FOUND), ResponseStatus::NOT_FOUND);
        });
        // $this->renderable(function (ModelNotFoundException $exception, $request) {
        //     return JsonResponse::respondError(trans(JsonResponse::MSG_NOT_FOUND), ResponseStatus::NOT_FOUND);
        // });

        $this->reportable(function (Throwable $exception) {
        });
    }
}
