<?php

// Load all controllers from routes

use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/login');
});

Route::get('/docs', function () {
    return view('swagger.index');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

    Route::get('typography', function () {
        return view('pages.typography');
    })->name('typography');

// Car
    Route::get('cars', [CarsController::class, 'index'])->name('cars');
    Route::get('cars-create', [CarsController::class, 'create']);
    Route::post('cars-create', [CarsController::class, 'store']);
    Route::get('cars/{id}/edit', [CarsController::class, 'edit'])->name('carsEdit');
    Route::put('update-cars/{id}', [CarsController::class, 'update']);
    Route::delete('delete-car/{id}', [CarsController::class, 'destroy']);

// End Car

// Car Model
    Route::get('cars_model', [CarModelController::class, 'index'])->name('modelIndex');
    Route::get('cars-model/create', [CarModelController::class, 'create'])->name('modelCreate');
    Route::post('cars-model/create', [CarModelController::class, 'store']);
    Route::get('cars-model/{id}/edit', [CarModelController::class, 'edit'])->name('modelEdit')->where('id', '[0-9]+');
    Route::put('update-cars-model/{id}', [CarModelController::class, 'update']);
    Route::delete('delete-car-model/{id}', [CarModelController::class, 'destroy']);
// End Car Model

// Category
    Route::get('category', [CategoryController::class, 'index'])->name('CategoryIndex');
    Route::get('create-category', [CategoryController::class, 'create'])->name('modelCreate');
    Route::post('create-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{id}/edit', [CategoryController::class, 'edit'])->name('modelEdit')->where('id', '[0-9]+');
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);
// End Categoty

// FAQ Section

    Route::get('faq', [FaqController::class, 'index'])->name('faqIndex');

// End

// FAQ Section

    Route::get('cms', [CmsController::class, 'index'])->name('cmsIndex');

// End

});

Route::group(['middleware' => 'auth'], function () {
    //Route::resource('users', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('users', ['as' => 'users.index', 'uses' => 'App\Http\Controllers\UserController@index']);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
