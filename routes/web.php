<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $routes = Route::getRoutes();
    $collection = [];
    foreach ($routes as $value) {
        if (Str::startsWith($value->uri, 'api')) {
            $collection[] = collect($value)->only(['uri', 'methods'])
                ->map(fn ($item, $key) => $key == 'methods' ? $item[0] : $item);
        }
    }

    return $collection;
});
