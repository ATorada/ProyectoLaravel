<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
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

//Cookie settings, cookie policy, privacy policy y terms
Route::get('/cookie-settings', function () {
    return view('static.cookie_settings');
})->name('cookie-settings');

Route::get('/cookie-policy', function () {
    return view('static.cookie_policy');
})->name('cookie-policy');

Route::get('/privacy-policy', function () {
    return view('static.privacy_policy');
})->name('privacy-policy');

Route::get('/terms', function () {
    return view('static.terms');
})->name('terms');


//Auth routes
Route::get('/register', [LoginController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Resource routes "Events"
Route::post('/events/{event}/join', [EventController::class, 'join'])->name('events.join');
Route::delete('/events/{event}/leave', [EventController::class, 'leave'])->name('events.leave');
Route::resource('events', EventController::class);

//Resource routes "Messages"
Route::resource('messages', MessageController::class);

//Resource routes "Users"
Route::resource('users', UserController::class);


