<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'current_latitude' => $this->resource['latitude'],
            'current_longitude' => $this->resource['longitude'],
            'timezone' => $this->resource['timezone'],
            'temperature_unit' => $this->resource['hourly_units']['temperature_2m'],
            'hourly' => [
                'timestamp' => $this->resource['hourly']['time'],
                'temperature' => $this->resource['hourly']['temperature_2m'],
            ],
        ];
    }
}
