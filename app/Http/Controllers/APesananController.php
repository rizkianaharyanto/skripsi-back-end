<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Http\Controllers\Controller;
use App\Keranjang;
use App\Pesanan;
use App\Produk;
use App\Toko;
use Illuminate\Http\Request;

class APesananController extends Controller
{

    public function index(Request $request)
    {
        $distributors = Toko::find($request->toko_id)->distributors;
        $distributorids = $distributors->map(function ($item, $index) {
            return $item->id;
        })->all();
        $distributors2 = Distributor::whereIn('id', $distributorids)->with([
            'pesanans' => function ($query) use ($request) {
                return $query->whereIn('ps_status', ['baru', 'diterima sales', 'dalam pengiriman', 'diterima pembeli']);
            }
        ])->get();
        return response()->json(
            [
                'message' => 'berhasil',
                'distributors' => $distributors2
            ]
        );
    }

    public function riwayat(Request $request)
    {
        $distributors = Toko::find($request->toko_id)->distributors;
        $distributorids = $distributors->map(function ($item, $index) {
            return $item->id;
        })->all();
        // dd($distributorids);
        $distributors2 = Distributor::whereIn('id', $distributorids)->with([
            'pesanans' => function ($query) use ($request) {
                return $query->whereIn('ps_status', ['ditolak', 'selesai']);
            }
        ])->get();
        return response()->json(
            [
                'message' => 'berhasil',
                'distributors' => $distributors2
            ]
        );
    }

    public function indexSales(Request $request)
    {
        $tokos = Distributor::find($request->distributor_id)->tokos;
        $tokoids = $tokos->map(function ($item, $index) {
            return $item->id;
        })->all();
        $tokos2 = Toko::whereIn('id', $tokoids)->with([
            'pesanans' => function ($query) use ($request) {
                return $query->where('sales_id', $request->sales_id)->whereIn('ps_status', ['baru', 'diterima sales', 'dalam pengiriman', 'diterima pembeli']);
            }
        ])->get();
        return response()->json(
            [
                'message' => 'berhasil',
                'tokos' => $tokos2
            ]
        );
    }

    public function riwayatSales(Request $request)
    {
        $tokos = Distributor::find($request->distributor_id)->tokos;
        $tokoids = $tokos->map(function ($item, $index) {
            return $item->id;
        })->all();
        // dd($tokoids);
        $tokos2 = Toko::whereIn('id', $tokoids)->with([
            'pesanans' => function ($query) use ($request) {
                return $query->where('sales_id', $request->sales_id)->whereIn('ps_status', ['ditolak', 'selesai']);
            }
        ])->get();
        return response()->json(
            [
                'message' => 'berhasil',
                'tokos' => $tokos2
            ]
        );
    }

    public function show(Request $request)
    {
        $pesanan = Pesanan::where('id', $request->id)->with('distributor')->with(['sales' => function ($q) {
            $q->withTrashed();
         }])->with(['produks' => function ($q) {
            $q->withTrashed();
         }])->with('toko')->first();
        return response()->json(
            [
                'message' => 'berhasil',
                'pesanan' => $pesanan
            ]
        );
    }

    public function store(Request $request)
    {
        $product = Produk::where('id', $request->id)->with('Distributor')->with([
            'satuans' => function ($query) {
                return $query->orderBy('hg_qty', 'asc');
            }
        ])->first();
        $distributor = $product->distributor;
        $mitra = $distributor->tokos->find($request->toko_id);
        $pengajuan = $distributor->pengajuans->find($request->toko_id);
        // $status = $product->distributor->tokos->find($request->toko_id);
        $res = [];

        if ($mitra != null) {
            $res = [
                'message' => 'berhasil',
                'product' => $product,
                'distributor' => $distributor,
                'mitra' => $mitra
            ];
        } else {
            $res = [
                'message' => 'belum mitra',
                'distributor' => $distributor,
                'mitra' => $mitra,
                'pengajuan' => $pengajuan
            ];
        }
        return response()->json($res);
    }

    public function hitung(Request $request)
    {
        $product = Produk::where('id', $request->id)->with('Distributor')->with([
            'satuans' => function ($query) {
                return $query->orderBy('hg_qty', 'desc');
            }
        ])->first();
        $distributor = $product->distributor;

        $hargas = $product->satuans;
        $jumlahTotal = $request->qty;
        $hargaAkhir = null;
        $next = true;

        foreach ($hargas as $index => $harga) {
            if ($next == true && $jumlahTotal >= $harga->pivot->hg_qty) {
                $hitung[] = [
                    'jml' => $jumlahTotal,
                    'nominal' => $harga->pivot->hg_nominal,
                    'total' => $jumlahTotal * $harga->pivot->hg_nominal,
                ];
                $hargaAkhir = $jumlahTotal * $harga->pivot->hg_nominal;
                $next = false;
            }
        }
        // foreach ($hargas as $index => $harga) {
        //     $mod = $jumlahTotal % $harga->pivot->hg_qty;
        //     $div = intdiv($jumlahTotal, $harga->pivot->hg_qty);
        //     $hargaSatuan = $harga->pivot->hg_nominal / $harga->pivot->hg_qty;
        //     $total = $div * $harga->pivot->hg_nominal;

        //     if ($div != 0) {
        //         $hitung[] = [
        //             'jml' => $jumlahTotal - $mod,
        //             'nominal' => $hargaSatuan,
        //             'total' => $total,
        //         ];
        //     }

        //     $hargaAkhir += $total;
        //     $jumlahTotal = $mod;
        // }
        // dataHarga.map((harga) => {
        //   let mod = jumlahTotal % harga.hg_qty;
        //   let div = Math.floor(jumlahTotal / harga.hg_qty);

        //   hargaAkhir += div * harga.hg_nominal;
        //   jumlahTotal = mod;
        // });


        $res = [
            'message' => 'berhasil',
            'product' => $product,
            'distributor' => $distributor,
            'hitung' => $hitung,
            'hargaAkhir' => $hargaAkhir
        ];
        return response()->json($res);
    }


    public function create(Request $request)
    {
        try {
            $pesanan = Pesanan::create([
                'toko_id' => $request->toko_id,
                'distributor_id' => $request->distributor_id,
                'ps_nama' => "-",
                'ps_kode' => "P0{$request->distributor_id}0{$request->toko_id}",
                'ps_tanggal' => date(now()),
                'ps_total_jenis_barang' => $request->ps_total_jenis_barang,
                'ps_total_harga' => $request->ps_total_harga,
                'ps_status' => 'baru',
                'ps_active' => 'aktif'
            ]);

            $pesanan->update([
                'ps_kode' => "P0{$request->distributor_id}0{$request->toko_id}-{$pesanan->created_at}",
                'ps_tanggal' => $pesanan->created_at,
            ]);

            foreach ($request->products as $key => $product) {
                $pesanan->produks()->attach($product["id"], [
                    'dt_qty' => $product["pivot"]["kdt_qty"],
                    'dt_satuan' => $product["pivot"]["kdt_satuan"],
                    'dt_harga_used' => $product["pivot"]["kdt_harga_used"],
                    'dt_harga' => $product["pivot"]["kdt_harga"]
                ]);
            }

            $keranjang = Keranjang::where('toko_id', $request->toko_id)->where('distributor_id', $request->distributor_id)->first();
            $keranjang->produks()->detach();
            $keranjang->delete();

            return response()->json(
                [
                    'message' => 'berhasil'
                ]
            );
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function createSales(Request $request)
    {
        try {
            $pesanan = Pesanan::create([
                'sales_id' => $request->sales_id,
                'toko_id' => $request->toko_id,
                'distributor_id' => $request->distributor_id,
                'ps_nama' => "-",
                'ps_kode' => "P0{$request->distributor_id}0{$request->toko_id}",
                'ps_tanggal' => date(now()),
                'ps_total_jenis_barang' => $request->ps_total_jenis_barang,
                'ps_total_harga' => $request->ps_total_harga,
                'ps_status' => 'baru',
                'ps_active' => 'aktif'
            ]);

            $pesanan->update([
                'ps_kode' => "P0{$request->distributor_id}0{$request->toko_id}-{$pesanan->created_at}",
                'ps_tanggal' => $pesanan->created_at,
            ]);

            foreach ($request->products as $key => $product) {
                $pesanan->produks()->attach($product["id"], [
                    'dt_qty' => $product["pivot"]["kdt_qty"],
                    'dt_satuan' => $product["pivot"]["kdt_satuan"],
                    'dt_harga_used' => $product["pivot"]["kdt_harga_used"],
                    'dt_harga' => $product["pivot"]["kdt_harga"]
                ]);
            }

            $keranjang = Keranjang::where('sales_id', $request->sales_id)->where('distributor_id', $request->distributor_id)->first();
            $keranjang->produks()->detach();
            $keranjang->delete();

            return response()->json(
                [
                    'message' => 'berhasil'
                ]
            );
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function updateStatusPesanan(Request $request)
    {
        try {
            $pesanan = Pesanan::find($request->id);

            $newStatus = null;
            if ($request->isTolak) {
                $pesanan->update([
                    'ps_status' => 'ditolak',
                    'alasan_tolak' => $request->alasan_tolak
                ]);
            } else {
                if ($request->ps_status == 'baru') {
                    $newStatus = 'diterima sales';
                } elseif ($request->ps_status == 'diterima sales') {
                    $newStatus = 'dalam pengiriman';
                } elseif ($request->ps_status == 'dalam pengiriman') {
                    $newStatus = 'diterima pembeli';
                } else {
                    $newStatus = 'selesai';
                }

                $pesanan->update([
                    'ps_status' => $newStatus,
                ]);
            }

            return response()->json(
                [
                    'message' => 'berhasil'
                ]
            );
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
