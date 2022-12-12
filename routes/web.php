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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('clogin');
Route::post('/customLogin', [App\Http\Controllers\Auth\LoginController::class, 'customLogin']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::any('/custom-logout', [App\Http\Controllers\HomeController::class, 'customLogout']);
Route::get('/importData', [App\Http\Controllers\HomeController::class, 'importData']);
Route::any('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete']);
