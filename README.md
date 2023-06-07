<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## What To Prepare?
Make sure you have installed all of this requirement

- Laravel 8
- PHP 8
- MongoDB ^4.2
- Composer ^2.*

## Guide To Use Project

1. Download or clone the project first using `git`
2. Go to the downloaded project directory `cd ..\<path>\<to>\<your project>\Test_Inosoft_Kendaraan`
3. Enter command `composer install`
4. Copy the `.env.example` and rename it to `.env` and setup your `.env` like below:
    
        DB_CONNECTION=mongodb
        DB_HOST=127.0.0.1
        DB_PORT=27017
        DB_DATABASE=<database name>
        DB_USERNAME=<username>
        DB_PASSWORD=<password>
        
   fill the DB_DATABASE with your database name (without '<' and '>'), username and password is optional

5. Run `php artisan key:generate` command to generate APP_KEY on `.env`.
6. Run `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"` before `php artisan jwt:secret` command to generate JWT_SECRET on `.env`. This part is important to make the project produce JWT Token.

7. After that, run `php artisan migrate` to create table from laravel. If you need some dummy data, you can add additional command `--seed` like this one `php artisan migrate --seed`.

8. Last step, run `php artisan serve` to run the project. Enjoy!

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).