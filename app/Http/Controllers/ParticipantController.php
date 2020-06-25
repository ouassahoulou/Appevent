<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Evenement;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\Datatables\Datatables;
use App\Generation;

class ParticipantController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        // return view('participant')->with('eve',$id);
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
        $this->validate($request,[
            'nom' => 'required',
            'email'=> 'required',
            'profession' => 'required',
            'cin' => 'required',
            'naissance' => 'required'
        ]);
        $nb = $request->input('id');
        $mail = $request->input('email');
        
        $cmp = 0;
        
        $pa = Participant::all()->where('id_evenement', $nb);
        foreach ($pa as  $value) {
            $email = $value->email;
            if (strcmp($email, $mail) == 0) {
                $cmp++;
           }
        }

            if ($cmp != 0) {
                return redirect('/')->with('error', "L’adresse e-mail que vous avez saisie est déjà enregistrée.");
            } else {
                $participe = new Participant;
                $participe->nom = $request->input('nom');
                $participe->prenom = $request->input('prenom');
                $participe->telephone = $request->input('telephone');
                $participe->email = $request->input('email');
                $participe->profession = $request->input('profession');
                $participe->CIN = $request->input('cin');
                $participe->naissance = $request->input('naissance');
                $participe->id_evenement = $request->input('id');
                $participe->save();

                 return redirect('/')->with('success', 'Participation réussie');
            }
            
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $p = Participant::where('id_evenement', $id)->get();
        $arr = array($id,$p);
        
        return view('show_p')->with('p', $arr);
        
    }
    public function anyData(Request $request, $i)
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
        $e = Evenement::find($id);
        $nbp = $e->nb_place;
        $place = Participant::where('id_evenement', $id)->count();
        if ($nbp == $place) {
            return redirect('/')->with('error', "Désolé, Il n'y a plus de place disponible.");
        }
        else {
            return view('participant')->with('eve',$id);
        }
        
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
        $s=Participant::find($id);
        $var=$s->id_evenement;
        $s->delete();
        return redirect()->route('participate.show',$var);

    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Participant::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Supprimé avec Succés."]);
        
        
    }
    public function downloadPDF($id) {
        $participant = Participant::where('id_evenement', $id)->get();
        $pdf = PDF::loadView('pdf', compact('participant'));
        
        return $pdf->download('Participants.pdf');
    }
    public function search(Request $req){
        if($req->search==""){
            return redirect('gestion_p')->with('error', 'Veuillez Saisir Encore Une Fois Le Titre ');
            
        } else {
            $gen=Generation::where('titre','LIKE','%'.$req->search.'%')->get();
            $event = Evenement::orderBy('created_at', 'desc')->paginate(12);
            $arr = array($event,$gen);
             return view('gestion_p')->with('evenements',$arr); }
            }
}