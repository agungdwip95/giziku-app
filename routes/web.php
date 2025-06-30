<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\EdukasiGiziController;
use App\Http\Controllers\PengukuranGiziController;

Route::get('/login', [CustomAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomAuthController::class, 'login']);
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('/register', [CustomAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [CustomAuthController::class, 'register']);

Route::get('/', function () {
    // return view('welcome');
    // return redirect('/login');
    return redirect('/dashboard');
});

Route::get('/dashboard','App\Http\Controllers\HomeController@index')->name('dashboard');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user-pdf', [UserController::class, 'cetak_pdf'])->name('user.pdf');

Route::get('/balita', [BalitaController::class, 'index'])->name('balita.index');
Route::get('/balita/create', [BalitaController::class, 'create'])->name('balita.create');
Route::post('/balita', [BalitaController::class, 'store'])->name('balita.store');
Route::get('/balita/{id}/edit', [BalitaController::class, 'edit'])->name('balita.edit');
Route::put('/balita/{id}', [BalitaController::class, 'update'])->name('balita.update');
Route::delete('/balita/{id}', [BalitaController::class, 'destroy'])->name('balita.destroy');
Route::get('/balita-pdf', [BalitaController::class, 'cetak_pdf'])->name('balita.pdf');

Route::get('/edukasi', [EdukasiGiziController::class, 'index'])->name('edukasi_gizi.index');
Route::get('/edukasi/create', [EdukasiGiziController::class, 'create'])->name('edukasi_gizi.create');
Route::post('/edukasi', [EdukasiGiziController::class, 'store'])->name('edukasi_gizi.store');
Route::get('/edukasi/{id}/edit', [EdukasiGiziController::class, 'edit'])->name('edukasi_gizi.edit');
Route::put('/edukasi/{id}', [EdukasiGiziController::class, 'update'])->name('edukasi_gizi.update');
Route::delete('/edukasi/{id}', [EdukasiGiziController::class, 'destroy'])->name('edukasi_gizi.destroy');
Route::get('/edukasi-pdf', [EdukasiGiziController::class, 'cetak_pdf'])->name('edukasi_gizi.pdf');

Route::get('/pengukuran_gizi', [PengukuranGiziController::class, 'index'])->name('pengukuran_gizi.index');
Route::get('/pengukuran_gizi/create', [PengukuranGiziController::class, 'create'])->name('pengukuran_gizi.create');
Route::post('/pengukuran_gizi', [PengukuranGiziController::class, 'store'])->name('pengukuran_gizi.store');
Route::get('/pengukuran_gizi/{id}/edit', [PengukuranGiziController::class, 'edit'])->name('pengukuran_gizi.edit');
Route::put('/pengukuran_gizi/{id}', [PengukuranGiziController::class, 'update'])->name('pengukuran_gizi.update');
Route::delete('/pengukuran_gizi/{id}', [PengukuranGiziController::class, 'destroy'])->name('pengukuran_gizi.destroy');
Route::get('/pengukuran_gizi-pdf', [PengukuranGiziController::class, 'cetak_pdf'])->name('pengukuran_gizi.pdf');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
