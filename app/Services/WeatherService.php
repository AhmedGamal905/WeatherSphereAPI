<?php

namespace App\Services;

use App\Exceptions\WeatherException;
use App\Http\Resources\WeatherResource;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function fetch(float $latitude, float $longitude)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'hourly' => 'temperature_2m',
            'forecast_days' => 1,
        ]);

        if ($response->failed()) {
            throw WeatherException::invalid();
        }

        return new WeatherResource($response->json());
    }
}
