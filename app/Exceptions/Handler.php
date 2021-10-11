<?php

namespace App\Exceptions;

use Exception;
use App\Traits\HasApiResponse;
use App\Traits\HandleApiExceptions;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use HasApiResponse, HandleApiExceptions;
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
        $this->reportable(function (Throwable $e) {
            $this->renderable(function (Exception $e, $request) {
                return $this->buildResponse($e, $request);
            });
        });
    }

    /**
     * @param Exception $e
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function buildResponse(Exception $e, $request = null)
    {

        if ($e instanceof ValidationException) {
            return (new ValidationResponseException($e->validator, $request))->getResponse();
        }
        if ($e instanceof AuthenticationException) {
            return $this->unauthenticatedResponse($e->getMessage());
        }
        if ($e instanceof ModelNotFoundException) {
            return $this->notFoundResponse('Model cannot be found');
        }
        if ($e instanceof NotFoundHttpException) {
            return $this->notFoundResponse($e->getMessage() || "Resource cannot be found");
        }
        if ($e instanceof HttpResponseException) {
            return $e->getResponse();
        }

        if ($e instanceof AuthenticationException) {
            return $this->authResponse($e->getMessage(), $e->getCode());
        }

        if ($e instanceof HttpException) {
            return $this->jsonResponse($e->getMessage(), $e->getStatusCode());
        }

        return $this->serverErrorResponse($e->getMessage());
    }
}
