<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SlipGajiController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\JenisPemasukanPengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpendingProductController;
use App\Http\Controllers\SupplierController;
use App\Models\PengeluaranKas;
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

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get("/", [HomeController::class, "index"])->name('home');
    Route::get("/supplier", [SupplierController::class, "index"])->name('supplier.index');
    Route::get("/supplier/create", [SupplierController::class, "create"])->name('supplier.create');
    Route::post("/supplier/create", [SupplierController::class, "store"])->name('supplier.create.post');
    Route::get("/supplier/update/{id}", [SupplierController::class, "show"])->name('supplier.update');
    Route::put("/supplier/update/{id}", [SupplierController::class, "update"])->name('supplier.update.post');
    Route::delete("/supplier/delete/{id}", [SupplierController::class, "delete"])->name('supplier.delete.post');

    Route::get("/category-product", [CategoryProductController::class, "index"])->name('category-product.index');
    Route::get("/category-product/create", [CategoryProductController::class, "create"])->name('category-product.create');
    Route::post("/category-product/create", [CategoryProductController::class, "store"])->name('category-product.create.post');
    Route::get("/category-product/update/{id}", [CategoryProductController::class, "show"])->name('category-product.update');
    Route::put("/category-product/update/{id}", [CategoryProductController::class, "update"])->name('category-product.update.post');
    Route::delete("/category-product/delete/{id}", [CategoryProductController::class, "delete"])->name('category-product.delete.post');

    Route::get("/product", [ProductController::class, "index"])->name('product.index');
    Route::get("/product/create", [ProductController::class, "create"])->name('product.create');
    Route::post("/product/create", [ProductController::class, "store"])->name('product.create.post');
    Route::get("/product/update/{id}", [ProductController::class, "show"])->name('product.update');
    Route::put("/product/update/{id}", [ProductController::class, "update"])->name('product.update.post');
    Route::delete("/product/delete/{id}", [ProductController::class, "delete"])->name('product.delete.post');

    Route::get("/pembelian-product", [SpendingProductController::class, "index"])->name('pembelian-product.index');
    Route::get("/pembelian-product/create", [SpendingProductController::class, "create"])->name('pembelian-product.create');
    Route::post("/pembelian-product/create", [SpendingProductController::class, "store"])->name('pembelian-product.create.post');
    Route::get("/pembelian-product/update/{id}", [SpendingProductController::class, "show"])->name('pembelian-product.update');
    Route::put("/pembelian-product/update/{id}", [SpendingProductController::class, "update"])->name('pembelian-product.update.post');
    Route::delete("/pembelian-product/delete/{id}", [SpendingProductController::class, "delete"])->name('pembelian-product.delete.post');

    Route::get("/jenis-pemasukan-pengeluaran-kas", [JenisPemasukanPengeluaranController::class, "index"])->name('jenis-pemasukan-pengeluaran-kas.index');
    Route::get("/jenis-pemasukan-pengeluaran-kas/create", [JenisPemasukanPengeluaranController::class, "create"])->name('jenis-pemasukan-pengeluaran-kas.create');
    Route::post("/jenis-pemasukan-pengeluaran-kas/create", [JenisPemasukanPengeluaranController::class, "store"])->name('jenis-pemasukan-pengeluaran-kas.create.post');
    Route::get("/jenis-pemasukan-pengeluaran-kas/update/{id}", [JenisPemasukanPengeluaranController::class, "show"])->name('jenis-pemasukan-pengeluaran-kas.update');
    Route::put("/jenis-pemasukan-pengeluaran-kas/update/{id}", [JenisPemasukanPengeluaranController::class, "update"])->name('jenis-pemasukan-pengeluaran-kas.update.post');
    Route::delete("/jenis-pemasukan-pengeluaran-kas/delete/{id}", [JenisPemasukanPengeluaranController::class, "delete"])->name('jenis-pemasukan-pengeluaran-kas.delete.post');

    Route::get("/pemasukan", [PemasukanController::class, "index"])->name('pemasukan.index');
    Route::get("/pemasukan/create", [PemasukanController::class, "create"])->name('pemasukan.create');
    Route::post("/pemasukan/create", [PemasukanController::class, "store"])->name('pemasukan.create.post');
    Route::get("/pemasukan/update/{id}", [PemasukanController::class, "show"])->name('pemasukan.update');
    Route::put("/pemasukan/update/{id}", [PemasukanController::class, "update"])->name('pemasukan.update.post');
    Route::delete("/pemasukan/delete/{id}", [PemasukanController::class, "delete"])->name('pemasukan.delete.post');
    Route::get("/pemasukan/export/{type}", [PemasukanController::class, "export"])->name('pemasukan.export');

    Route::get("/pengeluaran", [PengeluaranController::class, "index"])->name('pengeluaran.index');
    Route::get("/pengeluaran/create", [PengeluaranController::class, "create"])->name('pengeluaran.create');
    Route::post("/pengeluaran/create", [PengeluaranController::class, "store"])->name('pengeluaran.create.post');
    Route::get("/pengeluaran/update/{id}", [PengeluaranController::class, "show"])->name('pengeluaran.update');
    Route::put("/pengeluaran/update/{id}", [PengeluaranController::class, "update"])->name('pengeluaran.update.post');
    Route::delete("/pengeluaran/delete/{id}", [PengeluaranController::class, "delete"])->name('pengeluaran.delete.post');
    Route::get("/pengeluaran/export/{type}", [PengeluaranController::class, "export"])->name('pengeluaran.export');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => '/auth', 'middleware' => 'guest'], function () {
    Route::get("/login", [AuthController::class, "index"])->name('auth.login');
    Route::post("/login", [AuthController::class, "login"])->name('auth.login.post');
});

// Route::get('/', function () {
//     return view('welcome');
// });
