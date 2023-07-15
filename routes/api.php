<?php


use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(
    ['middleware' => 'api',  'namespace' => 'App\Http\Controllers'],
    function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', [JWTController::class, 'login']);
            Route::post('logout', [JWTController::class, 'logout']);
            Route::post('me', [JWTController::class, 'me']);
            Route::post('/verify', [JWTController::class, 'verify']);
            Route::post('/register', [JWTController::class, 'register']);
        });

    //Post related
    Route::resource('/post', PostController::class);
});
