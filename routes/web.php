<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AspirasiController;
use GuzzleHttp\Middleware;
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

Route::get('/', function () {return view('home');});
Route::get('/aspirasi', [AspirasiController::class,'index']);
Route::post('/aspirasi-input', [AspirasiController::class,'insert']);
Route::post('/aspirasi/feedback/{aspirasi:id}', [AspirasiController::class,'feedback']);

Route::post('/login',[AdminController::class,'login']);
Route::post('/logout',[AdminController::class,'logout'])->middleware('auth');

Route::get('/admin',[AdminController::class,'index'])->middleware('auth');
Route::get('/admin/history',[AdminController::class,'history'])->middleware('auth');
Route::post('/admin/edit/{aspirasi:id}',[AdminController::class,'edit'])->middleware('auth');
Route::post('/admin/delete/{aspirasi:id}',[AdminController::class,'destroy'])->middleware('auth');