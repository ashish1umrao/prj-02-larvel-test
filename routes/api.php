<?php

use App\Http\Controllers\Api\AuthController;
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

// NEW ROUTS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/test', function (Request $request) {
    return 'Authenticated';
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
Route::post('/get-post-data',[AuthController::class,'GetPostData']);
Route::post('/forgot-password',[AuthController::class,'forgetPassword']);
Route::post('/reset-password',[AuthController::class,'resetPassword']);
Route::post('/VerifyEmail',[AuthController::class,'VerifyEmail']);
Route::post('/checkEmailUnique',[AuthController::class,'checkEmailUnique']);

Route::post('/logout', [AuthController::class, 'logout']);
});
