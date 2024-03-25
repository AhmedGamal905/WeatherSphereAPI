<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function fetchWeatherData(Request $request)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'hourly' => 'temperature_2m',
            'forecast_days' => 1
        ]);

        if ($response->status() == 200) {
            return $response->json();
        } else {
            return response()->json([
                'reason' => $response->json()['reason'] ?? 'Error details unavailable',
            ]);
        }


    }

}
