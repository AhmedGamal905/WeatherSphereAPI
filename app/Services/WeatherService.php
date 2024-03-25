<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $weatherApi = 'https://api.open-meteo.com/v1/forecast';

    public function fetchWeather(Request $request)
    {
        return Http::get($this->weatherApi, [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'hourly' => 'temperature_2m',
            'forecast_days' => 1
        ]);
    }
}
