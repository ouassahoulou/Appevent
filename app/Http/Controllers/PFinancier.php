<?php

namespace App\Http\Controllers;

use App\Participant_financier;
use Illuminate\Http\Request;

class PFinancier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $nbf = $request->input('nb_financier');
        $id_ev = $request->input('id_ev');
        $nba = $request->input('nb_a');
        $exist = Participant_financier::where('id_evenement', $id_ev)->count();
        if($exist != 0)
        {
            $pf = Participant_financier::where('id_evenement', $id_ev)->delete();
        }
        for($i=0; $i < $nbf; $i++){ 
            $financier = new Participant_financier;
            $financier->nom = $request->input('nom'.$i);
            $financier->prenom = $request->input('prenom'.$i);
            $financier->telephone = $request->input('telephone'.$i);
            $financier->email = $request->input('email'.$i);
            $financier->nom_organisme = $request->input('nom_org'.$i);
            $financier->montant_investi = $request->input('Mt_investi'.$i);
            $financier->id_evenement= $id_ev;

            $fileNameToStore = $request->input('nom_org'.$i).$id_ev.'.'.$request->participant_financier[$i]->extension();
                //upload images
            $path = $request->participant_financier[$i]->storeAs('public/Organisme', $fileNameToStore);
            
            $financier->logo = $fileNameToStore;
            $financier->save();
        }
        switch ($nba) {
            case '1':
                return redirect()->route('affiche.show1',$id_ev);
                break;
            case '2':
                return redirect()->route('affiche.show2',$id_ev);
                break;
            case '3':
                return redirect()->route('affiche.show3',$id_ev);
                break;
            case '4':
                return redirect()->route('affiche.show4',$id_ev);
                break;
            case '5':
                return redirect()->route('affiche.show5',$id_ev);
                break;
            case '6':
                return redirect()->route('affiche.show6',$id_ev);
                break;
            default:
            return redirect()->route('affiche.show',$id_ev);
                break;
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
