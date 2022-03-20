<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Produk;
use App\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuans = Distributor::find(auth()->user()->userable_id)->satuans;
        return view('satuan.satuan', compact('satuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('satuan.satuanTambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
                "st_nama" => 'required',
            ],
            [
                'st_nama.required' => 'nama harus diisi',
            ]
        );
        Satuan::create([
            "st_nama" => $request->st_nama,
            'distributor_id' => auth()->user()->userable_id,
        ]);
        return redirect('/satuan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Satuan $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $satuan)
    {
        return view('satuan.satuanDetail', compact('satuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Satuan $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        return view('satuan.satuanEdit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Satuan $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        Satuan::where('id', $satuan->id)
        ->update([
            "st_nama" => $request->st_nama,
        ]);
        return redirect('/satuan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Satuan $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->delete();
        $produks = $satuan->produks;
        $produkids = $produks->map(function ($item, $index) {
            return $item->id;
        })->all();
        
        Produk::whereIn('id', $produkids)->delete();
        
        return redirect('/satuan');
    }
}
