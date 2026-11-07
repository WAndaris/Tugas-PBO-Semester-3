<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman daftar jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])
    ->name('jadwal.index');

// Halaman detail berdasarkan ID
Route::get('/jadwal/{id}', [JadwalController::class, 'show'])
    ->name('jadwal.show');

// Halaman jadwal berdasarkan slug dosen
Route::get('/dosen/{slug}', [JadwalController::class, 'perDosen'])
    ->name('dosen.jadwal');