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

// Route::prefix('product')->group(function () {
//     Route::get('/', 'ProductController@index');
//     Route::get('/tambah', 'ProductController@create');
// });
Auth::routes();
// Route::view('/', 'template.guest')->name('home');
Route::get('/', 'HomeController@index');

Route::put('/aktifkan/{id}', 'DistributorController@aktifkan')->middleware('checkRole:super');
Route::put('/tolak/{id}', 'DistributorController@tolak')->middleware('checkRole:super');

Route::post('/terimaMitra/{id}', 'TokoController@terimaMitra')->middleware('checkRole:distributor');
Route::put('/tolakMitra/{id}', 'TokoController@tolakMitra')->middleware('checkRole:distributor');

Route::get('/distributor', 'DistributorController@index')->middleware('checkRole:super');
Route::get('/distributor/{id}', 'DistributorController@show')->middleware('checkRole:super');
Route::get('/distributor/{id}/profile', 'DistributorController@profile')->middleware('checkRole:distributor');
Route::get('/distributor/{id}/edit', 'DistributorController@edit')->middleware('checkRole:distributor');
Route::put('/distributor/{id}', 'DistributorController@update')->middleware('checkRole:distributor');
Route::put('/distributor/{id}/resubmission', 'DistributorController@resubmission')->middleware('checkRole:distributor');

Route::get('/distributor/{id}/form-change-password', 'Auth\ResetPasswordController@formResetPassword')->middleware('checkRole:distributor');
Route::put('/distributor/{id}/change-password', 'Auth\ResetPasswordController@resetPasswordWeb')->middleware('checkRole:distributor');

Route::put('/tolakPesanan/{id}', 'PesananController@tolakPesanan')->middleware('checkRole:distributor');
Route::put('/setSales/{id}', 'PesananController@setSales')->middleware('checkRole:distributor');

Route::resource('product', ProductController::class)->middleware('checkRole:distributor');
Route::resource('sales', SalesController::class)->middleware('checkRole:distributor');
Route::resource('toko', TokoController::class)->middleware('checkRole:distributor');
Route::resource('pesanan', PesananController::class)->middleware('checkRole:distributor');
// Route::resource('distributor', DistributorController::class)->middleware('checkRole:super');
Route::resource('satuan', SatuanController::class)->middleware('checkRole:distributor');



