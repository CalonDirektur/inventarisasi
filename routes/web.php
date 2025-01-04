<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionInController;
use App\Http\Controllers\TransactionOutController;
use App\Http\Controllers\ReportGoodsInController;
use App\Http\Controllers\ReportGoodsOutController;
use App\Http\Controllers\ReportStockController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\WebSettingController;
use App\Http\Controllers\AdminatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportFinancialController;
use App\Http\Controllers\PeminjamanController;

// Define the routes for Peminjaman directly
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
Route::get('/peminjaman/{id}/signature', [PeminjamanController::class, 'signature'])->name('peminjaman.signature');
Route::post('/peminjaman/{id}/signature', [PeminjamanController::class, 'saveSignature'])->name('peminjaman.signature.save');
Route::get('barang/code/{code}', [ItemController::class, 'showByCode'])->name('barang.showByCode');

Route::middleware(["localization"])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'auth'])->name('login.auth');
});

Route::middleware(['auth', "localization"])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Barang Routes
    Route::controller(ItemController::class)->prefix("barang")->group(function () {
        Route::get('/', 'index')->name('barang');
        Route::post('/kode', 'detailByCode')->name('barang.code');
        Route::get('/daftar-barang', 'list')->name('barang.list');
        Route::post('/detail', 'detail')->name('barang.detail');

        Route::middleware(['employee.middleware'])->group(function () {
            Route::post('/simpan', 'save')->name('barang.save');
            Route::post('/ubah', 'update')->name('barang.update');
            Route::delete('/hapus', 'delete')->name('barang.delete');
        });
    });

    // Route::get('barang/code/{code}', [ItemController::class, 'showByCode'])->name('barang.showByCode');

    // Jenis Barang Routes
    Route::controller(CategoryController::class)->prefix("barang/jenis")->group(function () {
        Route::get('/', 'index')->name('barang.jenis');
        Route::get('/daftar', 'list')->name('barang.jenis.list');
        Route::middleware(['employee.middleware'])->group(function () {
            Route::post('/simpan', 'save')->name('barang.jenis.save');
            Route::post('/info', 'detail')->name('barang.jenis.detail');
            Route::put('/ubah', 'update')->name('barang.jenis.update');
            Route::delete('/hapus', 'delete')->name('barang.jenis.delete');
        });
    });

    // Satuan Barang Routes
    Route::controller(UnitController::class)->prefix('/barang/satuan')->group(function () {
        Route::get('/', 'index')->name('barang.satuan');
        Route::get('/daftar', 'list')->name('barang.satuan.list');
        Route::middleware(['employee.middleware'])->group(function () {
            Route::post('/simpan', 'save')->name('barang.satuan.save');
            Route::post('/info', 'detail')->name('barang.satuan.detail');
            Route::put('/ubah', 'update')->name('barang.satuan.update');
            Route::delete('/hapus', 'delete')->name('barang.satuan.delete');
        });
    });

    // Merk Barang Routes
    Route::controller(BrandController::class)->prefix("/barang/merk")->group(function () {
        Route::get('/', 'index')->name('barang.merk');
        Route::get('/daftar', 'list')->name('barang.merk.list');
        Route::middleware(['employee.middleware'])->group(function () {
            Route::post('/simpan', 'save')->name('barang.merk.save');
            Route::post('/info', 'detail')->name('barang.merk.detail');
            Route::put('/ubah', 'update')->name('barang.merk.update');
            Route::delete('/hapus', 'delete')->name('barang.merk.delete');
        });
    });

    // Customer Routes
    Route::controller(CustomerController::class)->prefix('/customer')->group(function () {
        Route::get('/', 'index')->name('customer');
        Route::get('/daftar', 'list')->name('customer.list');
        Route::get('/names', 'getCustomerNames')->name('customer.names');
        Route::middleware(['employee.middleware'])->group(function () {
            Route::post('/simpan', 'save')->name('customer.save');
            Route::post('/info', 'detail')->name('customer.detail');
            Route::put('/ubah', 'update')->name('customer.update');
            Route::delete('/hapus', 'delete')->name('customer.delete');
        });
    });

    // Supplier Routes
    Route::controller(SupplierController::class)->prefix('/supplier')->group(function () {
        Route::get('/', 'index')->name('supplier');
        Route::get('/daftar', 'list')->name('supplier.list');
        Route::middleware(['employee.middleware'])->group(function () {
            Route::post('/simpan', 'save')->name('supplier.save');
            Route::post('/info', 'detail')->name('supplier.detail');
            Route::put('/ubah', 'update')->name('supplier.update');
            Route::delete('/hapus', 'delete')->name('supplier.delete');
        });
    });

    // Transaksi Masuk Routes
    Route::controller(TransactionInController::class)->prefix('/transaksi/masuk')->group(function () {
        Route::get('/', 'index')->name('transaksi.masuk');
        Route::get('/list', 'list')->name('transaksi.masuk.list');
        Route::post('/save', 'save')->name('transaksi.masuk.save');
        Route::post('/detail', 'detail')->name('transaksi.masuk.detail');
        Route::put('/update', 'update')->name('transaksi.masuk.update');
        Route::delete('/delete', 'delete')->name('transaksi.masuk.delete');
        Route::get('/barang/list/in', 'listIn')->name('barang.list.in');
    });

    // Transaksi Keluar Routes
    Route::controller(TransactionOutController::class)->prefix('/transaksi/keluar')->group(function () {
        Route::get('/', 'index')->name('transaksi.keluar');
        Route::get('/list', 'list')->name('transaksi.keluar.list');
        Route::post('/simpan', 'save')->name('transaksi.keluar.save');
        Route::post('/info', 'detail')->name('transaksi.keluar.detail');
        Route::put('/ubah', 'update')->name('transaksi.keluar.update');
        Route::delete('/hapus', 'delete')->name('transaksi.keluar.delete');
    });

    // Laporan Barang Masuk Routes
    Route::controller(ReportGoodsInController::class)->prefix('/laporan/masuk')->group(function () {
        Route::get('/', 'index')->name('laporan.masuk');
        Route::get('/list', 'list')->name('laporan.masuk.list');
    });

    // Laporan Barang Keluar Routes
    Route::controller(ReportGoodsOutController::class)->prefix('/laporan/keluar')->group(function () {
        Route::get('/', 'index')->name('laporan.keluar');
        Route::get('/list', 'list')->name('laporan.keluar.list');
    });

    // Laporan Stok Barang Routes
    Route::controller(ReportStockController::class)->prefix('/laporan/stok')->group(function () {
        Route::get('/', 'index')->name('laporan.stok');
        Route::get('/list', 'list')->name('laporan.stok.list');
        Route::get('/grafik', 'grafik')->name('laporan.stok.grafik');
    });

    // Laporan Penghasilan
    Route::get('/report/income', [ReportFinancialController::class, 'income'])->name('laporan.pendapatan');
    Route::get('/total-price', [ReportFinancialController::class, 'getTotalPrice'])->name('total.price');

    // Pengaturan Pengguna
    Route::middleware(['employee.middleware'])->group(function () {
        Route::controller(EmployeeController::class)->prefix('/settings/employee')->group(function () {
            Route::get('/', 'index')->name('settings.employee');
            Route::get('/list', 'list')->name('settings.employee.list');
            Route::post('/save', 'save')->name('settings.employee.save');
            Route::post('/detail', 'detail')->name('settings.employee.detail');
            Route::put('/update', 'update')->name('settings.employee.update');
            Route::delete('/delete', 'delete')->name('settings.employee.delete');
        });
    });

    // Pengaturan Profile
    Route::get('/settings/profile', [ProfileController::class, 'index'])->name('settings.profile');
    Route::post('/settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');

    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.delete');
    Route::get('/items/{id}', [ItemController::class, 'show']);
});
