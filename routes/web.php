<?php

use App\Http\Controllers\jurusanController;
use App\Http\Controllers\kriteriaController;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\logController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\keputusanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('log', LogController::class);
    Route::resource('keputusan', KeputusanController::class);
    
    Route::get('/mhsdownloadPdf', [MahasiswaController::class, 'mhsdownloadPdf']);
    Route::get('/kridownloadPdf', [KriteriaController::class, 'kridownloadPdf']);
    Route::get('/jurdownloadPdf', [JurusanController::class, 'jurdownloadPdf']);
    Route::get('/pendownloadPdf', [PenilaianController::class, 'pendownloadPdf']);
    Route::get('/logdownloadPdf', [PenilaianController::class, 'logdownloadPdf']);
    Route::get('/kepdownloadPdf', [KeputusanController::class, 'kepdownloadPdf']);
    
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});
Route::resource('login', LoginController::class);

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');