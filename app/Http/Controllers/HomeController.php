<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(Auth::user()->email);
        return view('home');
    }
    public function about()
    {
        //dd(Auth::user()->email);
        return view('about');
    }

    public function secret()
    {
        //dd(Auth::user()->email);
        return view('secret');
    }
}
