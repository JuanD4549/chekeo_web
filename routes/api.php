<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
Route::prefix('access')->group(function () {
    Route::post('/set-in', [\App\Http\Controllers\AccessController::class, 'setIn'])->name('api.access.setIn');
    Route::post('/set-out', [\App\Http\Controllers\AccessController::class, 'setOut'])->name('api.access.setOut');
});
