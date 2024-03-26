<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Http\Resources\WeatherResource;

class WeatherService
{
    public function fetch(float $latitude, float $longitude)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'hourly' => 'temperature_2m',
            'forecast_days' => 1
        ]);

        if ($response->successful()) {
            return new WeatherResource($response->json());
        }

        throw new \Exception("Request to weather service failed: " . ($response->json()['reason'] ?? 'Something Went Wrong'));
    }
}