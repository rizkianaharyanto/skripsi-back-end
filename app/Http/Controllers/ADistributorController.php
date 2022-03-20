<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Http\Controllers\Controller;
use App\Produk;
use App\Sales;
use Illuminate\Http\Request;

class ADistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        return response()->json(
            [
                'message' => 'berhasil',
                'distributors' => $distributors
            ]
        );
    }
    
    public function show(Distributor $distributor, Request $request)
    {
        $products = Produk::where("distributor_id", $distributor->id)->with('Distributor')->with([
            'satuans' => function ($query) {
                return $query->orderBy('hg_qty', 'asc');
            }
        ])->get();
        $mitra = $distributor->tokos->find($request->toko_id);
        $pengajuan = $distributor->pengajuans->find($request->toko_id);
        return response()->json(
            [
                'message' => 'berhasil',
                'distributor' => $distributor,
                'products' => $products,
                'mitra' => $mitra,
                'pengajuan' => $pengajuan
            ]
        );
    }
    
    public function showForSales(Request $request)
    {
        $distributor = Sales::find($request->sales_id)->distributor;
        $products = Produk::where("distributor_id", $distributor->id)->with('Distributor')->with([
            'satuans' => function ($query) {
                return $query->orderBy('hg_qty', 'asc');
            }
        ])->get();
        $mitras = $distributor->tokos;
        return response()->json(
            [
                'message' => 'berhasil',
                'distributor' => $distributor,
                'products' => $products,
                'mitras' => $mitras,
            ]
        );
    }
}
