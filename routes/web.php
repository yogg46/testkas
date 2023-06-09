<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\Kasir;
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


Route::get('/', [Kasir::class, 'index']);
Route::post('/save-total', [Kasir::class, 'store'])->name('save-total');;
Route::get('/new',[ImageController::class,'index']);
Route::post('/simpan',[ImageController::class,'store'])->name('simpan');
