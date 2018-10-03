# openweather
Assessment app for OpenWeatherApp

Use "curl -x http://localhost:8000/api/v1/wind/89101" for the API resource

Use "php artisan cache:clear" to clear the cache, did not see a need to write a custom console command to clear the cache when this is readily available.

OpenWeatherApp API Key is stored in the OpenWeather config file.

GuzzleHttp dependency used instead of cURL to fetch API from OpenWeather.

Please let me know your thoughts and critiques on this and what I could have done better.

Thank you!
