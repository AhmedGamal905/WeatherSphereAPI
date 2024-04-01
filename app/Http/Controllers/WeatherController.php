<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function fetchWeatherData(Request $request, WeatherService $weatherService)
    {
        return $weatherService
            ->withCaching('weather-'.$request->latitude.'-'.$request->longitude, now()->addHour())
            ->fetch($request->latitude, $request->longitude);
    }
}
