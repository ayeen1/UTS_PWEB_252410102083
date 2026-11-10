<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
| Semua halaman diarahkan ke PageController (pola MVC).
| Tiap route diberi nama dengan ->name() supaya di view cukup memanggil route('nama').
*/

// Halaman login (form)
Route::get('/', [PageController::class, 'loginForm'])->name('login');

// Proses form login (POST + @csrf), lalu redirect ke dashboard?username=...
Route::post('/login', [PageController::class, 'login'])->name('login.proses');

// Halaman setelah login. Username dibawa lewat query string: /dashboard?username=ren
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
