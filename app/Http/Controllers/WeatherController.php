<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\WeatherResource;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function fetchWeatherData(Request $request, WeatherService $weatherService)
    {
        return $weatherService->fetch($request->latitude, $request->longitude);

    }
}
