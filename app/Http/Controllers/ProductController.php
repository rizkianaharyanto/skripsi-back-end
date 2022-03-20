<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Produk;
use App\Satuan;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Distributor::find(auth()->user()->userable_id)->produks;
        return view('produk.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuans = Distributor::find(auth()->user()->userable_id)->satuans;
        $count = Distributor::find(auth()->user()->userable_id)->satuans->count();
        // dd($satuans);
        if ($count == 0) {
            return redirect('/product')->with('status', 'Data satuan masih kosong');
        } else {
            // dd($satuans);
            return view('produk.productTambah', compact('satuans'));
        }
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
                "pd_kode" => 'required|unique:produks',
                "pd_nama" => 'required',
                "pd_stok" => 'required|integer',
                "pd_deskripsi" => 'required',
                "pd_gambar.*" => 'image|mimes:png,jpg,jpeg',
                "hg_qty.0" => 'required',
                "hg_nominal.0" => 'required',
                "satuan_id.0" => 'required',
            ],
            [
                'pd_kode.unique' => 'kode sudah dipakai',
                'pd_kode.required' => 'kode harus diisi',
                'pd_nama.required' => 'nama harus diisi',
                'pd_stok.required' => 'stok harus diisi',
                'pd_stok.integer' => 'stok harus berupa angka',
                'pd_deskripsi.required' => 'deskripsi harus diisi',
                'pd_gambar.*.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                'pd_gambar.*.mimes' => 'gambar harus bertipe: png/jpg/jpeg',
                'hg_qty.0.required' => 'field harga pertama harus diisi',
                'hg_nominal.0.required' => 'field harga pertama harus diisi',
                'satuan_id.0.required' => 'field satuan harus diisi',
            ]
        );


        if ($request->hasFile('pd_gambar')) {
            $count = 0;
            foreach ($request->file('pd_gambar') as $image) {
                $imageName = 'pd-' . $request->pd_nama . '-' . $count . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
                $data[] = $imageName;
                $count += 1;
            }
        } else {
            $data[] = 'product.png';
        }

        $product = Produk::create([
            "pd_kode" => $request->pd_kode,
            "pd_nama" => $request->pd_nama,
            "pd_stok" => $request->pd_stok,
            "pd_deskripsi" => $request->pd_deskripsi,
            "pd_gambar" => json_encode($data),
            'distributor_id' => auth()->user()->userable_id,
        ]);

        foreach ($request->satuan_id as $index => $nama) {
            $id = Satuan::where('st_nama', $nama)->first()->id;
            $product->satuans()->attach($id, [
                'hg_qty' => $request->hg_qty[$index],
                'hg_nominal' => $request->hg_nominal[$index],
            ]);
        }
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Produk $product
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $product)
    {
        $images = json_decode($product->pd_gambar);
        $hargas = $product->satuans()->withTrashed()->get();
        // dd($hargas);
        return view('produk.productDetail', [
            'product' => $product,
            'images' => $images,
            'hargas' => $hargas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Produk $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $product)
    {
        $images = json_decode($product->pd_gambar);

        $satuans = Distributor::find(auth()->user()->userable_id)->satuans;
        // dd($satuans);
        $hargas = $product->satuans;
        return view('produk.productEdit', [
            'product' => $product,
            'images' => $images,
            'satuans' => $satuans,
            'hargas' => $hargas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Produk $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $product)
    {
        $request->validate(
            [
                "pd_kode" => ['required', 'unique:produks,pd_kode,' . $product->id],
                "pd_nama" => 'required',
                "pd_stok" => 'required|integer',
                "pd_deskripsi" => 'required',
                // "pd_gambar.*" => 'image|mimes:png,jpg,jpeg',
                "hg_qty.0" => 'required',
                "hg_nominal.0" => 'required',
                "satuan_id.0" => 'required',
            ],
            [
                'pd_kode.unique' => 'kode sudah dipakai',
                'pd_kode.required' => 'kode harus diisi',
                'pd_nama.required' => 'nama harus diisi',
                'pd_stok.required' => 'stok harus diisi',
                'pd_stok.integer' => 'stok harus berupa angka',
                'pd_deskripsi.required' => 'deskripsi harus diisi',
                // 'pd_gambar.*.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                // 'pd_gambar.*.mimes' => 'gambar harus bertipe: png/jpg/jpeg',
                'hg_qty.0.required' => 'field harga pertama harus diisi',
                'hg_nominal.0.required' => 'field harga pertama harus diisi',
                'satuan_id.0.required' => 'field satuan harus diisi',
            ]
        );

        // dd($request->pd_gambar);
        // if ($request->hasFile('pd_gambar')) {
        //     // $count = 0;
        //     foreach ($request->file('pd_gambar') as $index => $image) {
        //         $imageName = 'pd-' . $request->pd_nama . '-' . $index . '.' . $image->extension();
        //         $image->move(public_path('images'), $imageName);
        //         $db[$index] = $imageName;
        //     }
        // }
        if ($request->pd_gambar) {
            foreach ($request->pd_gambar as $index => $image) {
                # code...

                if (gettype($image) === "string") {
                    $db[$index] = $image;
                } else {
                    $tipe = $image->extension();
                    if ($tipe == 'jpg' || $tipe == 'png' || $tipe == 'jpeg') {
                        $imageName = 'pd-' . $request->pd_nama . '-' . $index . '.' . $image->extension();
                        $image->move(public_path('images'), $imageName);
                        $db[$index] = $imageName;
                    } else {
                        $db[] = 'product.png';
                    }
                }
                // dd($image);
            }
        } else {
            $db[] = 'product.png';
        }
        // dd($db);

        // $db = json_decode($product->pd_gambar);
        // $lama = count($request->fotolama);
        // $baru = count($request->file('pd_gambar'));
        // if ($request->hasFile('pd_gambar')) {
        //     // $count = 0;
        //     if($lama >= $baru){
        //         foreach($request->fotolama as $i => $foto_lama){
        //             if($request->file('pd_gambar')[$i]){
        //                 $imageName = 'pd-' . $request->pd_nama . '-' . $i . '.' . $request->file('pd_gambar')[$i]->extension();
        //                 $image->move(public_path('images'), $imageName);
        //                 $db[$index] = $imageName;
        //             }else{
        //                 $db[$index] = $foto_lama;
        //             }
        //         }
        //     }elseif ($baru > $lama){
        //         foreach ($request->file('pd_gambar') as $index => $image) {
        //             if($image)
        //         }
        //     }
        // }

        Produk::where('id', $product->id)
            ->update([
                "pd_kode" => $request->pd_kode,
                "pd_nama" => $request->pd_nama,
                "pd_stok" => $request->pd_stok,
                "pd_deskripsi" => $request->pd_deskripsi,
                "pd_gambar" => json_encode($db),
            ]);

        $product->satuans()->detach();
        foreach ($request->satuan_id as $index => $nama) {
            $id = Satuan::where('st_nama', $nama)->first()->id;
            $product->satuans()->attach($id, [
                'hg_qty' => $request->hg_qty[$index],
                'hg_nominal' => $request->hg_nominal[$index],
            ]);
        }
        return redirect('/product/' . $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Produk $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $product)
    {
        $product->delete();
        
        return redirect('/product');
    }
}
