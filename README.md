# Laravel Weather App

Це простий Laravel-додаток для отримання поточної погоди за допомогою API [WeatherAPI.com](https://www.weatherapi.com/).

---

## Встановлення та запуск

1. Клонуйте репозиторій або розпакуйте архів:
```bash
https://github.com/PavelDJ/weather
```

2. Встановіть залежності:
```bash
composer install
```

3. Згенеруйте ключ додатку:
```bash
php artisan key:generate
```

4. Вкажіть API-ключ погоди у `.env`:
```
WEATHER_API_KEY=ваш_ключ_від_weatherapi.com
```

5. Якщо використовується SQLite:
```bash
mkdir database
type nul > database/database.sqlite
```

6. Очистіть кеш:
```bash
php artisan config:clear
php artisan cache:clear
```

7. Запустіть сервер:
```bash
php artisan serve
```

8. Відкрийте в браузері:
```
http://localhost:8000/weather
```

9. Запуск тестів:
```bash
php artisan test
```

---

## Архітектура та пояснення рішень

- Використано **Laravel 10 LTS** — стабільна довгострокова версія.
- Запити до API винесено в **сервіс** `WeatherService` (`app/Services`) для дотримання SRP та SOLID.
- **Контролер** `WeatherController` (`app/Http/Controllers`) відповідає лише за HTTP-запити.
- Дані API-ключа зберігаються у `.env` та читаються через `config/services.php`.
- Інтерфейс створено у **Twig-шаблоні** `resources/views/weather.twig.php` з адаптивною версткою та стилізацією.
- Є **модульний тест** для сервісу з використанням `Http::fake()` (`tests/Unit/WeatherServiceTest.php`).
- Уся логіка чітко розділена: шаблони, HTTP, сервіси, конфігурація.

