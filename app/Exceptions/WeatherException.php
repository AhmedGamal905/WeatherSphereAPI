<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class WeatherException extends Exception
{
    public static function invalid()
    {
        return new self('Request to weather service failed', Response::HTTP_NOT_FOUND);
    }
}
