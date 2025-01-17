<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
//Route::post('/', [\App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome.pagination');
Route::post('/import-data', [\App\Http\Controllers\HomeController::class, 'import'])->name('import-data');
