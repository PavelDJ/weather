<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.weatherapi.key');
    }

    public function getWeather(string $city): array
    {
        try {
            $response = Http::timeout(10)->get('https://api.weatherapi.com/v1/current.json', [
                'key' => $this->apiKey,
                'q' => $city,
            ]);
            if ($response->failed()) {
                Log::error('API error: ' . $response->body());
                return ['error' => 'Не вдалося отримати дані про погоду.'];
            }

            $data = $response->json();

            return [
                'city' => $data['location']['name'],
                'country' => $data['location']['country'],
                'temperature' => $data['current']['temp_c'],
                'condition' => $data['current']['condition']['text'],
                'humidity' => $data['current']['humidity'],
                'wind_speed' => $data['current']['wind_kph'],
                'last_updated' => $data['current']['last_updated'],
            ];
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return ['error' => 'Сталася помилка при з’єднанні з сервісом погоди.'];
        }
    }
}
