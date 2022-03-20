<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Toko;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ARegistrasiController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param    $data
     * @return \App\User
     */
    public function index(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            "tk_nama" => 'required',
            "tk_alamat"    => 'required',
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
            'password.required' => 'password harus diisi',
            'password.min' => 'password minimal 8 karakter',
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
        ]);
        
        // $imageName = 'ds-'.$data['tk_nama'].'.'.$data['tk_gambar']->extension();  

        // $data['tk_gambar']->move(public_path('images'), $imageName);
        $toko = Toko::create([
            "tk_nama" => $request->tk_nama,
            "tk_alamat" => $request->tk_alamat,
            "tk_pemilik" => $request->tk_pemilik,
            "tk_telp" => $request->tk_telp,
            "tk_email" => $request->email,
            "tk_gambar" => 'store.jpg',
            "tk_active" => 'non-aktif',
        ]);

        $user= $toko->user()->create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'toko',
        ]);

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'toko' => $toko
        ], 200);
    }

    public function resubmission(Request $request, $id)
    {
        $toko = Toko::where('id', $id)->first();
        $user= $toko->user;
        
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $toko->user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $toko->user->id],
            'password' => 'required|string|min:8',
            "tk_nama" => 'required',
            "tk_alamat"    => 'required',
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
            'password.required' => 'password harus diisi',
            'password.min' => 'password minimal 8 karakter',
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
        ]);
        
        // $imageName = 'ds-'.$data['tk_nama'].'.'.$data['tk_gambar']->extension();  

        // $data['tk_gambar']->move(public_path('images'), $imageName);
        
        if ($toko->tk_active == 'tolak') {
            $status = 'non-aktif';
        } else {
            $status = 'aktif';
        }
        
        $toko->update([
            "tk_nama" => $request->tk_nama,
            "tk_alamat" => $request->tk_alamat,
            "tk_pemilik" => $request->tk_pemilik,
            "tk_telp" => $request->tk_telp,
            "tk_email" => $request->email,
            "tk_gambar" => 'store.jpg',
            "tk_active" => $status,
            "alasan_tolak" => null,
        ]);

        $toko->user()->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'toko',
        ]);

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'toko' => $toko
        ], 200);
    }
}
