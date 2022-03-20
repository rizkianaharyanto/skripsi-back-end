<?php

namespace App\Http\Controllers\Auth;

use App\Distributor;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "ds_kode" => 'required', 
            "ds_nama" => ['required', 'unique:distributors'],
            "ds_alamat"    => 'required',
            "ds_telp" => 'required|min:11|max:13',
            // "ds_email" => 'required|email',
            // "ds_gambar" => 'image|mimes:png,jpg,jpeg',
        ], $message = [
            'username.required' => 'username harus diisi',
            'email.required' => 'email harus diisi',
            'password.required' => 'password harus diisi',
            'username.unique' => 'Username sudah terdaftar',
            'email.unique' => 'email sudah terdaftar',
            'ds_nama.unique' => 'nama sudah terdaftar',
            'email.email' => 'Email harus berupa email (terdapat @ dan .)',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi Password harus sama dengan password',
            'ds_kode.required' => 'kode harus diisi',
            'ds_nama.required' => 'nama harus diisi',
            'ds_alamat.required' => 'alamat harus diisi',
            'ds_telp.required' => 'telp harus diisi',
            'ds_telp.min' => 'telp sedikitnya terdiri dari 11 karakter',
            'ds_telp.max' => 'telp tidak boleh lebih dari 13 karakter',
            // 'ds_email.email' => 'email harus berformat email',
            // 'ds_email.required' => 'email harus diisi',
            // 'ds_gambar.image' => 'gambar harus berupa image (png/jpg/jpeg)',
            // 'ds_gambar:mimes' => 'gambar harus bertipe: png/jpg/jpeg',
        ]);
        // dd($message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $dataImg = 'warehouse.png';
        // dd($data);
        // if ($data['ds_gambar']) {
        //     $imageName = 'ds-' . $data['ds_nama'] . '.' . $data['ds_gambar']->extension();
        //     $data['ds_gambar']->move(public_path('images'), $imageName);
        //     $dataImg = $imageName;
        // } else {
        //     $dataImg = 'warehouse.png';
        // }
        // dd($data);


        $distributor = Distributor::create([
            "ds_kode" => $data['ds_kode'],
            "ds_nama" => $data['ds_nama'],
            "ds_alamat" => $data['ds_alamat'],
            "ds_telp" => $data['ds_telp'],
            "ds_email" => $data['email'],
            "ds_deskripsi" => $data['ds_deskripsi'],
            "ds_pemilik" => $data['ds_pemilik'],
            "ds_gambar" => $dataImg,
            "ds_active" => 'non-aktif',
        ]);

        $user = $distributor->user()->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles' => 'distributor',
        ]);

        return $user;
    }
}
