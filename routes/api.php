<?php

use App\Http\Controllers\AuthController;
use App\Http\Resources\RegisterRoundResource;
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
        //LogOut
        Route::get('logout',[\App\Http\Controllers\AuthController::class,'logout']);
        //Access
        Route::prefix('access')->group(function () {
            Route::post('/set-in', [\App\Http\Controllers\AccessController::class, 'setIn'])->name('api.access.setIn');
            Route::post('/set-out', [\App\Http\Controllers\AccessController::class, 'setOut'])->name('api.access.setOut');
        });
        Route::prefix('place')->group(function () {
            Route::get('/places', [\App\Http\Controllers\PlaceController::class, 'places'])->name('api.place.places');
            Route::get('/user-place', [\App\Http\Controllers\PlaceController::class, 'user_place'])->name('api.place.user_place');
        });
        Route::prefix('branche')->group(function () {
            Route::get('/branches', [\App\Http\Controllers\BrancheController::class, 'branches'])->name('api.branche.branches');
            Route::get('/user-branche', [\App\Http\Controllers\BrancheController::class, 'user_branche'])->name('api.branche.user_branche');
        });
        Route::prefix('registerRound')->group(function () {
            Route::get('/index', [\App\Http\Controllers\RegisterRoundController::class, 'index'])->name('api.registerRound.index');
            Route::post('/store', [\App\Http\Controllers\RegisterRoundController::class, 'store'])->name('api.registerRound.store');
            Route::post('/update', [\App\Http\Controllers\RegisterRoundController::class, 'update'])->name('api.registerRound.update');
        });

        Route::prefix('round')->group(function () {
            Route::post('/store', [\App\Http\Controllers\RoundController::class, 'store'])->name('api.round.store');
        });

        Route::prefix('registerNovelty')->group(function () {
            Route::get('/index', [\App\Http\Controllers\NoveltyRegistrationController::class, 'index'])->name('api.registerNovelty.index');
            Route::post('/store', [\App\Http\Controllers\NoveltyRegistrationController::class, 'store'])->name('api.registerNovelty.store');
            Route::post('/update', [\App\Http\Controllers\NoveltyRegistrationController::class, 'update'])->name('api.registerNovelty.update');
        });

        Route::prefix('novelty')->group(function () {
            Route::get('/index', [\App\Http\Controllers\NoveltyController::class, 'index'])->name('api.novelty.index');
        });

        Route::prefix('user')->group(function () {
            Route::get('/index', [\App\Http\Controllers\UserController::class, 'index'])->name('api.user.index');
        });

        Route::prefix('registerVisit')->group(function () {
            Route::get('/index', [\App\Http\Controllers\RegistrationVisitController::class, 'index'])->name('api.registerVisit.index');
            Route::post('/store', [\App\Http\Controllers\RegistrationVisitController::class, 'store'])->name('api.registerVisit.store');
            Route::post('/update', [\App\Http\Controllers\RegistrationVisitController::class, 'update'])->name('api.registerVisit.update');
        });

        Route::prefix('visit')->group(function () {
            Route::get('/index', [\App\Http\Controllers\VisitController::class, 'index'])->name('api.visit.index');
            Route::post('/show', [\App\Http\Controllers\VisitController::class, 'show'])->name('api.visit.show');
            Route::post('/store', [\App\Http\Controllers\VisitController::class, 'store'])->name('api.visit.store');
        });

        Route::prefix('visitCar')->group(function () {
            Route::get('/index', [\App\Http\Controllers\VisitCarController::class, 'index'])->name('api.visitCar.index');
            Route::post('/show', [\App\Http\Controllers\VisitCarController::class, 'show'])->name('api.visitCar.show');
            Route::post('/store', [\App\Http\Controllers\VisitCarController::class, 'store'])->name('api.visitCar.store');
        });
    });
