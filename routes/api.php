<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/userslist', [UserController::class, 'index']);

Route::get('users', [UserController::class, 'show']);

Route::get('/types', [UserController::class, 'getTypes']);

Route::get('/types/{name}', [UserController::class, 'getSingleType']);

Route::get('/user/{id}', [UserController::class, 'getRestaurant']);

Route::post('/order', [OrderController::class, 'store']);

Route::get('/filtercategories', [UserController::class, 'multifilter']);
