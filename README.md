install php (v8.1)
install mysql server


@php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan package:discover --ansi
php artisan vendor:publish --tag=laravel-assets --ansi --force
php artisan key:generate --ansi