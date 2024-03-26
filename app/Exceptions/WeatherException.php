<?php

namespace App\Exceptions;

use Exception;

class WeatherException extends Exception
{
    public static function invalid()
    {
        return new self('Request to weather service failed');
    }
}
