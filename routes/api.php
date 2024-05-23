<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PemetaanController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\MitraController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/wilayah/{wilayah}", [PemetaanController::class, "getWilayah"]);
Route::get("/dealer", [DealerController::class, "listDealer"]);
Route::get("/mitra", [MitraController::class, "listMitra"]);