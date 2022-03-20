<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Toko;
use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;

class AMitraController extends Controller
{
    public function pengajuan(Request $request)
    {
        $distributor = Distributor::where('id', $request->distributor_id)->first();
        if ($distributor->pengajuans) {
            $distributor->pengajuans()->detach($request->toko_id);
        }
        $distributor->pengajuans()->attach($request->toko_id);
        return response()->json(
            [
                'message' => 'berhasil',
            ]
        );
    }

    public function showHome(Request $request)
    {
        $toko = Toko::where('id', $request->toko_id)->with('distributors')->first();
        // dd($toko->distributors);
        $distributors = $toko->distributors;
        $products = [];
        $distributors2 = [];

        foreach ($distributors as $index => $distributor) {
            $products[$index] = Produk::whereHas('Distributor', function ($q) use ($distributor) {
                $q->where("id", $distributor->id);
            })->with('Distributor')->with([
                'satuans' => function ($query) {
                    return $query->orderBy('hg_qty', 'asc');
                }
            ])->get();
            $distributors2[$index] = Distributor::where('id', $distributor->id)->with([
                'tokos' => function ($query) use ($request) {
                    return $query->where('toko_id', $request->toko_id);
                }
            ])->with([
                'pengajuans' => function ($query) use ($request) {
                    return $query->where('toko_id', $request->toko_id);
                }
            ])->get();
        }

        return response()->json(
            [
                'message' => 'berhasil',
                'products' => $products,
                // 'distributors2' => $distributors2,
                'distributors' => $distributors2,
            ]
        );
    }
}
