<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Sales;
use Illuminate\Http\Request;

class ASalesController extends Controller
{
    public function index()
    {
        $saless = Sales::all();
        return response()->json(
            [
                'message' => 'berhasil',
                'saless' => $saless
            ]
        );
    }

    public function show($id)
    {
        $sales = Sales::find($id);
        return response()->json(
            [
                'message' => 'berhasil',
                'sales' => $sales
            ]
        );
    }

    public function foto(Request $request)
    {
        $sales = Sales::where('id', $request->id)->first();
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
        $updated = Sales::where('id', $request->id)
            ->update([
                "sl_gambar" => $db,
            ]);

        return response()->json(
            [
                'message' => 'berhasil',
                'sales' => $this->getById($request->id),
                'type' => gettype($request->sl_gambar)
            ]
        );
    }

    public function getById(int $id)
    {
        return Sales::find($id);
    }

    public function update(Request $request, $id)
    {
        $sales = Sales::where('id', $id)->first();
        $user = $sales->user;

        $request->validate(
            [
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $sales->user->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $sales->user->id],
                "sl_kode" => ['required', 'unique:saless,sl_kode,' . $sales->id],
                "sl_nama" => 'required',
                "sl_alamat" => 'required',
                "sl_telp" => 'required|min:11|max:13',
                // "sl_email" => 'required|email',
                // "sl_gambar" => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'email.required' => 'email harus diisi',
                'email.unique' => 'email sudah terdaftar',
                'email.email' => 'email harus berupa email (terdapat @ dan .)',
                'username.required' => 'username harus diisi',
                'username.unique' => 'username sudah terdaftar',
                'sl_kode.unique' => 'kode sudah terdaftar',
                'sl_kode.required' => 'kode harus diisi',
                'sl_nama.required' => 'nama harus diisi',
                'sl_alamat.required' => 'alamat harus diisi',
                'sl_telp.required' => 'telp harus diisi',
                'sl_telp.min' => 'telp sedikitnya terdiri dari 11 karakter',
                'sl_telp.max' => 'telp tidak boleh lebih dari 13 karakter',
                // 'sl_email.email' => 'email harus berformat email',
                // 'sl_email.required' => 'email harus diisi',
                // 'sl_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                // 'sl_gambar:mimes' => 'gambar harus bertipe: png/jpg/jpeg',
            ]
        );

        $sales->update([
            "sl_kode" => $request->sl_kode,
            "sl_nama" => $request->sl_nama,
            "sl_alamat" => $request->sl_alamat,
            "sl_telp" => $request->sl_telp,
            "sl_email" => $request->email,
            "sl_active" => $request->sl_active,
        ]);

        $sales->user()->update([
            'username' => $request->username,
            'email' => $request->email,
            'roles' => 'sales',
        ]);

        return response()->json(
            [
                'message' => 'berhasil',
                'sales' => $sales,
                'user' => $user
            ]
        );
    }
}
