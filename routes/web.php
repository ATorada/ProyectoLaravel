<?php

use App\Http\Controllers\EventController;
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

//Resource routes "Events"
Route::resource('events', EventController::class);

//Resource routes "Messages"
Route::resource('messages', MessageController::class);

//Resource routes "Users"
Route::resource('users', UserController::class);
