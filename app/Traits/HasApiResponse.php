<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Exceptions\IllegalArgumentException;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ValidationResponseException;
trait HasApiResponse
{
    /**
     * Return a Validation error message
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationResponse(string $message)
    {
        return $this->jsonResponse($message, 422);
    }

    /**
     * Return a successful ok HTTP response
     *
     * @param string $message
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function okResponse(string $message, $data = null)
    {
        return $this->successResponse($message, $data, 200);
    }

    /**
     * Return a successful created HTTP response
     *
     * @param string $message
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createdResponse(string $message, $data = null)
    {
        return $this->successResponse($message, $data, 201);
    }

    /**
     * Return a successful no content HTTP response
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContentResponse()
    {
        return $this->successResponse('', null, 204);
    }

    /**
     * Return a generic successful HTTP response
     *
     * @param string $message
     * @param $data
     * @param int $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(string $message, $data = null, int $status = 200)
    {
        return $this->jsonResponse($message, $status, $data);
    }

    /**
     * Return a validation error response
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationErrorResponse(Validator $validator, Request $request = null)
    {
        return (new ValidationResponseException($validator, $request))
            ->getResponse();
    }

    /**
     * Return an unauthenticated HTTP error response
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthenticatedResponse(string $message)
    {
        return $this->clientErrorResponse($message, 401);
    }

    /**
     * Return a bad request HTTP error response
     *
     * @param string $message
     * @param null $error
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function badRequestResponse(string $message, array $error = null)
    {
        return $this->clientErrorResponse($message, 400, $error);
    }

    /**
     * Return a forbidden HTTP error response
     *
     * @param string $message
     * @param null $error
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forbiddenResponse(string $message, array $error = null)
    {
        return $this->clientErrorResponse($message, 403, $error);
    }

    /**
     * Return a not found HTTP error response
     *
     * @param string $message
     * @param null $error
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFoundResponse(string $message, $error = null)
    {
        return $this->clientErrorResponse($message, 404, $error);
    }

    /**
     * Return a generic client HTTP error response
     *
     * @param string $message
     * @param int $status
     * @param null $error
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clientErrorResponse(string $message, int $status = 400, $error = null)
    {
        return $this->jsonResponse($message, $status, $error);
    }

    /**
     * Return a generic server HTTP error response
     *
     * @param string $string
     * @param int $status
     * @param Exception|null $exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function serverErrorResponse(string $string, int $status = 503, Exception $exception = null)
    {
        if ($exception !== null) {
            Log::error(
                "{$exception->getMessage()}
                on line {$exception->getLine()}
                in {$exception->getFile()}"
            );
        }

        return $this->jsonResponse($string, $status);
    }

    /**
     * Return a generic HTTP response
     *
     * @param string $message
     * @param int $status
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(string $message, int $status, $data = null)
    {
        $is_successful = $this->isStatusCodeSuccessful($status);

        $response_data = [
            'status' => $is_successful,
            'message' => $message,
        ];

        if (!is_null($data)) {
            $response_data[$is_successful ? 'data' : 'error'] = $data;
        }

        return Response::json($response_data, $status);
    }

    /**
     * Determine if a  HTTP status code indicates success
     *
     * @param int $status
     *
     * @return bool
     */
    public function isStatusCodeSuccessful(int $status)
    {
        return $status >= 200 && $status < 300;
    }

    public function authResponse($message, $status)
    {
        return $this->jsonResponse($message, $status);
    }
}
