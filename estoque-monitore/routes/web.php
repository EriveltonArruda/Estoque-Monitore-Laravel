<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\StockExitController;
use App\Http\Controllers\Auth\LoginController; // Rota do Login
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Grupo de rotas que exigem autenticação
Route::middleware(['auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

  Route::resource('categorias', CategoryController::class)->parameters(['categorias' => 'category']);
  Route::resource('fornecedores', SupplierController::class)->parameters(['fornecedores' => 'supplier']);
  Route::resource('produtos', ProductController::class)->parameters(['produtos' => 'product']);
  Route::resource('entradas', StockEntryController::class)->parameters(['entradas' => 'stock_entry']);
  Route::resource('saidas', StockExitController::class)->parameters(['saidas' => 'stock_exit']);

  Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
  Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

  // Rota para fazer o logout do usuário
  Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

// Rotas de autenticação que NÃO exigem estar logado
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
