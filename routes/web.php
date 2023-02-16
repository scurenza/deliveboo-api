<?php

use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BraintreeController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::delete('/profile', [RegisteredUserController::class, 'destroy'])->name('profile.destroy');
    Route::resource('products', ProductController::class);
});

// Route::any('/payment', [BraintreeController::class, 'token'])->name('token')->middleware('auth');

// Route::get('/test', function () {
//     return view('test');
// })->name('test');

require __DIR__ . '/auth.php';
