<?php

use App\Http\Controllers\AuthController;
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

Route::view('/', 'welcome')->name('home');
Route::view('/unauthorized', 'unauthorized')->name('unauthorized');

// Agrupamento das rotas de autenticação
Route::controller(AuthController::class)->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {

        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');

        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register');

        Route::post('/logout', 'logout')->name('logout');
    });
});

// Dashboard protegido
Route::get('/dashboard', function () {
    return view('dashboard.home');
})->middleware('auth')->name('dashboard.home');
