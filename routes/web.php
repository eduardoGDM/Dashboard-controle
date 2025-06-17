<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/unauthorized', 'unauthorized')->name('unauthorized');

// Rotas de autenticação
Route::controller(AuthController::class)->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout')->name('logout');
    });
});

// Rotas protegidas da dashboard
Route::prefix('dashboard')->middleware('auth')->name('dashboard.')->group(function () {
    Route::view('/', 'dashboard.home')->name('home');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::patch('/usuarios/{user}/ativar', [UsuarioController::class, 'ativar'])->name('usuarios.ativar');

    Route::view('/configuracoes', 'dashboard.configuracoes.index')->name('configuracoes');
    Route::get('/relatorios', [RelatorioController::class, 'grafico'])->name('relatorios.index');
    Route::post('/vendas/{id}/aprovar', [VendaController::class, 'aprovar'])->name('vendas.aprovar');

    // Adiciona as rotas automáticas de resource
    Route::resource('produtos', ProdutoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('vendas', VendaController::class);
    Route::resource('usuarios', UsuarioController::class);
});
