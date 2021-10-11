<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Response;
trait HandleApiExceptions
{
    /**
     * The filename containing API error language strings
     *
     * @var string
     */
    protected $api_error_translation_file = 'api_error';

    /**
     * Returns the message and error code for the exception based on localization keys defined
     *
     * @param \Exception $exception
     * @param int $status
     *
     * @return array
     */
    protected function getTranslationDataFromException(Exception $exception, $status)
    {
        $error_message = $exception->getMessage() ?: Response::$statusTexts[$status];

        return $this->translationResolver($error_message);
    }

    protected function getTranslationDataFromKey($key, $params)
    {
        return $this->translationResolver($key, $params);
    }

    /**
     * @param string $error_message
     * @return array
     */
    private function translationResolver(string $key, $params): string
    {
        $translation_key = "{$this->api_error_translation_file}.{$key}";

        $translated_message = __($translation_key, $params);
        return $translated_message;
    }
}
