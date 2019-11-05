<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Project Setup

``` bash


# install project
composer install

# deploy DB
php artisan migrate

# add initial data
composer dump-autoload
php artisan db:seed

# initial front-end
cd /var/www/atlas/
npm i
npm run dev

```