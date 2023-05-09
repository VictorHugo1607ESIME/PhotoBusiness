<?php

use App\Http\Controllers\AlbumsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\IndexController;
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
//login
Route::get('/login', function () {
    return view('admin.login.index');
})->name('admin.login');
Route::post('/postLogin', [UsersController::class, 'postLogin'])->name('admin.postLogin');
Route::get('/postRegister', [UsersController::class, 'postRegister']);
Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('admin.dashboard')->middleware('authAdmin');
Route::get('logout', [UsersController::class, 'logout']);
//login

Route::group(['prefix' => '/images', 'as' => 'admin', 'middleware' => ['authAdmin']], function () {
    Route::get('/', [ImagesController::class, 'index']);
    Route::post('/upImage', [ImagesController::class, 'upImage']);
    Route::get('/deleted/{id}', [ImagesController::class, 'deleted']);
    Route::get('/info/{id}', [ImagesController::class, 'info']);
});
Route::get('/', function () {
    dd('hola');
});
Route::group(['prefix' => '/users', 'as' => 'admin', 'middleware' => ['authAdmin']], function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/add', [UsersController::class, 'add']);
    Route::post('/insert', [UsersController::class, 'insert']);
    Route::get('/edit/{id}', [UsersController::class, 'edit']);
    Route::post('/update', [UsersController::class, 'update']);
    Route::post('update/config', [UsersController::class, 'update_config']);
    Route::get('/delete/{id}', [UsersController::class, 'delete']);
    Route::post('/update_pass', [UsersController::class, 'update_pass']);
});

Route::group(['prefix' => '/companies', 'as' => 'admin', 'middleware' => ['authAdmin']], function () {
});
Route::group(['prefix' => '/albums', 'as' => 'admin'], function () {
    Route::get('/', [AlbumsController::class, 'index']);
    Route::get('/add', [AlbumsController::class, 'add']);
    Route::post('/insert', [AlbumsController::class, 'insert']);
    Route::get('/edit/{id}', [AlbumsController::class, 'edit']);
    Route::post('/upImage', [AlbumsController::class, 'upImage']);
    Route::get('/getImages_album/{id}', [AlbumsController::class, 'getImages_album']);
    Route::get('/top/{id}', [AlbumsController::class, 'top_html']);
    Route::post('/top/edit', [AlbumsController::class, 'top_edit']);
    Route::get('/syncFTP',[AlbumsController::class,'syncFTP']);
});

Route::view('/contact', 'contact')->name('contact');
Route::view('/maintenance', 'maintenance')->name('maintenance');
