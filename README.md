## Setup
Make sure you have PHP version 8.1, MySQL database and [composer](https://getcomposer.org/) installed. 

Copy the `.env.example` into a `.env` file and change the database username and password (DB_USERNAME and DB_PASSWORD) accordingly

## Linux

### Installation

`sudo apt-get install php php-xml php-curl php-mysql mysql-server`

`composer update`

### Running the project

`php artisan serve`

#### With docker:

`php artisan sail:install`

`./vendor/bin/sail up -d`

## Testing

`php artisan test`


## Available routes

### GET

`/api/balance` - view current balance in BTC and EUR

`/api/transactions` - view all transactions

### POST

`/api/transactions` - creates a transfer from your unspent transactions

Request body example: 
```json 
{
    "amount": 5
}