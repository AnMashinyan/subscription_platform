<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;
use App\Http\Middleware\WebsiteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('website')->group(function () {
    Route::get('/', [WebsiteController::class, 'index']);
    Route::get('/create', [WebsiteController::class, 'create']);
    Route::get('/delete', [WebsiteController::class, 'delete']);

});
Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/create', [PostController::class, 'create']);

    Route::get('/delete',[PostController::class,'delete']);
});
Route::prefix('subscribe')->group(function () {
    Route::get('/', [SubscriberController::class, 'index']);
    Route::post('/create', [SubscriberController::class, 'create']);
    Route::get('/delete', [SubscriberController::class, 'delete']);
});




