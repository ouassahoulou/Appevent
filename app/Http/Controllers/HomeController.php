<?php

namespace App\Http\Controllers;
use App\Evenement;
use App\Generation;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $event = Evenement::orderBy('created_at', 'desc')->paginate(6);
        $gen = Generation::paginate(6);
        $arr = array($event,$gen);
        return view('home')->with('evenements',$arr);
    }
}
