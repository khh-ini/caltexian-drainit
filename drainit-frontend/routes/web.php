<?php

use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DrainaseController;
use App\Http\Controllers\TersumbatController;
use App\Http\Controllers\BanjirController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanBanjirController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RiwayatDitolakController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;

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

// Route::get('/', function () {
//     return "Hallo";
// });




Route::prefix('petugas')->group(function () {
    $controller = PetugasController::class;
    Route::get('/', [$controller, 'index']);
    Route::get('/{id}', [$controller, 'delete']);
    Route::post('/update/{id}', [$controller, 'update']);
    Route::post('/updateFoto/{id}', [$controller, 'updateFoto']);
    Route::get('/detail/{id}', [$controller, 'detail']);
    Route::post('/create', [$controller, 'create']);
    // Route::get('/create/{id}', [$controller, 'create']);
});

Route::prefix('drainase')->group(function () {
    $controller = DrainaseController::class;
    Route::get('/', [$controller, 'index']);
    Route::get('/{id}', [$controller, 'delete']);
    Route::post('/update/{id}', [$controller, 'update']);
    Route::post('/updateFoto/{id}', [$controller, 'updateFoto']);
    Route::get('/detail/{id}', [$controller, 'detail']);
    Route::post('/addDrainase', [$controller, 'addDrainase']);
});

Route::prefix('tersumbat')->group(function () {
    $controller = TersumbatController::class;
    Route::get('/', [$controller, 'index']);
    Route::get('/{id}', [$controller, 'delete']);
    Route::post('/update/{id}', [$controller, 'update']);
    Route::get('/detail/{id}', [$controller, 'detail']);
    Route::post('/addTersumbat', [$controller, 'addTersumbat']);
});

Route::prefix('banjir')->group(function () {
    $controller = BanjirController::class;
    Route::get('/', [$controller, 'index']);
    Route::get('/{id}', [$controller, 'delete']);
    Route::post('/update/{id}', [$controller, 'update']);
    Route::get('/detail/{id}', [$controller, 'detail']);
    Route::post('/addBanjir', [$controller, 'addBanjir']);
});

Route::prefix('peta')->group(function(){
    $controller = PetaController::class;
    Route::get('/',[$controller, 'index']);
});

Route::prefix('laporan')->group(function(){
    $controller = LaporanController::class;
    Route::get('/',[$controller, 'index']);
    Route::get('/verifikasi/{id}', [$controller, 'verifikasi']);
    Route::get('/tolak/{id}', [$controller, 'tolak']);
    Route::get('/detail/{id}', [$controller, 'detail']);
});

Route::prefix('laporanbanjir')->group(function(){
    $controller = LaporanBanjirController::class;
    Route::get('/',[$controller, 'index']);
    Route::get('/verifikasi/{id}', [$controller, 'verifikasi']);
    Route::get('/tolak/{id}', [$controller, 'tolak']);
    Route::get('/detail/{id}', [$controller, 'detail']);
});

Route::prefix('riwayat')->group(function(){
    $controller = RiwayatController::class;
    Route::get('/',[$controller, 'index']);
    Route::get('/detail/{id}', [$controller, 'detail']);
    Route::post('/verifikasi/{id}', [$controller, 'verifikasi']);
});

Route::prefix('riwayatditolak')->group(function(){
    $controller = RiwayatDitolakController::class;
    Route::get('/',[$controller, 'index']);
    Route::get('/detail/{id}', [$controller, 'detail']);
    Route::post('/verifikasi/{id}', [$controller, 'verifikasi']);
});

Route::get('/', [ViewController::class, "index"]);
Route::post('/auth', [AuthController::class, "loginadmin"]);