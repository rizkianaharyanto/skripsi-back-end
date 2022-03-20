<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Http\Controllers\Controller;
use App\Keranjang;
use App\Pesanan;
use App\Produk;
use App\Sales;
use Illuminate\Http\Request;

class AKeranjangController extends Controller
{
    
    public function index(Request $request)
    {
        $totals = [];
        $keranjangs = Keranjang::where('toko_id', $request->toko_id)->with('Produks')->with("Distributor")->with("Toko")->get();
        if ($keranjangs) {
            # code...
            foreach ($keranjangs as $index => $keranjang) {
                $totalKeranjang = 0;
                foreach ($keranjang->produks as $product) {
                    $totalKeranjang = $totalKeranjang + $product->pivot->kdt_harga;
                }
                $totals[$index] = $totalKeranjang;
            }
        } else {
            # code...
            $keranjangs = null;
            $totals = null;
        }

        return response()->json(
            [
                'message' => 'berhasil',
                'keranjangs' => $keranjangs,
                'totals' => $totals
            ]
        );
    }

    public function indexSales(Request $request)
    {
        $totals = [];
        $keranjangs = Keranjang::where('sales_id', $request->sales_id)->with('Produks')->with("Distributor")->with("Toko")->get();
        if ($keranjangs) {
            # code...
            foreach ($keranjangs as $index => $keranjang) {
                $totalKeranjang = 0;
                foreach ($keranjang->produks as $product) {
                    $totalKeranjang = $totalKeranjang + $product->pivot->kdt_harga;
                }
                $totals[$index] = $totalKeranjang;
            }
        } else {
            # code...
            $keranjangs = null;
            $totals = null;
        }
        
        $distributor = Sales::find($request->sales_id)->distributor;
        $mitras = $distributor->tokos;

        return response()->json(
            [
                'message' => 'berhasil',
                'keranjangs' => $keranjangs,
                'totals' => $totals,
                'mitras' => $mitras,
            ]
        );
    }

    public function tokoSales(Request $request)
    {
        $distributor = Sales::find($request->sales_id)->distributor;
        $mitras = $distributor->tokos;
        return response()->json(
            [
                'message' => 'berhasil',
                'mitras' => $mitras,
            ]
        );
    }

    public function show(Keranjang $keranjang)
    {
        return response()->json(
            [
                'message' => 'berhasil',
                'keranjang' => $keranjang
            ]
        );
    }

    public function store(Request $request)
    {
        $cari = Keranjang::where('toko_id', $request->toko_id)->where('distributor_id', $request->distributor_id)->first();
        // dd($cari);
        if ($cari) {
            $cari->produks()->detach($request->product_id);
            $cari->produks()->attach($request->product_id, [
                'kdt_qty' => $request->kdt_qty,
                'kdt_satuan' => $request->kdt_satuan,
                'kdt_harga' => $request->kdt_harga,
                'kdt_harga_used' => $request->kdt_harga_used
            ]);
        } else {
            $pesanan = Keranjang::create([
                'toko_id' => $request->toko_id,
                'distributor_id' => $request->distributor_id
            ]);
            
            $pesanan->produks()->attach($request->product_id, [
                'kdt_qty' => $request->kdt_qty,
                'kdt_satuan' => $request->kdt_satuan,
                'kdt_harga' => $request->kdt_harga,
                'kdt_harga_used' => $request->kdt_harga_used
            ]);
        }
        return response()->json(
            [
                'message' => 'berhasil',
            ]
        );
    }

    public function storeSales(Request $request)
    {
        $cari = Keranjang::where('sales_id', $request->sales_id)->where('distributor_id', $request->distributor_id)->first();
        // dd($cari);
        if ($cari) {
            $cari->produks()->detach($request->product_id);
            $cari->produks()->attach($request->product_id, [
                'kdt_qty' => $request->kdt_qty,
                'kdt_satuan' => $request->kdt_satuan,
                'kdt_harga' => $request->kdt_harga,
                'kdt_harga_used' => $request->kdt_harga_used
            ]);
        } else {
            $pesanan = Keranjang::create([
                'sales_id' => $request->sales_id,
                'distributor_id' => $request->distributor_id
            ]);
            
            $pesanan->produks()->attach($request->product_id, [
                'kdt_qty' => $request->kdt_qty,
                'kdt_satuan' => $request->kdt_satuan,
                'kdt_harga' => $request->kdt_harga,
                'kdt_harga_used' => $request->kdt_harga_used
            ]);
        }
        return response()->json(
            [
                'message' => 'berhasil',
            ]
        );
    }

    public function delete(Request $request)
    {
        $cari = Keranjang::where('toko_id', $request->toko_id)->where('distributor_id', $request->distributor_id)->first();
        $cari->produks()->detach($request->product_id);
        // dd($cari->produks()->first());
        if (!$cari->produks()->first()) {
            // dd($cari);
            $cari->delete();
        }
        return response()->json(
            [
                'message' => 'berhasil',
            ]
        );
    }

    public function deleteSales(Request $request)
    {
        $cari = Keranjang::where('sales_id', $request->sales_id)->where('distributor_id', $request->distributor_id)->first();
        $cari->produks()->detach($request->product_id);
        // dd($cari->produks()->first());
        if (!$cari->produks()->first()) {
            // dd($cari);
            $cari->delete();
        }
        return response()->json(
            [
                'message' => 'berhasil',
            ]
        );
    }
}
