<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\IssuanceController;

Route::resource('items', ItemController::class);

// STOCKS
Route::resource('stocks', StockController::class);

// STOCK TRANSACTIONS
Route::resource('stock-transactions', StockTransactionController::class);
//VIEW ISSUANCE
Route::resource('issuances', IssuanceController::class);
//VIEW STOCK CARD
Route::get('/items/{item}/stockcard', [App\Http\Controllers\ItemController::class, 'stockcard'])->name('items.stockcard');

use App\Http\Controllers\InventoryController;

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
