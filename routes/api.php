<?php


use Illuminate\Http\Request;
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
    function ($router) {
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::get('/me', [JWTController::class, 'me']);
    Route::post('/verify', [JWTController::class, 'verify']);



    //Post related 
    Route::resource('/post', PostController::class);
    //workaround php  7 does not parse multi part form data unless the request method is POST 
    // https://github.com/laravel/framework/issues/13457
    Route::post('/post/{id}', 'PostController@update');
});
