<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saless = Sales::where('distributor_id', auth()->user()->userable_id)->get();
        // dd($saless);
        return view('sales.sales', compact('saless'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.salesTambah');
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
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                "sl_kode" => ['required', 'unique:saless'],
                "sl_nama" => 'required',
                "sl_alamat"    => 'required',
                "sl_telp" => 'required|max:13|min:11',
                // "sl_email" => 'required|email',
                "sl_gambar" => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'username.required' => 'username harus diisi',
                'email.required' => 'email harus diisi',
                'password.required' => 'password harus diisi',
                'username.unique' => 'username sudah terdaftar',
                'sl_kode.unique' => 'kode sudah terdaftar',
                'email.unique' => 'Email sudah terdaftar',
                'email.email' => 'Email harus berupa email (terdapat @ dan .)',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi Password harus sama dengan password',
                'sl_kode.required' => 'kode harus diisi',
                'sl_nama.required' => 'nama harus diisi',
                'sl_alamat.required' => 'alamat harus diisi',
                'sl_telp.required' => 'telp harus diisi',
                'sl_telp.max' => 'telp tidak boleh lebih dari 13',
                'sl_telp.min' => 'telp sedikitnya terdiri dari 11 karakter',
                // 'sl_email.email' => 'email harus berformat email',
                // 'sl_email.required' => 'email harus diisi',
                'sl_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                'sl_gambar.mimes' => 'gambar harus bertipe: png/jpg/jpeg',
            ]
        );
        if ($request->hasFile('sl_gambar')) {
                $imageName = 'sl-' . $request->sl_nama . '.' . $request->sl_gambar->extension();
                $request->sl_gambar->move(public_path('images'), $imageName);
                $data = $imageName;
        } else {
            $data = 'profil2.png';
        }

        // dd($imageName);
        $sales = Sales::create([
            "sl_kode" => $request->sl_kode,
            "sl_nama" => $request->sl_nama,
            "sl_alamat" => $request->sl_alamat,
            "sl_telp" => $request->sl_telp,
            "sl_email" => $request->email,
            "sl_gambar" => $data,
            "sl_active" => 'aktif',
            'distributor_id' => auth()->user()->userable_id,
        ]);

        $user = $sales->user()->create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'sales',
        ]);
        return redirect('/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Sales $sales
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales = Sales::find($id);
        return view('sales.salesDetail', compact('sales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Sales $sales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales = Sales::find($id);
        return view('sales.salesEdit', compact('sales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Sales $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sales= Sales::where('id', $id)->first();
        $request->validate(
            [
                "sl_kode" => ['required', 'unique:saless,sl_kode,' . $sales->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $sales->user->id],
                "sl_nama" => 'required',
                "sl_alamat"    => 'required',
                "sl_telp" => 'required|max:13|min:11',
                // "sl_email" => 'required|email',
                // "sl_gambar" => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'email.required' => 'email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'email.email' => 'Email harus berupa email (terdapat @ dan .)',
                'sl_kode.unique' => 'kode sudah terdaftar',
                'sl_kode.required' => 'kode harus diisi',
                'sl_nama.required' => 'nama harus diisi',
                'sl_alamat.required' => 'alamat harus diisi',
                'sl_telp.required' => 'telp harus diisi',
                'sl_telp.max' => 'telp tidak boleh lebih dari 13',
                'sl_telp.min' => 'telp sedikitnya terdiri dari 11 karakter',
                // 'sl_email.email' => 'email harus berformat email',
                // 'sl_email.required' => 'email harus diisi',
                // 'sl_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                // 'sl_gambar.mimes' => 'gambar harus bertipe: png/jpg/jpeg',
            ]
        );
        
        if ($request->sl_gambar) {
            if (gettype($request->sl_gambar) === "string") {
                $db = $request->sl_gambar;
            } else {
                $tipe = $request->sl_gambar->extension();
                if ($tipe == 'jpg' || $tipe == 'png' || $tipe == 'jpeg') {
                    $imageName = 'sl-' . $request->sl_nama . '.' . $request->sl_gambar->extension();
                    $request->sl_gambar->move(public_path('images'), $imageName);
                    $db = $imageName;
                } else {
                    $db = 'profil2.png';
                }
            }
        } else {
            $db = 'profil2.png';
        }
        // dd($imageName);
        // $imageName = 'sl-' . $request->sl_nama . '.' . $request->sl_gambar->extension();

        // dd($imageName);
        // $request->sl_gambar->move(public_path('images'), $imageName);
        Sales::where('id', $id)
            ->update([
                "sl_kode" => $request->sl_kode,
                "sl_nama" => $request->sl_nama,
                "sl_alamat" => $request->sl_alamat,
                "sl_telp" => $request->sl_telp,
                // "sl_email" => $request->sl_email,
                "sl_gambar" => $db,
                "sl_active" => 'aktif',
            ]);
        return redirect('/sales/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Sales $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sales = Sales::find($id);
        $sales->delete();
        
        return redirect('/sales');
    }
}
