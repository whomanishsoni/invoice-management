<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RawanaController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ReportsController;
// use App\Http\Controllers\VehicleAssignmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/app', function () {
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');


Route::prefix('customers')->name('customers.')->group(function () {
    Route::get('search', [CustomerController::class, 'search'])->name('search');
    Route::get('data', [CustomerController::class, 'data'])->name('data');
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('{customer}', [CustomerController::class, 'show'])->name('show');
    Route::get('{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::put('{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('{customer}', [CustomerController::class, 'destroy'])->name('destroy');
});

Route::prefix('vendors')->name('vendors.')->group(function () {
    Route::get('search', [VendorController::class, 'search'])->name('search');
    Route::get('/', [VendorController::class, 'index'])->name('index');
    Route::get('create', [VendorController::class, 'create'])->name('create');
    Route::post('/', [VendorController::class, 'store'])->name('store');
    Route::get('{vendor}', [VendorController::class, 'show'])->name('show');
    Route::get('{vendor}/edit', [VendorController::class, 'edit'])->name('edit');
    Route::put('{vendor}', [VendorController::class, 'update'])->name('update');
    Route::delete('{vendor}', [VendorController::class, 'destroy'])->name('destroy');
});

Route::prefix('rawanas')->name('rawanas.')->group(function () {
    Route::get('/', [RawanaController::class, 'index'])->name('index');
    Route::get('pending-purchases', [RawanaController::class, 'listPendingurchases'])->name('pending-purchases');
    Route::get('create', [RawanaController::class, 'create'])->name('create');
    Route::post('/', [RawanaController::class, 'store'])->name('store');
    Route::get('{rawana}', [RawanaController::class, 'show'])->name('show');
    Route::get('{rawana}/edit', [RawanaController::class, 'edit'])->name('edit');
    Route::put('{rawana}', [RawanaController::class, 'update'])->name('update');
    Route::delete('{rawana}', [RawanaController::class, 'destroy'])->name('destroy');
});

Route::prefix('purchases')->name('purchases.')->group(function () {
    Route::get('/', [PurchasesController::class, 'index'])->name('index');
    Route::get('create/{rawana?}', [PurchasesController::class, 'create'])->name('create');
    Route::post('/', [PurchasesController::class, 'store'])->name('store');
    Route::get('{purchase}', [PurchasesController::class, 'show'])->name('show');
    Route::get('{purchase}/edit', [PurchasesController::class, 'edit'])->name('edit');
    Route::put('{purchase}', [PurchasesController::class, 'update'])->name('update');
    Route::delete('{purchase}', [PurchasesController::class, 'destroy'])->name('destroy');
});

Route::prefix('sales')->name('sales.')->group(function () {
    Route::get('/', [SalesController::class, 'index'])->name('index');
    Route::get('create/{rawana?}', [SalesController::class, 'create'])->name('create');
    Route::post('/', [SalesController::class, 'store'])->name('store');
    Route::get('{sale}', [SalesController::class, 'show'])->name('show');
    Route::get('{sale}/edit', [SalesController::class, 'edit'])->name('edit');
    Route::put('{sale}', [SalesController::class, 'update'])->name('update');
    Route::delete('{sale}', [SalesController::class, 'destroy'])->name('destroy');
    Route::get('{sale}/invoice', [SalesController::class, 'createInvoice'])->name('invoice');
});

// Route::prefix('transactions')->name('transactions.')->group(function () {
//     Route::get('/', [TransactionsController::class, 'index'])->name('index');
//     Route::get('in', [TransactionsController::class, 'index'])->name('in.index');
//     Route::get('out', [TransactionsController::class, 'index'])->name('out.index');
//     Route::get('create/{type}', [TransactionsController::class, 'create'])->name('create'); // Requires type parameter
//     Route::post('/', [TransactionsController::class, 'store'])->name('store');
//     Route::get('{transaction}', [TransactionsController::class, 'show'])->name('show');
//     Route::get('{transaction}/edit', [TransactionsController::class, 'edit'])->name('edit');
//     Route::put('{transaction}', [TransactionsController::class, 'update'])->name('update');
//     Route::delete('{transaction}', [TransactionsController::class, 'destroy'])->name('destroy');

//     Route::get('customer-total/{customerId}', [TransactionsController::class, 'getCustomerTotal'])->name('customer.total');
//     Route::get('vendor-total/{vendorId}', [TransactionsController::class, 'getVendorTotal'])->name('vendor.total');
//     Route::get('vehicle-total/{vehicleId}', [TransactionsController::class, 'getVehicleTotal'])->name('vehicle.total');
// });

// Route::prefix('reports')->name('reports.')->group(function () {
//     Route::get('sale', [ReportsController::class, 'saleReport'])->name('sale');
//     Route::get('transaction/{type}', [ReportsController::class, 'transactionReport'])->name('transaction');
// });

Route::middleware('set.default.variables')->group(function () {
    // Define your routes here
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [TransactionsController::class, 'index'])->name('index');
        Route::get('in', [TransactionsController::class, 'index'])->name('in.index');
        Route::get('out', [TransactionsController::class, 'index'])->name('out.index');
        Route::get('create/{type}', [TransactionsController::class, 'create'])->name('create'); // Requires type parameter
        Route::post('/', [TransactionsController::class, 'store'])->name('store');
        Route::get('{transaction}', [TransactionsController::class, 'show'])->name('show');
        Route::get('{transaction}/edit', [TransactionsController::class, 'edit'])->name('edit');
        Route::put('{transaction}', [TransactionsController::class, 'update'])->name('update');
        Route::delete('{transaction}', [TransactionsController::class, 'destroy'])->name('destroy');

        Route::get('customer-total/{customerId}', [TransactionsController::class, 'getCustomerTotal'])->name('customer.total');
        Route::get('vendor-total/{vendorId}', [TransactionsController::class, 'getVendorTotal'])->name('vendor.total');
        Route::get('vehicle-total/{vehicleId}', [TransactionsController::class, 'getVehicleTotal'])->name('vehicle.total');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('sale', [ReportsController::class, 'saleReport'])->name('sale');
        Route::get('transaction/{type}', [ReportsController::class, 'transactionReport'])->name('transaction');
    });
});

// Route::prefix('vehicle-assignments')->name('vehicle-assignments.')->group(function () {
//     Route::get('/', [VehicleAssignmentController::class, 'index'])->name('index');
//     Route::get('create/{rawana?}', [VehicleAssignmentController::class, 'create'])->name('create');
//     Route::post('/', [VehicleAssignmentController::class, 'store'])->name('store');
//     Route::get('{assignment}', [VehicleAssignmentController::class, 'show'])->name('show');
//     Route::get('{assignment}/edit', [VehicleAssignmentController::class, 'edit'])->name('edit');
//     Route::put('{assignment}', [VehicleAssignmentController::class, 'update'])->name('update');
//     Route::delete('{assignment}', [VehicleAssignmentController::class, 'destroy'])->name('destroy');
// });

Route::prefix('products')->name('products.')->group(function () {
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('{product}', [ProductController::class, 'show'])->name('show');
    Route::get('{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::prefix('taxes')->name('taxes.')->group(function () {
    Route::get('/', [TaxController::class, 'index'])->name('index');
    Route::get('create', [TaxController::class, 'create'])->name('create');
    Route::post('/', [TaxController::class, 'store'])->name('store');
    Route::get('{tax}', [TaxController::class, 'show'])->name('show');
    Route::get('{tax}/edit', [TaxController::class, 'edit'])->name('edit');
    Route::put('{tax}', [TaxController::class, 'update'])->name('update');
    Route::delete('{tax}', [TaxController::class, 'destroy'])->name('destroy');
});

Route::prefix('vehicles')->name('vehicles.')->group(function () {
    Route::get('/', [VehicleController::class, 'index'])->name('index');
    Route::get('create', [VehicleController::class, 'create'])->name('create');
    Route::post('/', [VehicleController::class, 'store'])->name('store');
    Route::get('{vehicle}', [VehicleController::class, 'show'])->name('show');
    Route::get('{vehicle}/edit', [VehicleController::class, 'edit'])->name('edit');
    Route::put('{vehicle}', [VehicleController::class, 'update'])->name('update');
    Route::delete('{vehicle}', [VehicleController::class, 'destroy'])->name('destroy');
});
