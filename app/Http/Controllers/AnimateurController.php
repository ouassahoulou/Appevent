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
        // pour modification
        $id = $request->input('id_ev');
        // pour store
        $id1 = $request->input('id_eve');
        $org = $request->input('nb_org');
        $nb_pf = $request->input('nb_pf');
        // $length = Evenement::count();
        $a = Animateur::count();
       $event= Evenement::select('modified')->where('id', $id)->get();    
        
        if (is_numeric($id)&&( $event == true)) {
            $length = $id;
            for ($i=0; $i < $nb; $i++) {
                $imageName = $request->input('nom'.$i).'_'.$request->input('prenom'.$i).$a.'.'.$request->animateur_image[$i]->extension();
                $path = $request->animateur_image[$i]->storeAs('public/PDP', $imageName);
                
                $animateur = new Animateur;
                $animateur->nom = $request->input('nom'.$i);
                $animateur->prenom = $request->input('prenom'.$i);
                $animateur->profession = $request->input('profession'.$i);
                $animateur->animateur_image = $imageName;
                $animateur->id_evenement = $id;
                 $animateur->save();
               
            }
            // $aff = Affiche::where('id_evenement', $id)->first();
            // $image = $aff->nom;
            // Storage::delete($image);


            // SUPPRESION DE L(AFFICHE)
          
            $file2= Affiche::select('nom')->where('id_evenement', $id)->get();
          $p=strlen($file2);
          $ss=substr($file2,0,$p-3);
          $s=substr($ss,22,$p);
          Storage::delete('public/AF/'.$s);

            Remplissage::where('id_evenement', $id)->delete();
            for ($j=0; $j < $org; $j++) { 
                $organisateur = new Remplissage;
                $organisateur->id_evenement = $id;
                $organisateur->nom = $request->input('nom_org'.$j);
                $organisateur->prenom = $request->input('prenom_org'.$j);
                $organisateur->save();
            }
            $arr = array($length,$nb,$nb_pf);

            
        return view('par_fin')->with('arr', $arr);
        
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
            $animateur->id_evenement =  $id1;
            $animateur->save();
        }
        $c = Remplissage::where('id_evenement',  $id1)->count();
        if($c != 0)
        {
            Remplissage::where('id_evenement',  $id1)->delete();
        }
        for ($j=0; $j < $org; $j++) { 
            $organisateur = new Remplissage;
            $organisateur->id_evenement =  $id1;
            $organisateur->nom = $request->input('nom_org'.$j);
            $organisateur->prenom = $request->input('prenom_org'.$j);
            $organisateur->save();
        }
        $arr = array( $id1,$nb,$nb_pf);
        return view('par_fin')->with('arr', $arr);
        
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
