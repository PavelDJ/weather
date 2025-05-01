# Laravel Weather App

Це простий Laravel-додаток для отримання поточної погоди за допомогою API [WeatherAPI.com](https://www.weatherapi.com/).

---

## Встановлення та запуск

1. Клонуйте репозиторій:
```bash
https://github.com/PavelDJ/weather.git
```

2. Встановіть залежності:
```bash
composer install
```

3. Створіть .env файл:
```bash
cp .env.example .env
```

4. Згенеруйте ключ додатку:
```bash
php artisan key:generate
```

5. Вкажіть API-ключ погоди у `.env`:
```
WEATHER_API_KEY=ваш_ключ_від_weatherapi.com
```

6. Створи порожній файл database.sqlite:
```bash
New-Item -ItemType File -Path database\database.sqlite
```

7. Запуск міграцій:
```bash
php artisan migrate
```

8. Очистіть кеш:
```bash
php artisan config:clear
```

9. Запустіть сервер:
```bash
php artisan serve
```

10. Відкрийте в браузері:
```
http://localhost:8000/weather
```

10. Запуск тестів:
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

