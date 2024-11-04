<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('home');

// user
//Route::resource('user', Usercontroller::class);
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('user/list', [UserController::class, 'list'])->name('user.list');

//Level
Route::get('/level', [LevelController::class, 'index'])->name('level.index');
Route::get('/level/create', [LevelController::class, 'create'])->name('level.create');
Route::post('/level', [LevelController::class, 'store'])->name('level.store');
Route::get('/level/{id}/edit', [LevelController::class, 'edit'])->name('level.edit');
Route::put('/level/{id}/update', [LevelController::class, 'update'])->name('level.update');
Route::get('/level/show/{id}', [LevelController::class, 'show'])->name('level.show');
Route::delete('/level/{id}/destroy', [LevelController::class, 'destroy'])->name('level.destroy');
Route::post('level/list', [LevelController::class, 'list'])->name('level.list');

//Kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
Route::get('/kategori/show/{id}', [KategoriController::class, 'show'])->name('kategori.show');
Route::delete('/kategori/{id}/destroy', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::post('kategori/list', [KategoriController::class, 'list'])->name('kategori.list');

//Barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}/update', [BarangController::class, 'update'])->name('barang.update');
Route::get('/barang/show/{id}', [BarangController::class, 'show'])->name('barang.show');
Route::delete('/barang/{id}/destroy', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::post('barang/list', [BarangController::class, 'list'])->name('barang.list');

//Stok
Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
Route::get('/stok/create', [StokController::class, 'create'])->name('stok.create');
Route::post('/stok', [StokController::class, 'store'])->name('stok.store');
Route::get('/stok/{id}/edit', [StokController::class, 'edit'])->name('stok.edit');
Route::put('/stok/{id}/update', [StokController::class, 'update'])->name('stok.update');
Route::get('/stok/show/{id}', [StokController::class, 'show'])->name('stok.show');
Route::delete('/stok/{id}/destroy', [StokController::class, 'destroy'])->name('stok.destroy');
Route::post('stok/list', [StokController::class, 'list'])->name('stok.list');


//Penjualan
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::put('/penjualan/{id}/update', [PenjualanController::class, 'update'])->name('penjualan.update');
Route::get('/penjualan/show/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
Route::delete('/penjualan/{id}/destroy', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
Route::post('penjualan/list', [PenjualanController::class, 'list'])->name('penjualan.list');
