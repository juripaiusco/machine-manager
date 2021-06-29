<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
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
        $machines_count = \App\Model\Machine::count();
        $users_count = \App\Model\User::count();
        $products_count = \App\Model\Product::count();

        return view('home', [
            'machines_count' => $machines_count,
            'users_count' => $users_count,
            'products_count' => $products_count,
        ]);
    }
}
