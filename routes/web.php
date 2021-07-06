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

Auth::routes();

Route::get('/cockpit', [App\Http\Controllers\Admin\CockpitController::class, 'index'])->name('cockpit');

Route::get('/',[App\Http\Controllers\PageController::class, 'accueil'])->name('accueil');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

include_once 'web_gl.php';
include_once 'web_sc.php';
