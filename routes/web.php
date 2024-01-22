<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\IndoRegionController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PenjualTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\WarungController;
use App\Models\Rekening;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

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

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/pembeliregister', [AuthController::class, "pembeliregister"])->name('pembeliregister');
Route::get('/penjualregister', [AuthController::class, "penjualregister"])->name('penjualregister');
Route::post('/pembeliregister', [AuthController::class, "dopembeliregister"])->name('do.pembeliregister');
Route::post('/penjualregister', [AuthController::class, "dopenjualregister"])->name('do.penjualregister');
// IndoRegion
Route::get('selectProvince', [IndoRegionController::class, 'province'])->name('provinsi.index');
Route::get('selectRegency/{id}', [IndoRegionController::class, 'regency']);

// ADMIN
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    // PENJUAL
    Route::get('/penjual', [AdminController::class, 'penjual']);
    Route::get('/penjual/{id}', [AdminController::class, 'showPenjual']);
    // PEMBELI
    Route::get('/pembeli', [AdminController::class, 'pembeli']);
    Route::get('/pembeli/{id}', [AdminController::class, 'showPembeli']);
    // WARUNG
    Route::get('/warung', [AdminController::class, 'warung']);
    Route::get('/warung/{id}', [AdminController::class, 'showWarung']);
    Route::get('/warung/product/{id}', [AdminController::class, 'showProduct']);
    Route::get('/warung/{id}/edit', [AdminController::class, 'editWarung']);
    Route::put('/warung/{id}', [AdminController::class, 'updateWarung']);
    // TRANSACTION
    Route::get('/transaction', [AdminController::class, 'transaction']);
    Route::get('/transaction/{transaction}', [AdminController::class, 'showTransaction'])->name("detail.transaction");
});

// PENJUAL
Route::prefix('penjual')->middleware('auth:penjual')->group(function () {
    Route::get('/dashboard', [PenjualController::class, 'warung']);
    // WARUNG
    Route::get('/warung', [WarungController::class, 'index']);
    Route::get('/warung/add', [WarungController::class, 'create']);
    Route::post('/warung', [WarungController::class, 'store']);
    Route::get('/warung/{id}', [WarungController::class, 'show']);
    Route::get('/warung/{id}/edit', [WarungController::class, 'edit']);
    Route::put('/warung/{id}', [WarungController::class, 'update']);
    Route::get('/warung/{id}/delete', [WarungController::class, 'destroy']);
    // REKENING
    Route::get('/rekening', [RekeningController::class, 'index']);
    Route::get('/rekening/add', [RekeningController::class, 'create']);
    Route::post('/rekening', [RekeningController::class, 'store']);
    Route::get('/rekening/{id}', [RekeningController::class, 'show']);
    Route::get('/rekening/{id}/edit', [RekeningController::class, 'edit']);
    Route::put('/rekening/{id}', [RekeningController::class, 'update']);
    Route::get('/rekening/{id}/delete', [RekeningController::class, 'destroy']);
    // PRODUCT
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/add', [ProductController::class, 'create']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::get('/product/{id}/delete', [ProductController::class, 'destroy']);
    // TRANSACTION
    Route::get('/transaction', [PenjualTransactionController::class, 'index']);
    Route::get('/transaction/{transaction}', [PenjualTransactionController::class, 'show'])->name("detail-transaction");
    Route::get('/transaction/{id}/edit', [PenjualTransactionController::class, 'edit']);
    Route::put('/transaction/{id}', [PenjualTransactionController::class, 'update'])->name("update-transaction");
    // PROFILE
    Route::get("/profile/{id}", [PenjualController::class, "penjualProfile"]);
    Route::put("/profile/{id}", [PenjualController::class, "penjualUpdate"]);
    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/get-data', [LaporanController::class, 'getData'])->name('laporan.getData');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');
    Route::get('/laporan/topproduct', [LaporanController::class, 'showTopProducts']);
    Route::get('/laporan/topproduct/data', [LaporanController::class, 'getTopProducts']);
});


// PEMBELI
Route::get('/', [PembeliController::class, 'landingpage']);
Route::get('/product/{id}', [PembeliController::class, 'detailProduct']);
Route::get('/getProductDetails/{id}', [ProductController::class, 'getProductDetails']);
Route::get('/warung', [PembeliController::class, 'warung']);
Route::get('/warung/{id}', [PembeliController::class, 'detailWarung']);
Route::get('/maps', [PembeliController::class, 'maps']);
Route::get('maps/{id}', [PembeliController::class, 'getRoute'])->name('cek-rute');
// PROFILE
Route::get('/profile/{id}', [ProfileController::class, 'profile']);
Route::get('/profile/transaction/{transaction}', [ProfileController::class, 'detailTransaction']);
Route::get('/profile/{id}/edit', [ProfileController::class, 'editProfile']);
Route::put('/profile/{id}', [ProfileController::class, 'updateProfile']);
// CART
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('addToCart');
Route::patch('/cart/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');
Route::get('/checkoutpage', [CartController::class, 'checkoutPage']);
// CHECKOUT
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
Route::get('/success', [CheckoutController::class, 'success']);
