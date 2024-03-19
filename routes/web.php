<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AlternativeValuesController;
use App\Http\Controllers\HasilPenilaianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubKriteriaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
  return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('/home', [HomeController::class, 'index'])->name('home');

  Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
  Route::get('/alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
  Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
  Route::get('/alternatif/{alternatif}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
  Route::put('/alternatif/{alternatif}', [AlternatifController::class, 'update'])->name('alternatif.update');
  Route::delete('/alternatif/{alternatif}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

  Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
  Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
  Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
  Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
  Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
  Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

  Route::get('/sub-kriteria', [SubKriteriaController::class, 'index'])->name('sub-kriteria.index');
  Route::get('/sub-kriteria/create', [SubKriteriaController::class, 'create'])->name('sub-kriteria.create');
  Route::post('/sub-kriteria', [SubKriteriaController::class, 'store'])->name('sub-kriteria.store');
  Route::get('/sub-kriteria/{subKriteria}/edit', [SubKriteriaController::class, 'edit'])->name('sub-kriteria.edit');
  Route::put('/sub-kriteria/{subKriteria}', [SubKriteriaController::class, 'update'])->name('sub-kriteria.update');
  Route::delete('/sub-kriteria/{subKriteria}', [SubKriteriaController::class, 'destroy'])->name('sub-kriteria.destroy');

  Route::get('/penilaian', [AlternativeValuesController::class, 'index'])->name('penilaian.index');
  Route::get('/penilaian/create', [AlternativeValuesController::class, 'create'])->name('penilaian.create');
  Route::post('/penilaian', [AlternativeValuesController::class, 'store'])->name('penilaian.store');
  Route::get('/penilaian/{alternativeValues}', [AlternativeValuesController::class, 'show'])->name('penilaian.show');
  Route::get('/penilaian/{alternativeValues}/edit', [AlternativeValuesController::class, 'edit'])->name('penilaian.edit');
  Route::put('/penilaian/{alternativeValues}', [AlternativeValuesController::class, 'update'])->name('penilaian.update');
  Route::delete('/penilaian/{alternativeValues}', [AlternativeValuesController::class, 'destroy'])->name('penilaian.destroy');

  Route::get('/hasil-penilaian', [HasilPenilaianController::class, 'index'])->name('hasil-penilaian.index');

  Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
