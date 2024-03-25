<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\WeatherResource;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function fetchWeatherData(Request $request)
    {

        $weatherService = new WeatherService();

        $response = $weatherService->fetchWeather($request);

        if ($response->successful()) {
            return new WeatherResource($response->json());

        } else {
            return response()->json([
                'reason' => $response->json()['reason'] ?? 'Something Went Wrong',
            ]);
        }
    }
}
