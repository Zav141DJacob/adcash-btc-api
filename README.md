## Setup
Make sure you have PHP version 8.1 and composer installed. 
See composer [documentation](https://getcomposer.org/) for installation.


## Testing
Run php artisan test.


install php (v8.1)
install mysql server


@php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan package:discover --ansi
php artisan vendor:publish --tag=laravel-assets --ansi --force
php artisan key:generate --ansi