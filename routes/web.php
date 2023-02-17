<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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

//Ruta para la página principal
Route::get('/', function () {
    return view('index');
})->name('index');

//Ruta para la página de Dónde estamos
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

//~~Resource routes "Events"~~

//Ruta para unirse a un evento
Route::post('/events/{event}/join', [EventController::class, 'join'])->name('events.join')->middleware('auth');
//Ruta para dejar un evento
Route::delete('/events/{event}/leave', [EventController::class, 'leave'])->name('events.leave')->middleware('auth');
//Ruta para ver los eventos
Route::resource('events', EventController::class)->only(['index'])
    ->parameters(['event' => 'slug'])
    ->missing(function () {
        return Redirect::route('index');
    });
//Rutas para crear, ver, editar y eliminar eventos
Route::resource('events', EventController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy'])->middleware('auth')
    ->parameters(['event' => 'slug'])
    ->missing(function () {
        return Redirect::route('events.index');
    });

//~~Resource routes "Messages"~~

//Ruta para crear un mensaje
Route::resource('messages', MessageController::class)->only(['create', 'store']);
//Rutas para ver, editar y eliminar mensajes
Route::resource('messages', MessageController::class)->only(['index', 'destroy', 'show'])->middleware('auth');

//~~Resource routes "Users"~~

//Ruta para ver los usuarios
Route::resource('users', UserController::class)->only(['index']);
//Rutas para ver, editar y eliminar usuarios
Route::resource('users', UserController::class)->only(['show', 'edit', 'update', 'destroy'])->middleware('auth');
