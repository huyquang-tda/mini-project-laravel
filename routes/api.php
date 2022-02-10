<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Admin\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']); 
    Route::get('/profile', [AuthController::class, 'profile']);   
    Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::post('password/forgot', [PasswordController::class, 'forgot']);
    Route::post('password/reset', [PasswordController::class, 'reset'])->name('reset');
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
