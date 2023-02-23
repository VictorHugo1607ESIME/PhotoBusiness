<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', function () {
    return view('admin.login.index');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
});
Route::group(['prefix' => '/images', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return view('admin.images.index');
    });
});
Route::get('/', function () {
    dd('hola');
});

Route::view('/contact', 'contact')->name('contact');
Route::view('/maintenance', 'maintenance')->name('maintenance');
