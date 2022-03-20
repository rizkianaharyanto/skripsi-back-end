<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\Sales;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = Pesanan::where('distributor_id', auth()->user()->userable_id)->get();
        // dd($pesanans);
        return view('pesanan.pesanan', compact('pesanans'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanan = Pesanan::with(['sales' => function ($q) {
            $q->withTrashed();
         }])->find($id);
        $produks = $pesanan->produks()->withTrashed()->get();

        $saless = Sales::where('distributor_id', auth()->user()->userable_id)->get();
        // dd($produks);
        return view('pesanan.pesananDetail', [
            'pesanan' => $pesanan,
            'produks' => $produks,
            'saless' => $saless
        ]);
    }


    public function tolakPesanan(Request $request, $id)
    {
        // dd($request->alasan_tolak);
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan->update([
            'ps_status' => 'ditolak',
            'alasan_tolak' => $request->alasan_tolak
        ]);
        
        return redirect('/pesanan/' . $id);
    }
    
    public function setSales(Request $request, $id)
    {
        // dd($request);
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan->update([
            'sales_id' => $request->sales
        ]);

        return redirect('/pesanan/' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
