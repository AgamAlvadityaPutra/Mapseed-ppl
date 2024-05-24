<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\PemetaanController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\BenihController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramMemberController;
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

Route::get('/', [HomeController::class, "home"])->name("home");

Route::get("/login", [AuthController::class, "loginView"])->name("login");
Route::post("/login", [AuthController::class, "login"])->name("login");
Route::get("/lupa-password", [AuthController::class, "lupaPasswordView"])->name("lupa password");
Route::post("/lupa-password", [AuthController::class, "buatToken"])->name("buat token");
Route::get("/reset-password/{token}", [AuthController::class, "resetPasswordView"])->name("reset password");
Route::post("/reset-password/{token}", [AuthController::class, "resetPassword"])->name("reset password");
Route::get("/register", [AuthController::class, "registerView"])->name("register");
Route::post("/register", [AuthController::class, "registerUser"])->name("register");

Route::get("/logout", [AuthController::class, "logout"])->name("logout");
Route::get("/akun", [AuthController::class, "akunView"])->name("akun");
Route::get("/akun-edit", [AuthController::class, "akunEditView"])->name("akun edit");
Route::post("/akun-edit", [AuthController::class, "akunEdit"])->name("akun edit");
Route::get("/profile/{role}/{id}", [AuthController::class, "profile"])->name("mitra");

Route::get("/akun-dinas", [DinasController::class, "akunDinasView"])->name("akun dinas");
Route::get("/tambah-dinas", [DinasController::class, "tambahDinasView"])->name("tambah dinas");
Route::post("/tambah-dinas", [DinasController::class, "tambahDinas"])->name("tambah dinas");
Route::get("/profile-dinas", [DinasController::class, "profile"])->name("profile dinas");

Route::get("/pemetaan", [PemetaanController::class, "index"])->name("pemetaan");
Route::get("/pemetaan-lahan", [PemetaanController::class, "dashboard"])->name("pemetaan lahan");
Route::get("/tambah-wilayah", [PemetaanController::class, "tambahDataWilayahView"])->name("tambah wilayah");
Route::post("/tambah-wilayah", [PemetaanController::class, "tambahDataPemetaan"])->name("tambah wilayah");
Route::get("/edit-wilayah", [PemetaanController::class, "editDataWilayahView"])->name("edit wilayah");
Route::post("/edit-wilayah", [PemetaanController::class, "editDataWilayah"])->name("edit wilayah");

Route::get("/dealer", [DealerController::class, "listView"])->name("dealer");
Route::get("/dealer/{id}", [DealerController::class, "profileView"])->name("dealer profile");

Route::get("/mitra", [MitraController::class, "listView"])->name("mitra");
Route::get("/mitra/{id}", [MitraController::class, "profileView"])->name("mitra profile");

Route::get("/galeri", [BenihController::class, "galeriView"])->name("galeri");
Route::get("/tambah-benih", [BenihController::class, "tambahView"])->name("tambah");
Route::post("/tambah-benih", [BenihController::class, "tambah"])->name("tambah");
Route::get("/edit-benih/{id}", [BenihController::class, "editView"])->name("edit");
Route::post("/edit-benih/{id}", [BenihController::class, "edit"])->name("edit");
Route::get("/detail-benih/{id}", [BenihController::class, "detailView"])->name("detail");

Route::get("/program", [ProgramController::class, "index"])->name("program");
Route::get("/program/{id}", [ProgramController::class, "detailProgram"])->name("detail program");
Route::get("/tambah-program", [ProgramController::class, "tambahProgramView"])->name("tambah program");
Route::post("/tambah-program", [ProgramController::class, "tambahProgram"])->name("tambah program");
Route::get("/ubah-program/{id}", [ProgramController::class, "ubahProgramView"])->name("ubah program");
Route::post("/ubah-program/{id}", [ProgramController::class, "ubahProgram"])->name("ubah program");
Route::get("/daftar-program/{id}", [ProgramMemberController::class, "daftarView"])->name("daftar program");
Route::post("/daftar-program/{id}", [ProgramMemberController::class, "daftar"])->name("daftar program");
Route::get("/pendaftar-program/{id}", [ProgramController::class, "listPendaftarView"])->name("list pendaftar");

Route::get("/artikel", [ArtikelController::class, "index"])->name("artikel");
Route::get("/artikel/{id}", [ArtikelController::class, "detail"])->name("detail artikel");
Route::get("/tambah-artikel", [ArtikelController::class, "tambahView"])->name("tambah artikel");
Route::post("/tambah-artikel", [ArtikelController::class, "tambah"])->name("tambah artikel");
Route::get("/ubah-artikel/{id}", [ArtikelController::class, "ubahView"])->name("ubah artikel");
Route::post("/ubah-artikel/{id}", [ArtikelController::class, "ubah"])->name("ubah artikel");