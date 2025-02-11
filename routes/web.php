<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SaidaProdutoController;

Route::view('/', 'welcome');

Route::resource('clientes', ClienteController::class)->names([
    'index' => 'clientes.index',    // Nome para o índice
    'create' => 'clientes.create',  // Nome para a criação
    'store' => 'clientes.store',    // Nome para armazenar
    'show' => 'clientes.show',      // Nome para mostrar
    'edit' => 'clientes.edit',      // Nome para editar
    'update' => 'clientes.update',  // Nome para atualizar
    'destroy' => 'clientes.destroy', // Nome para destruir
]);

Route::resource('categorias', CategoriaController::class)->names([
    'index' => 'categorias.index',   
    'create' => 'categorias.create',  
    'store' => 'categorias.store',  
    'show' => 'categorias.show', 
    'edit' => 'categorias.edit',
    'update' => 'categorias.update', 
    'destroy' => 'categorias.destroy', 
]);

Route::resource('unidades', UnidadeController::class)->names([
    'index' => 'unidades.index',   
    'create' => 'unidades.create',  
    'store' => 'unidades.store',  
    'show' => 'unidades.show', 
    'edit' => 'unidades.edit',
    'update' => 'unidades.update', 
    'destroy' => 'unidades.destroy', 
]);

Route::resource('produtos', ProdutoController::class)->names([
    'index' => 'produtos.index',    // Nome para o índice
    'create' => 'produtos.create',  // Nome para a criação
    'store' => 'produtos.store',    // Nome para armazenar
    'show' => 'produtos.show',      // Nome para mostrar
    'edit' => 'produtos.edit',      // Nome para editar
    'update' => 'produtos.update',  // Nome para atualizar
    'destroy' => 'produtos.destroy', // Nome para destruir
]);

// Rotas de Saídas de Estoque
Route::resource('saidas', SaidaProdutoController::class)->names([
    'index' => 'saidas.index',
    'create' => 'saidas.create',       // Para registrar uma nova saída
    'store' => 'saidas.store',         // Para salvar a saída
    'show' => 'saidas.show',           // Para exibir os detalhes da saída
    'edit' => 'saidas.edit',           // Para editar uma saída (se necessário)
    'update' => 'saidas.update',       // Para atualizar uma saída
    'destroy' => 'saidas.destroy',     // Para excluir uma saída
]);

// Rotas personalizadas para registrar saídas específicas de um produto
Route::get('/saidas/create/{produto}', [SaidaProdutoController::class, 'create'])->name('saidas.create.produto');
Route::get('/saidas', [SaidaProdutoController::class, 'index'])->name('saidas.index');
Route::get('/saidas/show', [SaidaProdutoController::class, 'show'])->name('saidas.show.produto');
// Route::get('/saidas/confirmar/{id}', [SaidaController::class, 'confirmarSaida'])->name('saidas.confirmar');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

Route::get('/socialite/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
