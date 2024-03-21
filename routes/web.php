<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukTitipanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\StokController;
use Illuminate\Support\Facades\Route;
use App\Imports\NamaImpor;
use Maatwebsite\Excel\Facades\Excel;

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

Route::resource('menu', MenuController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('produktitipan', produktitipanController::class);
Route::get('produk/export', [ProdukTitipanController::class, 'export'])->name('produktitipan.export');

Route::post('/import', function () {
    Excel::import(new NamaImpor, request()->file('file'));
    return redirect()->back()->with('success', 'Data berhasil diimpor');
})->name('import');
Route::post('/transaksi/store', 'TransaksiController@store')->name('transaksi.store');

Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
// Route::put('/update-stock/{id}', [ProdukTitipanController::class, 'updateStock']);
Route::resource('jenis', JenisController::class);
Route::resource('stok', stokController::class);
Route::Get('home', [HomeController::class, 'index']);
Route::resource('transaksi', TransaksiController::class);
Route::post('image-upload', [MenuController::class, 'store'])->name('images.store');
