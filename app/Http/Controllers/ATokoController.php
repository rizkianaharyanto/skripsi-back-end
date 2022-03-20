<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Toko;
use Illuminate\Http\Request;

class ATokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::all();
        return response()->json(
            [
                'message' => 'berhasil',
                'tokos' => $tokos
            ]
        );
    }

    public function show(Toko $toko)
    {
        return response()->json(
            [
                'message' => 'berhasil',
                'toko' => $toko
            ]
        );
    }
    
    public function foto(Request $request)
    {
        // dd(gettype($request->tk_gambar), $request->tk_gambar->extension());
        $toko = Toko::where('id', $request->id)->first();

        if ($request->tk_gambar) {
            if (gettype($request->tk_gambar) === "string") {
                $db = $request->tk_gambar;
            } else {
                $tipe = $request->tk_gambar->extension();
                if ($tipe == 'jpg' || $tipe == 'png' || $tipe == 'jpeg') {
                    $imageName = 'tk-' . $request->tk_nama . '.' . $request->tk_gambar->extension();
                    $request->tk_gambar->move(public_path('images'), $imageName);
                    $db = $imageName;
                } else {
                    $db = 'store.jpg';
                }
            }
        } else {
            $db = 'store.jpg';
        }

        Toko::where('id', $request->id)
            ->update([
                "tk_gambar" => $db,
            ]);


        return response()->json(
            [
                'message' => 'berhasil',
                'toko' =>   $this->getById($request->id),
                'type' => gettype($request->sl_gambar)
            ]
        );
    }


    public function getById(int $id)
    {
        return Toko::find($id);
    }


    public function update(Request $request, $id)
    {
        $toko = Toko::where('id', $id)->first();
        $user = $toko->user;

        $request->validate(
            [
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $toko->user->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $toko->user->id],
                "tk_nama" => 'required',
                "tk_alamat" => 'required',
                "tk_pemilik" => 'required',
                "tk_telp" => 'required|min:11|max:13',
                // "tk_email" => 'required|email',
                // "tk_gambar" => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'email.required' => 'email harus diisi',
                'email.unique' => 'email sudah terdaftar',
                'email.email' => 'email harus berupa email (terdapat @ dan .)',
                'username.required' => 'username harus diisi',
                'username.unique' => 'username sudah terdaftar',
                'tk_nama.required' => 'nama harus diisi',
                'tk_alamat.required' => 'alamat harus diisi',
                'tk_pemilik.required' => 'pemilik harus diisi',
                'tk_telp.required' => 'telp harus diisi',
                'tk_telp.min' => 'telp sedikitnya terdiri dari 11 karakter',
                'tk_telp.max' => 'telp tidak boleh lebih dari 13 karakter',
                // 'tk_email.email' => 'email harus berformat email',
                // 'tk_email.required' => 'email harus diisi',
                // 'tk_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                // 'tk_gambar:mimes' => 'gambar harus bertipe: png/jpg/jpeg',
            ]
        );

        // if ($request->username !== $toko->user->username) {
        //     $request->validate([
        //         'username' => 'unique:users,username,' . $toko->user->id
        //     ]);
        // }
        $toko->update([
            "tk_nama" => $request->tk_nama,
            "tk_alamat" => $request->tk_alamat,
            "tk_pemilik" => $request->tk_pemilik,
            "tk_telp" => $request->tk_telp,
            "tk_email" => $request->email,
            "tk_deskripsi" => $request->tk_deskripsi,
            "tk_active" => $request->tk_active,
        ]);

        $toko->user()->update([
            'username' => $request->username,
            'email' => $request->email,
            'roles' => 'toko',
        ]);

        return response()->json(
            [
                'message' => 'berhasil',
                'toko' => $toko,
                'user' => $user
            ]
        );
    }
}
