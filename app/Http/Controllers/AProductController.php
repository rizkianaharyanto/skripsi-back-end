<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;

class AProductController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return response()->json(
            [
                'message' => 'berhasil',
                'products' => $products
            ]
        );
    }

    public function show(Request $request)
    {
        $product = Produk::where('id', $request->id)->with('Distributor')->with([
            'satuans' => function ($query) {
                return $query->orderBy('hg_qty', 'asc');
            }
        ])->first();
        return response()->json(
            [
                'product' => $product,
            ]
        );
    }
}
