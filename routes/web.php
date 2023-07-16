<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SlipGajiController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\JenisPemasukanPengeluaranController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpendingProductController;
use App\Http\Controllers\SupplierController;
use App\Models\Kasbon;
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

    Route::get("/kasbon", [KasbonController::class, "index"])->name('kasbon.index');
    Route::get("/kasbon/create", [KasbonController::class, "create"])->name('kasbon.create');
    Route::post("/kasbon/create", [KasbonController::class, "store"])->name('kasbon.create.post');
    Route::get("/kasbon/update/{id}", [KasbonController::class, "show"])->name('kasbon.update');
    Route::put("/kasbon/update/{id}", [KasbonController::class, "update"])->name('kasbon.update.post');
    Route::delete("/kasbon/delete/{id}", [KasbonController::class, "delete"])->name('kasbon.delete.post');
    Route::get("/kasbon/export/{type}/{filter}", [KasbonController::class, "export"])->name('kasbon.export');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => '/auth', 'middleware' => 'guest'], function () {
    Route::get("/login", [AuthController::class, "index"])->name('auth.login');
    Route::post("/login", [AuthController::class, "login"])->name('auth.login.post');
});

// Route::get('/', function () {
//     return redirect("/auth/login");
// });
