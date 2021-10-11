<?php

namespace App\Exceptions;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationResponseException extends HttpResponseException
{
    public const VALIDATION_ERROR_STATUS = 422;
    /**
     * The underlying validator instance
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;
    /**
     * The validator request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new HTTP response exception instance using specified validator.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function __construct(Validator $validator, Request $request = null)
    {
        $this->validator = $validator;
        $this->request = $request ?? request();
        parent::__construct(
            response()->json($this->getResponseData(), self::VALIDATION_ERROR_STATUS)
        );
    }

    /**
     * Get the response data for the exception
     *
     * @return array
     */
    protected function getResponseData()
    {
        return [
            'status' => false,
            'message' => 'Validation error occurred.',
            'errors' => $this->formatValidationErrors(),
        ];
    }

    /**
     * Format the validator error messages
     *
     * @return array
     */
    protected function formatValidationErrors()
    {
        $validation_messages = $this->validator->errors()->getMessages();

        $normalized_messages = array_unique(Arr::dot($validation_messages));

        $result = collect([]);
        collect($normalized_messages)->each(function ($message, $key) use (&$result) {
            $field = substr($key, 0, strpos($key, '.'));
            if (!$result->has($field)) {
                $result = $result->put($field, [
                    'message' => $message,
                    'rejected_value' => $this->request->input($field),
                ]);
            }
        });

        return $result->all();
    }

    /**
     * Get the underlying validation instance
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Get the underlying request
     *
     * @return \Illuminate\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
