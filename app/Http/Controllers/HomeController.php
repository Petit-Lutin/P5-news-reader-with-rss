<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth',['except'=>['mentionslegales','politiqueconfidentialite']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function mentionslegales()
    {
        return view('mentionslegales');
    }
    public function politiqueconfidentialite()
    {
        return view('politiqueconfidentialite');
    }
}
