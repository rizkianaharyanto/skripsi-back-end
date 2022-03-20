<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Toko;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('distributor.distributor', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distributor.distributorTambah');
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
                "ds_kode" => 'required',
                "ds_nama" => 'required',
                "ds_alamat"    => 'required',
                "ds_telp" => 'required|max:13',
                "ds_email" => 'required|email',
                "ds_gambar" => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'ds_kode.required' => 'kode harus diisi',
                'ds_nama.required' => 'nama harus diisi',
                'ds_alamat.required' => 'alamat harus diisi',
                'ds_telp.required' => 'telp harus diisi',
                'ds_telp.max' => 'telp tidak boleh lebih dari 13',
                'ds_email.email' => 'email harus berformat email',
                'ds_email.required' => 'email harus diisi',
                'ds_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                'ds_gambar.mimes' => 'gambar harus bertipe: png/jpg/jpeg',
            ]
        );
        $imageName = 'ds-' . $request->ds_nama . '.' . $request->ds_gambar->extension();

        // dd($imageName);
        $request->ds_gambar->move(public_path('images'), $imageName);
        Distributor::create([
            "ds_kode" => $request->ds_kode,
            "ds_nama" => $request->ds_nama,
            "ds_alamat" => $request->ds_alamat,
            "ds_telp" => $request->ds_telp,
            "ds_email" => $request->ds_email,
            "ds_deskripsi" => $request->ds_deskripsi,
            "ds_pemilik" => $request->ds_pemilik,
            "ds_gambar" => $imageName,
            "ds_active" => 'aktif',
        ]);
        return redirect('/distributor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Distributor $distributor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $profile = $user->userable;
        return view('distributor.distributorDetail', [
            'profile' => $profile,
            'user' => $user
        ]);
    }

    public function profile($id)
    {
        $distributor = Distributor::where('id', $id)->first();
        return view('distributor.distributorProfile', [
            'distributor' => $distributor
        ]);
    }

    public function aktifkan($id)
    {
        $user = User::where('id', $id)->first();
        $profile = $user->userable;

        if ($user->roles == 'distributor') {
            Distributor::where('id', $profile->id)
                ->update([
                    "ds_active" => 'aktif',
                ]);
        } elseif ($user->roles == 'toko') {
            Toko::where('id', $profile->id)
                ->update([
                    "tk_active" => 'aktif',
                ]);
        }
        return redirect('/distributor/' . $id);
    }

    public function tolak(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $profile = $user->userable;

        if ($user->roles == 'distributor') {
            Distributor::where('id', $profile->id)
                ->update([
                    "ds_active" => 'tolak',
                    "alasan_tolak" => $request->alasan_tolak,
                ]);
        } elseif ($user->roles == 'toko') {
            Toko::where('id', $profile->id)
                ->update([
                    "tk_active" => 'tolak',
                    "alasan_tolak" => $request->alasan_tolak,
                ]);
        }
        return redirect('/distributor/' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Distributor $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distributor = Distributor::where('id', $id)->first();
        return view('distributor.distributorEdit', compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Distributor $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $distributor = Distributor::where('id', $id)->first();

        $request->validate(
            [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $distributor->user->id],
                "ds_kode" => 'required',
                "ds_nama" => ['required', 'unique:distributors,ds_nama,' . $distributor->id],
                "ds_alamat"    => 'required',
                "ds_telp" => 'required|min:11|max:13',
                // "ds_email" => 'required|email',
                // "ds_gambar" => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'ds_nama.unique' => 'nama sudah terdaftar',
                'email.unique' => 'email sudah terdaftar',
                'email.email' => 'Email harus berupa email (terdapat @ dan .)',
                'email.required' => 'email harus diisi',
                'ds_kode.required' => 'kode harus diisi',
                'ds_nama.required' => 'nama harus diisi',
                'ds_alamat.required' => 'alamat harus diisi',
                'ds_telp.required' => 'telp harus diisi',
                'ds_telp.min' => 'telp sedikitnya terdiri dari 11 karakter',
                'ds_telp.max' => 'telp tidak boleh lebih dari 13',
                // 'ds_email.email' => 'email harus berformat email',
                // 'ds_email.required' => 'email harus diisi',
                // 'ds_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                // 'ds_gambar.mimes' => 'gambar harus bertipe: png/jpg/jpeg',
            ]
        );
        if ($request->ds_gambar) {
            if (gettype($request->ds_gambar) === "string") {
                $db = $request->ds_gambar;
            } else {
                $tipe = $request->ds_gambar->extension();
                if ($tipe == 'jpg' || $tipe == 'png' || $tipe == 'jpeg') {
                    $imageName = 'ds-' . $request->ds_nama . '.' . $request->ds_gambar->extension();
                    $request->ds_gambar->move(public_path('images'), $imageName);
                    $db = $imageName;
                } else {
                    $db = 'warehouse.png';
                }
            }
        } else {
            $db = 'warehouse.png';
        }
        // $imageName = 'ds-'.$request->ds_nama.'.'.$request->ds_gambar->extension();  

        // dd($imageName);
        // $request->ds_gambar->move(public_path('images'), $imageName);

        if ($distributor->ds_active == 'tolak') {
            $status = 'non-aktif';
        } else {
            $status = 'aktif';
        }

        Distributor::where('id', $id)
            ->update([
                "ds_kode" => $request->ds_kode,
                "ds_nama" => $request->ds_nama,
                "ds_alamat" => $request->ds_alamat,
                "ds_telp" => $request->ds_telp,
                "ds_email" => $request->email,
                "ds_deskripsi" => $request->ds_deskripsi,
                "ds_pemilik" => $request->ds_pemilik,
                "ds_gambar" => $db,
                "ds_active" => $status,
                "alasan_tolak" => null,
            ]);

        $distributor->user()->update([
            'email' => $request->email,
            'roles' => 'distributor',
        ]);
        return redirect('/distributor/' . $id);
    }

    public function resubmission(Request $request, $id)
    {
        $distributor = Distributor::where('id', $id)->first();

        $request->validate(
            [
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $distributor->user->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $distributor->user->id],
                'password' => 'required|string|min:8|confirmed',
                "ds_kode" => 'required',
                "ds_nama" => ['required', 'unique:distributors,ds_nama,' . $distributor->id],
                "ds_alamat"    => 'required',
                "ds_telp" => 'required|min:11|max:13',
                // "ds_email" => 'required|email',
                // "ds_gambar" => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'username.unique' => 'Username sudah terdaftar',
                'ds_nama.unique' => 'nama sudah terdaftar',
                'email.unique' => 'email sudah terdaftar',
                'email.email' => 'Email harus berupa email (terdapat @ dan .)',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi Password harus sama dengan password',
                'username.required' => 'username harus diisi',
                'password.required' => 'password harus diisi',
                'email.required' => 'email harus diisi',
                'ds_kode.required' => 'kode harus diisi',
                'ds_nama.required' => 'nama harus diisi',
                'ds_alamat.required' => 'alamat harus diisi',
                'ds_telp.required' => 'telp harus diisi',
                'ds_telp.min' => 'telp sedikitnya terdiri dari 11 karakter',
                'ds_telp.max' => 'telp tidak boleh lebih dari 13',
                'ds_email.email' => 'email harus berformat email',
                'ds_email.required' => 'email harus diisi',
                // 'ds_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
                // 'ds_gambar.mimes' => 'gambar harus bertipe: png/jpg/jpeg',
            ]
        );
        if ($request->ds_gambar) {
            if (gettype($request->ds_gambar) === "string") {
                $db = $request->ds_gambar;
            } else {
                $tipe = $request->ds_gambar->extension();
                if ($tipe == 'jpg' || $tipe == 'png' || $tipe == 'jpeg') {
                    $imageName = 'ds-' . $request->ds_nama . '.' . $request->ds_gambar->extension();
                    $request->ds_gambar->move(public_path('images'), $imageName);
                    $db = $imageName;
                } else {
                    $db = 'warehouse.png';
                }
            }
        } else {
            $db = 'warehouse.png';
        }
        // $imageName = 'ds-'.$request->ds_nama.'.'.$request->ds_gambar->extension();  

        // dd($imageName);
        // $request->ds_gambar->move(public_path('images'), $imageName);

        if ($distributor->ds_active == 'tolak') {
            $status = 'non-aktif';
        } else {
            $status = 'aktif';
        }

        Distributor::where('id', $id)
            ->update([
                "ds_kode" => $request->ds_kode,
                "ds_nama" => $request->ds_nama,
                "ds_alamat" => $request->ds_alamat,
                "ds_telp" => $request->ds_telp,
                "ds_email" => $request->email,
                "ds_deskripsi" => $request->ds_deskripsi,
                "ds_pemilik" => $request->ds_pemilik,
                "ds_gambar" => $db,
                "ds_active" => $status,
                "alasan_tolak" => null,
            ]);

        $distributor->user()->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'distributor',
        ]);
        return redirect('/distributor/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Distributor $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        //
    }
}
