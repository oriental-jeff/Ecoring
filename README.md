<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## laravel-backend
1. ```composer install or composer update```
1. edit database in .env file
  ```
  APP_URL=YOUR_APP_URL
  .
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=laravel
  DB_USERNAME=root
  DB_PASSWORD=
  ```
1. ```php artisan key:generate```
1. ```php artisan migrate:fresh --seed ```
1. ```php artisan storage:link```
1. install node js
1. ```npm install```


## Username Password
  url: YOUR_APP_URL/backend
| Role  | Username | Password |
| --- | --- | --- |
| super admin  | admin@admin.com | 12345678 |
| admin  | admin@gmail.com | 12345678 |
| general user  | user@gmail.com | 12345678 |