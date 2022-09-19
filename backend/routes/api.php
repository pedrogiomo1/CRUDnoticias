<?php

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
/* prefixo: /api */
Route::post('/create', [App\Http\Controllers\NewsController::class, 'create']);
Route::get('/read', [App\Http\Controllers\NewsController::class, 'read']);
Route::get('/read/{id}', [App\Http\Controllers\NewsController::class, 'readById']);
Route::post('/update/{id}', [App\Http\Controllers\NewsController::class, 'update']);
Route::delete('/delete/{id}', [App\Http\Controllers\NewsController::class, 'delete']);

//user
Route::prefix('user')->group(function () {
    Route::post('/', [App\Http\Controllers\UserController::class, 'createUser']);
    Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
    Route::post('/verify', [App\Http\Controllers\UserController::class, 'verifyData']);
});