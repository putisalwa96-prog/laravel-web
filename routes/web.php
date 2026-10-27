<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('pelanggan', PelangganController::class);

Route::get('/', fn() => redirect()->route('biodata.index'));
Route::resource('biodata', BiodataController::class)->parameters([
    'biodata' => 'biodata',
]);

Route::post('pengalaman', [PengalamanController::class, 'store'])->name('pengalaman.store');
Route::put('pengalaman/{pengalaman}', [PengalamanController::class, 'update'])->name('pengalaman.update');
Route::delete('pengalaman/{pengalaman}', [PengalamanController::class, 'destroy'])->name('pengalaman.destroy');

Route::post('dokumen', [DokumenController::class, 'store'])->name('dokumen.store');
Route::delete('dokumen/{dokuman}', [DokumenController::class, 'destroy'])->name('dokumen.destroy');
Route::put('dokumen/{dokuman}', [DokumenController::class, 'update'])->name('dokumen.update');

Route::post('biodata/{biodata}/foto', [BiodataController::class, 'updateFoto'])->name('biodata.foto');
