<?php

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
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {return view('login');});

/* Login */
Route::get('/Login', [LoginController::class, 'index'])->name('login');
Route::post('/proses_login', [LoginController::class, 'proses_login']);

/* Logout */
Route::get('/Logout', [LoginController::class, 'Logout'])->name('logout');

/* Dashboard */
Route::get('/Dashboard', [LoginController::class, 'Dashboard'])->name('dashboard');

/* Kriteria */
Route::get('/Kriteria', [KriteriaController::class, 'index'])->name('Kriteria');
Route::get('/Kriteria/ahp_kriteria', [KriteriaController::class, 'ahp_kriteria'])->name('ahp_kriteria');
Route::post('/Kriteria/ahp_kriteria', [KriteriaController::class, 'ahp_kriteria'])->name('ahp_kriteria');
Route::get('/Kriteria/reset', [KriteriaController::class, 'reset'])->name('reset');
Route::get('/Kriteria/tambah', [KriteriaController::class, 'tambah'])->name('kriteria.tambah');
Route::get('/Kriteria/edit/{id_kriteria}', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::get('/Kriteria/destroy/{id_kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
Route::post('/Kriteria/simpan', [KriteriaController::class, 'simpan']);
Route::post('/Kriteria/update/{id_kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');

/* Sub Kriteria */
Route::get('/SubKriteria', [SubKriteriaController::class, 'index'])->name('SubKriteria');
Route::post('/SubKriteria/simpan', [SubKriteriaController::class, 'simpan']);
Route::post('/SubKriteria/edit/{id_sub_kriteria}', [SubKriteriaController::class, 'edit'])->name('subkriteria.edit');
Route::get('/SubKriteria/destroy/{id_sub_kriteria}', [SubKriteriaController::class, 'destroy'])->name('subkriteria.destroy');
Route::get('/SubKriteria/ahp_subkriteria/{id_kriteria}', [SubKriteriaController::class, 'ahp_subkriteria'])->name('ahp_subkriteria');
Route::post('/SubKriteria/ahp_subkriteria/{id_kriteria}', [SubKriteriaController::class, 'ahp_subkriteria'])->name('ahp_subkriteria');
Route::get('/SubKriteria/reset/{id_kriteria}', [SubKriteriaController::class, 'reset'])->name('reset');

/* Alternatif */
Route::get('/Alternatif', [AlternatifController::class, 'index'])->name('Alternatif');
Route::get('/Alternatif/tambah', [AlternatifController::class, 'tambah'])->name('alternatif.tambah');
Route::get('/Alternatif/edit/{id_alternatif}', [AlternatifController::class, 'edit'])->name('alternatif.edit');
Route::get('/Alternatif/destroy/{id_alternatif}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');
Route::post('/Alternatif/simpan', [AlternatifController::class, 'simpan']);
Route::post('/Alternatif/update/{id_alternatif}', [AlternatifController::class, 'update'])->name('alternatif.update');

/* Penilaian */
Route::get('/Penilaian', [PenilaianController::class, 'index'])->name('Penilaian');
Route::post('/Penilaian/tambah', [PenilaianController::class, 'tambah']);
Route::post('/Penilaian/edit', [PenilaianController::class, 'edit']);
Route::get('/Penilaian/kategori/{kategori}', [PenilaianController::class, 'kategori'])->name('penilaian.kategori');

/* Perhitungan */
Route::get('/Perhitungan', [PerhitunganController::class, 'index'])->name('Perhitungan');
Route::get('/Perhitungan/kategori/{kategori}', [PerhitunganController::class, 'kategori'])->name('perhitungan.kategori');

/* Hasil */
Route::get('/Hasil', [HasilController::class, 'index'])->name('Hasil');
Route::get('/Hasil/kategori/{kategori}', [HasilController::class, 'kategori'])->name('hasil.kategori');

/* Laporan */
Route::get('/Laporan/{kategori}', [HasilController::class, 'laporan'])->name('Laporan');

/* User */
Route::get('/User', [UserController::class, 'index'])->name('User');
Route::get('/User/tambah', [UserController::class, 'tambah'])->name('user.tambah');
Route::post('/User/simpan', [UserController::class, 'simpan']);
Route::get('/User/edit/{id_user}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/User/update/{id_user}', [UserController::class, 'update'])->name('user.update');
Route::get('/User/destroy/{id_user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/User/detail/{id_user}', [UserController::class, 'detail'])->name('user.detail');

/* Profile */
Route::get('/Profile', [ProfileController::class, 'index'])->name('Profile');
Route::post('/Profile/update/{id_user}', [ProfileController::class, 'update'])->name('profile.update');
