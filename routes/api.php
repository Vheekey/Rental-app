<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
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

Route::get('statistics', [HomeController::class, 'apiStatistics']);

Route::prefix('books')->group(function(){
    Route::post('/', [BookController::class, 'store']);
    Route::get('/', [BookController::class, 'index']);
    Route::get('{book}', [BookController::class, 'show']);
    Route::put('{book}', [BookController::class, 'update']);
    Route::delete('{book}', [BookController::class, 'destroy']);
});

Route::prefix('equipments')->group(function(){
    Route::post('/', [EquipmentController::class, 'store']);
    Route::get('/', [EquipmentController::class, 'index']);
    Route::get('{equipment}', [EquipmentController::class, 'show']);
    Route::put('{equipment}', [EquipmentController::class, 'update']);
    Route::delete('{equipment}', [EquipmentController::class, 'destroy']);
});
