<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagesController;
use Illuminate\Support\Facades\DB;

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
Route::get('/album/{idAlbum}/{nameAlbum}', [HomeController::class, 'album'])->name('album');
Route::get('/comprar/{idAlbum}/{idImage}', [HomeController::class, 'comprar'])->name('comprar');
Route::get('/myaccount', [HomeController::class, 'myaccount'])->name('mi cuenta');
Route::get('/shoppingcart', [HomeController::class, 'shoppingcart'])->name('shoppingcart')->middleware('web');
Route::get('/exclusives', [HomeController::class, 'exclusives'])->name('exclusives');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/addPhotoCookies/{idImage}/{requestWith}/{requestHeight}', [HomeController::class, 'addPhotoCookies'])->name('addPhotoCookies');
Route::get('/updateDownUsersOnline', [HomeController::class, 'updateUsersOnline'])->name('updateUsersOnline');
Route::get('/updateUpUsersOnline', [HomeController::class, 'updateUpUsersOnline'])->name('updateUpUsersOnline');
Route::get('/addImageToCart', [HomeController::class, 'addImageToCart'])->name('addImageToCart');

Route::Post('/', [HomeController::class, 'login'])->name('login');

Route::get('/users/{id}', function ($id) {
    $user = DB::table('users')->where('id', $id)->first();
    return response()->json($user);
});
Route::group(['prefix' => '/automatic', 'as' => 'admin'], function () {
    Route::get('/optimiceImage', [ImagesController::class, 'automatic_optimiceImage']);
    Route::get('/checkImage', [ImagesController::class, 'automatic_checkImage']);
    Route::get('/checkFolder', [ImagesController::class, 'automatic_check_folder']);
    Route::get('/sync', [ImagesController::class, 'automatic_sync']);
});
Route::get('/sync_manual', [ImagesController::class, 'sync_manual']);
Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('/phpinfo', function () {
    return phpinfo();
});
