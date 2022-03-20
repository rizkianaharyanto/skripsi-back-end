<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ALoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ],
            [
                'password.min' => 'Password minimal 8 karakter',
                'username.required' => 'username harus diisi',
                'password.required' => 'password harus diisi',
            ]
        );

        $user = User::where('username', $request->username)->first();
        $result = [];
        $code = 0;

        $req_password = Hash::make($request->password);

        $credentials = request(['username', 'password']);
        if (!$user) {
            $result = [
                'message' => "Anda Tidak Terdaftar"
            ];
        } else if (!Auth::attempt($credentials)) {
            $result = [
                'message' => "Username atau password salah"
            ];
        } else {
            if ($user->roles == 'distributor' || $user->roles == 'super') {
                $result = [
                    'message' => "Anda tidak memiliki akses"
                ];
            } elseif ($user->roles == 'sales') {
                $profile = $user->userable;
                $token = $user->createToken('token-name')->plainTextToken;
                $result = [
                    'message' => 'success',
                    'token' => $token,
                    'user' => $user,
                    'profile' => $profile
                ];
            } else {
                $profile = $user->userable;
                if ($profile->tk_active == 'aktif') {
                    $token = $user->createToken('token-name')->plainTextToken;
                    $result = [
                        'message' => 'success',
                        'token' => $token,
                        'user' => $user,
                        'profile' => $profile
                    ];
                } else {
                    $result = [
                        'message' => 'success',
                        'user' => $user,
                        'profile' => $profile
                    ];
                }
            }
        }

        return response()->json($result);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'success Log Out',
        ], 200);
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
        //
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
