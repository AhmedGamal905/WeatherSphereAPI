<?php

namespace Tests\Feature;

use App\Exceptions\WeatherException;
use App\Http\Resources\WeatherResource;
use App\Services\WeatherService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    public function test_service_returns_a_success_response(): void
    {
        $fakeResponse = json_decode(file_get_contents(__DIR__.'/../data/weather/success.json'), true);

        Http::fake([
            'https://api.open-meteo.com/v1/forecast*' => Http::response($fakeResponse, Response::HTTP_OK),
        ]);

        $this->assertEquals(
            app(WeatherService::class)->fetch(13.375, 52.5),
            WeatherResource::make($fakeResponse),
        );
    }

    public function test_service_returns_an_exception(): void
    {
        $failResponse = json_decode(file_get_contents(__DIR__.'/../data/weather/fail.json'), true);

        Http::fake([
            'https://api.open-meteo.com/v1/forecast*' => Http::response($failResponse, Response::HTTP_NOT_FOUND),
        ]);

        $this->expectException(WeatherException::class);
        $this->expectExceptionMessage('Request to weather service failed');
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);
        app(WeatherService::class)->fetch(13.375, 52.5);
    }

    public function test_service_can_cache(): void
    {
        $fakeResponse = json_decode(file_get_contents(__DIR__.'/../data/weather/success.json'), true);
        $cacheKey = 'weather_data_13.375_52.5';

        Http::fake([
            'https://api.open-meteo.com/v1/forecast*' => Http::response($fakeResponse, Response::HTTP_OK),
        ]);

        app(WeatherService::class)->withCaching($cacheKey, now()->addHour())
            ->fetch(13.375, 52.5);

        $this->assertTrue(Cache::has($cacheKey));

        $this->assertEquals(WeatherResource::make($fakeResponse), Cache::get($cacheKey));
    }
}
