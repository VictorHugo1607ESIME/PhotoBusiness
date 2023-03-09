<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

/*Route::get('/', function () {
    return view('maintenance');
});*/

// VIEWS
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/collections', [HomeController::class, 'collections'])->name('collections');
Route::get('/politicas', [HomeController::class, 'politicas'])->name('politicas');
Route::get('/quienessomos', [HomeController::class, 'quienessomos'])->name('quienessomos');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/album/{nameAlbum}', [HomeController::class, 'album'])->name('album');
Route::get('/comprar', [HomeController::class, 'comprar'])->name('comprar');
