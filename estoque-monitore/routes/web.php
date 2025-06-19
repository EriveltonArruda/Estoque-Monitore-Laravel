<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\StockExitController;
use App\Http\Controllers\DashboardController;

Route::resource('categorias', CategoryController::class)->parameters(['categorias' => 'category']);
Route::resource('fornecedores', SupplierController::class)->parameters(['fornecedores' => 'supplier']);
Route::resource('produtos', ProductController::class)->parameters(['produtos' => 'product']);
Route::resource('entradas', StockEntryController::class)->parameters(['entradas' => 'stock_entry']);
Route::resource('saidas', StockExitController::class)->parameters(['saidas' => 'stock_exit']);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
