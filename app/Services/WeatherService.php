<?php

namespace App\Services;

use App\Exceptions\WeatherException;
use App\Http\Resources\WeatherResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected bool $caching = false;

    protected ?string $cacheKey;

    protected \Closure|\DateTimeInterface|\DateInterval|int|null $ttl;

    public function fetch(float $latitude, float $longitude): WeatherResource
    {
        if ($this->caching) {
            return Cache::remember($this->cacheKey, $this->ttl, fn () => $this->request($latitude, $longitude));
        }

        return $this->request($latitude, $longitude);
    }

    protected function request(float $latitude, float $longitude): WeatherResource
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

        return WeatherResource::make($response->json());
    }

    public function withCaching(string $key, \Closure|\DateTimeInterface|\DateInterval|int|null $ttl): self
    {
        $this->cacheKey = $key;

        $this->ttl = $ttl;

        $this->caching = true;

        return $this;
    }
}
