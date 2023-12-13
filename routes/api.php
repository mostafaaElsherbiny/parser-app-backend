<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')
->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    Route::get('/articles', [ArticleController::class, 'index']);

    Route::get('/articles/categories', [ArticleController::class, 'getAllAvailableCategories']);
});

Route::controller(AuthController::class)->prefix('auth')->group(
    function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
    }
);
