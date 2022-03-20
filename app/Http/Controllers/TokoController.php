<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Mitra;
use App\Pengajuan;
use App\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributor = Distributor::where('id', auth()->user()->userable_id)->first();
        $mitras = $distributor->tokos;
        $pengajuans = $distributor->pengajuans;
        // dd($mitras, $pengajuans);
        return view('toko.toko', [
            'mitras' => $mitras,
            'pengajuans' => $pengajuans
        ]);
    }

    public function terimaMitra($id)
    {
        $distributor = Distributor::where('id', auth()->user()->userable_id)->first();
        $distributor->pengajuans()->detach($id);
        $distributor->tokos()->attach($id);

        return redirect('/toko/' . $id);
    }
    
    public function tolakMitra(Request $request, $id)
    {
        // dd($request->alasan_tolak);
        $distributor = Distributor::where('id', auth()->user()->userable_id)->first();
        $distributor->pengajuans()->detach($id);
        $distributor->pengajuans()->attach($id, ['alasan_tolak' => $request->alasan_tolak]);
    
        return redirect('/toko/' . $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Toko $toko
     * @return \Illuminate\Http\Response
     */
    public function show(Toko $toko)
    {
        $mitra = $toko->distributors->find(auth()->user()->userable_id);
        $pengajuan = $toko->pengajuans->find(auth()->user()->userable_id);
        // dd($mitra, $pengajuan);
        return view('toko.tokoDetail', [
            'toko' => $toko,
            'mitra' => $mitra,
            'pengajuan' => $pengajuan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Toko $toko
     * @return \Illuminate\Http\Response
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Toko $toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toko $toko)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Toko $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toko $toko)
    {
        //
    }
}
