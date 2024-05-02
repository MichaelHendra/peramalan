<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KotabaruController;
use App\Http\Controllers\prediksiController;

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
    return view('dashboard');
});

// PRODUK 
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/tambah', [ProdukController::class, 'create']);
Route::post('/produk/store', [ProdukController::class, 'store']);
Route::get('/produk/edit/{id_produk}', [ProdukController::class, 'edit']);
Route::put('/produk/update/{id_produk}', [ProdukController::class, 'update']);
Route::get('/produk/delete/{id_produk}', [ProdukController::class, 'delete']);
Route::get('/produk/destroy/{id_produk}', [ProdukController::class, 'destroy']);
Route::get('/produk/trash', [ProdukController::class, 'trash']);
Route::get('/produk/restore/{id_produk?}', [ProdukController::class, 'restore']);
Route::get('/produk/deleteall/{id_produk?}', [ProdukController::class, 'deleteall']);
Route::get('/produk/cetak', [ProdukController::class, 'cetak'])->name('produk');

// PENJUALAN KOTABARU 
Route::get('/kotabaru', [KotabaruController::class, 'index']);
Route::get('/kotabaru/tambah', [KotabaruController::class, 'create']);
Route::post('/kotabaru/store', [KotabaruController::class, 'store']);
Route::get('/kotabaru/edit/{id_penjualan}', [KotabaruController::class, 'edit']);
Route::put('/kotabaru/update/{id_penjualan}', [KotabaruController::class, 'update']);
Route::get('/kotabaru/delete/{id_penjualan}', [KotabaruController::class, 'delete']);
Route::get('/kotabaru/destroy/{id_penjualan}', [KotabaruController::class, 'destroy']);
Route::get('/kotabaru/trash', [KotabaruController::class, 'trash']);
Route::get('/kotabaru/restore/{id_penjualan?}', [KotabaruController::class, 'restore']);

Route::get('/peramalan',[prediksiController::class, 'index']);
Route::get('/peramalan/masuk',[prediksiController::class, 'create']);
Route::post('/peramalan/store',[prediksiController::class, 'store']);
Route::get('/peramalan/detail/{id}',[prediksiController::class, 'detail']);

