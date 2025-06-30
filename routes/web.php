<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';
