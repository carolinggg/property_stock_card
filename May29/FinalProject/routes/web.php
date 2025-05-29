<?php
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\OfficeController;

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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    // STOCKS
Route::resource('stocks', StockController::class)->names('stocks');

// STOCK TRANSACTIONS
Route::resource('stock-transactions', StockController::class);
//VIEW ISSUANCE
Route::resource('issuances', IssuanceController::class)->except(['show']);
Route::get('/items/{item}/stockcard', [App\Http\Controllers\ItemController::class, 'stockcard'])->name('items.stockcard');

Route::get('/inventory-report', [InventoryReportController::class, 'index']);

Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly_report.index');

Route::get('monthly-report/download', [MonthlyReportController::class, 'download'])->name('monthly_report.download');
Route::resource('items', ItemController::class);


//VIEW STOCK CARD

});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 


Route::resource('offices', OfficeController::class);
Route::resource('units', UnitController::class);
Route::get('/issuances/summary', [IssuanceController::class, 'summary'])->name('issuances.summary');

Route::get('/issuances/summary/download', [IssuanceController::class, 'downloadSummaryExcel'])->name('issuances.summary.download');


Route::get('/', function () {
    return view('welcome');
});