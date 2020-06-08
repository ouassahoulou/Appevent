<?php

namespace App\Http\Controllers;

use App\Affiche;
use Illuminate\Http\Request;
use App\Animateur;
use App\Evenement;
use App\Remplissage;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class AnimateurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('animateur');
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
        $nb = $request->input('nb_animateur');
        $id = $request->input('id_ev');
        $id1 = $request->input('id_eve');
        $org = $request->input('nb_org');
        $length = Evenement::count();
        $a = Animateur::count();
        if (is_numeric($id)&&($id < $length)) {
            $length = $id;
            for ($i=0; $i < $nb; $i++) {
                $imageName = $request->input('nom'.$i).'_'.$request->input('prenom'.$i).$a.'.'.$request->animateur_image[$i]->extension();
                $path = $request->animateur_image[$i]->storeAs('public/PDP', $imageName);
                
                $animateur = new Animateur;
                $animateur->nom = $request->input('nom'.$i);
                $animateur->prenom = $request->input('prenom'.$i);
                $animateur->profession = $request->input('profession'.$i);
                $animateur->animateur_image = $imageName;
                $animateur->id_evenement = $length;
                $animateur->save();
            }
            $aff = Affiche::where('id_evenement', $id)->first();
            $image = $aff->nom;
            Storage::delete($image);
            Affiche::where('id_evenement', $id)->delete();
            switch ($nb) {
                case '1':
                    return redirect()->route('affiche.show_m1',$length);
                    break;
                case '2':
                    return redirect()->route('affiche.show_m2',$length);
                    break;
                case '3':
                    return redirect()->route('affiche.show_m3',$length);
                    break;
                default:
                return redirect()->route('affiche.show',$length);
                    break;
            }
            // return redirect('home')->with('success', 'Evenement modifié');
        }
        else{
        for ($i=0; $i < $nb; $i++) {
           $fileNameToStore = $request->input('nom'.$i).'_'.$request->input('prenom'.$i).$a.'.'.$request->animateur_image[$i]->extension();
                //upload images
            $path = $request->animateur_image[$i]->storeAs('public/PDP', $fileNameToStore);
            
            $animateur = new Animateur;
            $animateur->nom = $request->input('nom'.$i);
            $animateur->prenom = $request->input('prenom'.$i);
            $animateur->profession = $request->input('profession'.$i);
            $animateur->animateur_image = $fileNameToStore;
            $animateur->id_evenement = $length;
            $animateur->save();
        }
        for ($j=0; $j < $org; $j++) { 
            $organisateur = new Remplissage;
            $organisateur->id_evenement = $id1;
            $organisateur->nom = $request->input('nom_org'.$j);
            $organisateur->prenom = $request->input('prenom_org'.$j);
            $organisateur->save();
        }
        switch ($nb) {
            case '1':
                return redirect()->route('affiche.show1',$length);
                break;
            case '2':
                return redirect()->route('affiche.show2',$length);
                break;
            case '3':
                return redirect()->route('affiche.show3',$length);
                break;
            case '4':
                return redirect()->route('affiche.show4',$length);
                break;
            case '5':
                return redirect()->route('affiche.show5',$length);
                break;
            case '6':
                return redirect()->route('affiche.show6',$length);
                break;
            default:
            return redirect()->route('affiche.show',$length);
                break;
        }
        
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
        // foreach ($arr as $value) {
        //     $id[] = $value;
        // }
        $nb_a = Animateur::where('id_evenement', $id)->first();
        $nb = Animateur::where('id_evenement', $id)->count();
        $tab = array($nb,$nb_a,$id);
        return view('edit_animateur')->with('tab', $tab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $arr)
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
