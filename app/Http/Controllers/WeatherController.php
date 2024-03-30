<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function fetchWeatherData(Request $request, WeatherService $weatherService)
    {
        return Cache::remember('weather-' . $request->latitude . '-' . $request->longitude, now()->addHour(), function () use ($request, $weatherService) {
            return $weatherService->fetch($request->latitude, $request->longitude);
        });
    }
}
