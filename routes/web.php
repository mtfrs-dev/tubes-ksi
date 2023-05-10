<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::controller(MedicineController::class)->as('medicines.')->group(function(){
        Route::get('data-obat', 'index')->name('index');
        Route::post('data-obat', 'store')->name('store');
        Route::post('ubah-data-obat', 'update')->name('update');
    });

    Route::controller(CategoryController::class)->as('categories.')->group(function(){
        Route::get('data-kategori-obat', 'index')->name('index');
        Route::post('data-kategori-obat', 'store')->name('store');
        Route::post('ubah-data-kategori-obat', 'update')->name('update');
    });

    Route::controller(UnitController::class)->as('units.')->group(function(){
        Route::get('data-satuan-obat', 'index')->name('index');
    });

    Route::controller(TransactionController::class)->as('transactions.')->group(function(){
        Route::get('data-transaksi', 'index')->name('index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
