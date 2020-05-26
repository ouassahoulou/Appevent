<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Evenement;
use App\Generation;
use App\Participant;
use App\Animateur;
use App\Affiche;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function index()
    {
        $event = Evenement::paginate(9);
        $date = today()->format('Y-m-d');
        $gen = Generation::where('date', '>=',$date )->paginate(9);
        $arr = array($event,$gen);
        return view('index')->with('evenements',$arr);
        
    }
    public function gp()
    {
        $event = Evenement::paginate(9);
        $gen = Generation::paginate(9);
        
        $arr = array($event,$gen);
        return view('gestion_p')->with('evenements', $arr);
    }
    public function gf()
    {
        $event = Evenement::where('free', 0)->paginate(9);
        $gen = Generation::where('free', 0)->paginate(9);
        $arr = array($event,$gen);
        return view('gestion_f')->with('evenements', $arr);
    }
    public function gf_p()
    {
        $event = Evenement::where('free', 1)->paginate(9);
        $gen = Generation::where('free', 1)->paginate(9);
        $arr = array($event,$gen);
        return view('gestion_fg')->with('evenements', $arr);
    }
    public function show()
    {
        return view('show_p');
    }
    public function detail_a($id)
    {
        $event = Evenement::find($id);
        $gen = Generation::find($id);
        $pa = Participant::where('id_evenement', $id)->count();
        $anime = Animateur::where('id_evenement', $id)->get();
        $affiche = Affiche::where('id_evenement', $id)->first();
        $aff = $affiche->nom;
        $arr = array($event,$gen,$pa,$anime,$aff);
        return view('detail.admin')->with('event', $arr);
    }
    public function detail_h($id)
    {
        $event = Evenement::find($id);
        $gen = Generation::find($id);
        $pa = Participant::where('id_evenement', $id)->count();
        $anime = Animateur::where('id_evenement', $id)->get(); 
        $affiche = Affiche::where('id_evenement', $id)->first();
        $aff = $affiche->nom;
        $place = $event->nb_place;
        $reste = $place - $pa;
        $arr = array($event,$gen,$reste,$anime,$aff);
        return view('detail.home')->with('event', $arr);
    }
    public function profil($id)
    {
        $admin = Admin::find($id);
        $event = Evenement::count();
        $par = Participant::count();
        $anime = Animateur::count();

        $arr = array($admin,$event,$par,$anime);
        return view('profil')->with('admin', $arr);
    }
    public function dep(Request $request)
    {
        $nb = $request->input('nb_dep');
        $id = $request->input('id_eve'); 
        $arr = array($nb, $id);
        return view('depenses')->with('nb', $arr);
    }
    public function affiche($id)
    {
        $affiche = Affiche::where('id_evenement', $id)->first();
        $aff = $affiche->nom;
        $pdf = PDF::loadView('affiche', compact('aff'));
        return $pdf->download('affiche.pdf');
        // $pdf = App::make('dompdf.wrapper');
        // $html = "<img src='{{asset('".$aff."')}}' alt='image'>";
        // $pdf->loadHTML($html);
        // return $pdf->stream();
        //return view('affiche')->with('path', $aff);
    }
    
}
