<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login-authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'isAdminOrWaiter'])->group(function () {
    Route::resource('/menu', MenuController::class);
    Route::get('/deleted-menu', [MenuController::class, 'deleted'])->name('deleted-menu');
    Route::get('/restore-menu/{id}', [MenuController::class, 'restore'])->name('restore-menu');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/meja', MejaController::class);
    Route::resource('user',UserController::class);

});

Route::middleware(['auth', 'isWaiter'])->group(function () {
    Route::resource('/customer', PelangganController::class);
    Route::resource('/pesanan', PesananController::class);
    Route::get('/create-pesanan/{id}', [PesananController::class, 'create'])->name('pesanan-for');
    Route::post('/add-pesanan/{id}', [PesananController::class, 'store'])->name('add-pesanan');
    Route::post('/edit-pesanan/{id}/{id_pengguna}', [PesananController::class, 'update'])->name('edit-pesanan');
    Route::delete('/delete-pesanan/{id}/{id_pengguna}', [PesananController::class, 'destroy'])->name('delete-pesanan');
});

Route::middleware(['auth', 'isKasir'])->group(function () {
    Route::resource('/transaksi', TransaksiController::class);
    Route::post('/checkout/{id}', [TransaksiController::class, 'store'])->name('checkout');
    Route::get('/transaksi-history', [TransaksiController::class, 'history'])->name('transaksi-history');
    Route::get('/receipt/{id}', [TransaksiController::class, 'receipt'])->name('receipt');
});

Route::middleware(['auth'], ['isOwnerOrWaiterOrKasir'])->group(function () {
    Route::get('/export-transaksi', [TransaksiController::class, 'export'])->name('export-transaksi');
    Route::get('/export-pesanan', [PesananController::class, 'export'])->name('export-pesanan');
    Route::get('/export-menu', [MenuController::class, 'export'])->name('export-menu');
});
