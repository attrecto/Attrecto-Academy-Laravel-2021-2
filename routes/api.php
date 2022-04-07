<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
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

Route::prefix('courses')->group(function () {
    Route::middleware(['auth:api','role:admin'])->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/{id}', [CourseController::class, 'show']);
        Route::post('/', [CourseController::class, 'store']);
        Route::delete('/{course}', [CourseController::class, 'destroy']);
        Route::put('/{course}', [CourseController::class, 'update']);
    });
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/me', [AuthController::class, 'me']);
    Route::put('/users/{user}', [UserController::class, 'update']);
});

Route::group([
    'prefix' => 'auth',
    'middleware' => 'auth:api'
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::post('/auth/login', [AuthController::class, 'login']);
