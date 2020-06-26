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

Route::get('/login', 'user@login');
Route::post('/login', 'user@loginp');
Route::get('/loginM', 'user@loginM');
Route::redirect('/', 'Home');

Route::get('logout', function () {
    session()->flush();
    return redirect('login');

});
Route::get('/layout', 'user@layout');
Route::post('/upload', 'crud@upload');

Route::middleware(['admincek'])->group(function () {
    Route::get('/Menu-{hal}', 'form@Master');
    Route::get('/Laporan-{hal}', 'form@Laporan');

    Route::get('/Home', 'form@Dashboard');

    Route::redirect('/cek', 'index.php');

    Route::get('/export', 'crud@export');

// Route::get('/Laporan', 'form@Laporan');
    Route::post('/create', 'crud@create');
    Route::get('/create', 'crud@create');
    Route::get('/Proses', 'crud@Proses');

    Route::get('/delete', 'crud@delete');
    Route::post('/delete', 'crud@delete');

    Route::post('/update', 'crud@update');

    Route::get('/update', 'crud@update');

    Route::post('ubah', 'user@ubah');
});
