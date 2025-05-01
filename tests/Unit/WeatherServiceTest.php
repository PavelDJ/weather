<?php

namespace Tests\Unit;

use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    public function test_weather_data_is_fetched_correctly()
    {
        Http::fake([
            '*' => Http::response([
                'location' => ['name' => 'Kyiv', 'country' => 'Ukraine'],
                'current' => [
                    'temp_c' => 10,
                    'condition' => ['text' => 'Clear'],
                    'humidity' => 55,
                    'wind_kph' => 10,
                    'last_updated' => '2025-04-30 10:00',
                ]
            ], 200)
        ]);

        $service = new WeatherService();
        $data = $service->getWeather('Kyiv');

        $this->assertEquals('Kyiv', $data['city']);
        $this->assertEquals('Clear', $data['condition']);
    }
}
