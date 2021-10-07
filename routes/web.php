<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\api\AuthController;

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
    return redirect('/login');
});

 Route::resource('/cars', CarsController::class);

 Route::get('/docs', function () {
    return view('swagger.index');
});

// Route::get('/forgot',[AuthController::class, 'forgot']);
Route::post('/forgot-password',[CarsController::class, 'forgotPassword']);

Route::get('/dashboard1', function () {
    return "Hi there";
})->name('dashboard1');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard2', function () {
        return "Hi there 2";
    })->name('dashboard2');
});
