<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;

class ASearchController extends Controller
{
    public function index($text, Request $request)
    {
        if ($text == 'semua') {
            $products = Produk::whereHas('Distributor', function ($q) use ($text) {
                $q->where("ds_active", "aktif");
            })->with('Distributor')->with([
                'satuans' => function ($query) {
                    return $query->orderBy('hg_qty', 'asc');
                }
            ])->get();
            $distributors = Distributor::where("ds_active", "aktif")->with([
                'pengajuans' => function ($query) use ($request) {
                    return $query->where('toko_id', $request->toko_id);
                }
            ])->with([
                'tokos' => function ($query) use ($request) {
                    return $query->where('toko_id', $request->toko_id);
                }
            ])->get();
        } else {
            $products = Produk::where("pd_nama", "like", "%" . $text . "%")->with('Distributor')->with([
                'satuans' => function ($query) {
                    return $query->orderBy('hg_qty', 'asc');
                }
            ])->orWhereHas('Distributor', function ($q) use ($text) {
                $q->where("ds_nama", "like", "%" . $text . "%");
            })->get();
            $distributors = Distributor::where("ds_nama", "like", "%" . $text . "%")->with([
                'pengajuans' => function ($query) use ($request) {
                    return $query->where('toko_id', $request->toko_id);
                }
            ])->with([
                'tokos' => function ($query) use ($request) {
                    return $query->where('toko_id', $request->toko_id);
                }
            ])->where("ds_active", "aktif")->get();
        }

        return response()->json(
            [
                'message' => 'berhasil',
                'products' => $products,
                // 'products2' => $products2,
                'distributors' => $distributors,
            ]
        );
    }
}
