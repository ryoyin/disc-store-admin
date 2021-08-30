<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiscController;
use App\Http\Controllers\CategoryController;

// use function PHPSTORM_META\map;

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

Route::get('/', function() {
    return response(['message' => 'alive']);
});

Route::prefix('user')->group(function() {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/token', [UserController::class, 'getToken']);
});

Route::prefix('disc')->group(function() {
    Route::get('/all', [DiscController::class, 'all']);
    Route::get('/detail/{id}', [DiscController::class, 'detail']);
});

Route::prefix('category')->group(function () {
    Route::get('/all', [CategoryController::class, 'all']);
    Route::get('/{slug}/discs', [CategoryController::class, 'getDiscs']);
});

// auth is required on below routes (bearer token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/testauth', function() {
        return response(['message' => 'test ok']);
    });

    Route::prefix('user')->group(function() {
        Route::get('/detail', function () {
            return response(Auth::user());
        });
    });
});