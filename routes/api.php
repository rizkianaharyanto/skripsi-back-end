<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ADistributorController;
use App\Http\Controllers\AKeranjangController;
use App\Http\Controllers\AProductController;
use App\Http\Controllers\ASalesController;
use App\Http\Controllers\ATokoController;
use App\Http\Controllers\APesananController;
use App\Http\Controllers\ALoginController;
use App\Http\Controllers\ARegistrasiController;
use App\Http\Controllers\ASearchController;
use App\Http\Controllers\AMitraController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [ALoginController::class, 'index']);
Route::post('regis', [ARegistrasiController::class, 'index']);
Route::post('resubmission/{id}', [ARegistrasiController::class, 'resubmission']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [ALoginController::class, 'logout']);
    Route::post('change-password', [ResetPasswordController::class, 'resetPassword']);

    //update profile
    Route::post('toko/foto', [ATokoController::class, 'foto']);
    Route::put('toko/{toko}', [ATokoController::class, 'update']);
    Route::post('sales/foto', [ASalesController::class, 'foto']);
    Route::put('sales/{sales}', [ASalesController::class, 'update']);

    //show many distributors and products in home and search page
    Route::get('home', [AMitraController::class, 'showHome']);
    Route::get('search/{text}', [ASearchController::class, 'index']);

    //get details (show)
    Route::get('distributor/{distributor}', [ADistributorController::class, 'show']);

    //pengajuan mitra
    Route::post('pengajuan', [AMitraController::class, 'pengajuan']);

    //tambah pesanan
    Route::post('pesanan', [APesananController::class, 'store']);
    Route::post('hitung', [APesananController::class, 'hitung']);
    Route::post('keranjang', [AKeranjangController::class, 'store']);
    Route::post('hapus', [AKeranjangController::class, 'delete']);
    Route::get('lihatkeranjang', [AKeranjangController::class, 'index']);
    Route::get('product/{product}', [AProductController::class, 'show']);
    Route::post('checkout', [APesananController::class, 'create']);

    Route::get('lihatPesanan', [APesananController::class, 'index']);
    Route::get('lihatRiwayat', [APesananController::class, 'riwayat']);
    Route::get('pesanan/{pesanan}', [APesananController::class, 'show']);

    //endpoint for sales
    Route::get('distributor/homeSales/{distributor}', [ADistributorController::class, 'showForSales']);
    Route::post('keranjangSales', [AKeranjangController::class, 'storeSales']);
    Route::post('hapusSales', [AKeranjangController::class, 'deleteSales']);
    Route::get('lihatkeranjangSales', [AKeranjangController::class, 'indexSales']);
    Route::get('getTokoSales', [AKeranjangController::class, 'tokoSales']);
    Route::post('checkoutSales', [APesananController::class, 'createSales']);
    Route::get('lihatPesananSales', [APesananController::class, 'indexSales']);
    Route::get('lihatRiwayatSales', [APesananController::class, 'riwayatSales']);
    Route::post('updateStatusPesanan', [APesananController::class, 'updateStatusPesanan']);


    //haven't use, maybe would update
    Route::get('distributor', [ADistributorController::class, 'index']);
    Route::get('toko/{toko}', [ATokoController::class, 'showForSales']);

    Route::get('product', [AProductController::class, 'index']);

    Route::get('sales', [ASalesController::class, 'index']);
    Route::get('sales/{sales}', [ASalesController::class, 'show']);

    Route::get('toko', [ATokoController::class, 'index']);
    Route::post('toko', [ATokoController::class, 'store']);

    Route::put('pesanan/{pesanan}', [APesananController::class, 'update']);

});

