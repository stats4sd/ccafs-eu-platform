## Setup Dev Environment locally:

```
composer install
npm install
cp .env.example .env
```

update .env file with needed details:
 - database details
 - local app url
 - email driver if needed for testing

create the database you specified in the .env file.

```
php artisan key:generate
php artisan migrate:fresh
php artisan backpack:install
```

Optionally clone the database from staging or live for local testing.
