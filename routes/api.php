<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChefController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    // Auth User Routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/user/all', [AuthController::class, 'getAll']);
    Route::get('/user/{id}', [AuthController::class, 'getUser']);
    Route::put('/user/{id}/update', [AuthController::class, 'updateUser']);
    Route::delete('/user/{id}/delete', [AuthController::class, 'deleteUser']);


});

Route::group([
    'middleware' => 'api',
    'prefix' => 'chef'

], function ($router) {
    // Chef Database Routes
    Route::post('/upload', [ChefController::class, 'upload']);
    Route::get('/get-chef/{type}', [ChefController::class, 'getChef']);
});
