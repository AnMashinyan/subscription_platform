<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;
use App\Http\Middleware\WebsiteController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Mail\Demomail;
Route::get('/', function () {
    return view('welcome');
});
Route::prefix('website')->group(function () {
    Route::get('/', [WebsiteController::class, 'index']);
    Route::get('/create', [WebsiteController::class, 'create']);
    Route::get('/delete', [WebsiteController::class, 'delete']);

});
