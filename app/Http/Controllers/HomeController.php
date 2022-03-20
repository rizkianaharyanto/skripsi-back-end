<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user() != null) {
            $role = auth()->user()->roles;
            if ($role == 'super') {
                return redirect('/distributor');
            } else {
                return view('dashboard');
            }
        } else {
            return view('template.guest');
        }
    }
}
