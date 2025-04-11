<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//Route Admin

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/admin/login', [AdminController::class, 'loginIndex']);

Route::post('/admin/login/proses', [AdminController::class, 'loginProses']);

Route::get('/admin/logout', [AdminController::class, 'logout']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::get('/admin/karyawan', [KaryawanController::class, 'karyawan']);

Route::post('/admin/karyawan/email/validasi', [KaryawanController::class, 'validasiEmail']);

Route::post('/admin/karyawan/tambah', [KaryawanController::class, 'tambahKaryawan']);

Route::post('/admin/karyawan/ubah', [KaryawanController::class, 'ubahKaryawan']);

Route::post('/admin/karyawan/hapus', [KaryawanController::class, 'hapusKaryawan']);

Route::get('/admin/shift', [ShiftController::class, 'shift']);

Route::post('/admin/shift/tambah', [ShiftController::class, 'tambahShift']);

Route::post('/admin/shift/ubah', [ShiftController::class, 'ubahShift']);

Route::post('/admin/shift/hapus', [ShiftController::class, 'hapusShift']);

Route::get('/admin/absensi', [AbsensiController::class, 'absensi']);

Route::post('/admin/absensi/filter', [AbsensiController::class, 'filterAbsensi']);

Route::post('/admin/absensi/pratinjau', [AbsensiController::class, 'pratinjauRekap']);

Route::get('/admin/gantiPassword', [AdminController::class, 'gantiPassword']);

Route::post('/admin/gantiPassword/proses', [AdminController::class, 'gantiPasswordProses']);

Route::get('/admin/organisasi', [OrganisasiController::class, 'organisasi']);

Route::post('/admin/organisasi/tambah', [OrganisasiController::class, 'tambahOrganisasi']);

Route::post('/admin/organisasi/ubah', [OrganisasiController::class, 'ubahOrganisasi']);

Route::post('/admin/organisasi/hapus', [OrganisasiController::class, 'hapusOrganisasi']);

Route::get('/admin/pinjaman', [PinjamanController::class, 'pinjaman']);

Route::post('/admin/pinjaman/tambah', [PinjamanController::class, 'tambahPinjaman']);

Route::post('/admin/pinjaman/ubah', [PinjamanController::class, 'ubahPinjaman']);

Route::post('/admin/pinjaman/hapus', [PinjamanController::class, 'hapusPinjaman']);

Route::post('/admin/pinjaman/unduh', [PinjamanController::class, 'unduhPinjaman']);

Route::post('/admin/pinjaman/pratinjau', [PinjamanController::class, 'pratinjauPinjaman']);

Route::get('/admin/cuti', [CutiController::class, 'cuti']);

Route::post('/admin/cuti/tambah', [CutiController::class, 'tambahCuti']);

Route::post('/admin/cuti/ubah', [CutiController::class, 'ubahCuti']);

Route::post('/admin/cuti/hapus', [CutiController::class, 'hapusCuti']);

Route::post('/admin/cuti/getJabatan', [CutiController::class, 'getJabatan']);

//Route User

Route::get('/', function () {
    return redirect('/user/login');
});

Route::get('/user/login', [UserController::class, 'loginIndex']);

Route::post('/user/login/proses', [UserController::class, 'loginProses']);

Route::get('/user/logout', [UserController::class, 'logout']);

Route::get('/user/dashboard', [UserController::class, 'dashboard']);

Route::get('/user/gantiPassword', [UserController::class, 'gantiPassword']);

Route::post('/user/gantiPassword/proses', [UserController::class, 'gantiPasswordProses']);

Route::get('/user/profil', [UserController::class, 'profil']);

Route::post('/user/profil/gantiFoto', [UserController::class, 'gantiFoto']);

Route::get('/user/absensi/{in_out}', [UserController::class, 'absensi']);

Route::post('/user/absensi/proses', [UserController::class, 'absensiProses']);

Route::post('/user/absensi/getFoto', [UserController::class, 'getFoto']);

Route::get('/user/tentang', [UserController::class, 'tentang']);

Route::get('/user/lupaPassword', [UserController::class, 'lupaPassword']);

Route::post('/user/lupaPassword/proses', [UserController::class, 'lupaPasswordProses']);

Route::get('/user/lupaPassword/{nip}/{email}', [UserController::class, 'gantiLupaPassword']);

Route::post('/user/lupaPassword/gantiPassword', [UserController::class, 'gantiLupaPasswordProses']);

Route::get('/user/catatanKehadiran', [UserController::class, 'catatanKehadiran']);

Route::get('/user/riwayatPinjaman', [UserController::class, 'riwayatPinjaman']);

Route::get('/user/riwayatCuti', [UserController::class, 'riwayatCuti']);

Route::get('/foo', function () {
    symlink('/home/laravel/storage/app/public', '/home/public_html/abdul/storage');
});
