<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/where', function () {
    return view('where');
})->name('where');

//Resource routes "Events"
Route::resource('events', EventController::class);

//Resource routes "Messages"
Route::resource('messages', MessageController::class);

//Resource routes "Users"
Route::resource('users', UserController::class);
