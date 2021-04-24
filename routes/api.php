<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MovementController;

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

Route::prefix('users')->group(function () {
    Route::post('/register', [UserController::class, 'register'])->name('user.register');
});

Route::middleware('auth:api')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.list');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('user.deleteUser');
    Route::post('/editbalance', [UserController::class, 'editBalance'])->name('user.editBalance');
});

Route::middleware('auth:api')->prefix('movements')->group(function () {
    Route::post('/register', [MovementController::class, 'register'])->name('movement.register');
    Route::get('/{id}', [MovementController::class, 'listMovementUser'])->name('movement.listMovementUser');
    Route::get('/', [MovementController::class, 'index'])->name('movement.list');
    Route::post('/exportcsv', [MovementController::class, 'exportCsv'])->name('movement.exportCsv');
});



