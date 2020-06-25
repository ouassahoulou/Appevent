<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Evenement;
use App\Generation;
use App\Animateur;
use Illuminate\Support\Facades\Storage;
use App\Affiche;
use App\Attestation;
use App\Depenses;
use App\Participant;
use App\Participant_financier;
use App\Remplissage;

class EventController extends Controller
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
       return view('event');
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
        $this->validate($request, [
            'titre' => 'required',
            'type' => 'required',
            'locale' => 'required',
            'number' => 'required',
            'timing' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'plan' => 'required',
            'description' => 'required',
            'nb_place' => 'required',
            'nb_pause' => 'required'
        ]);

        $event = new Evenement;
        $generate = new Generation;
        
        $event->plan = $request->input('plan');
        $event->description = $request->input('description');
        $event->type = $request->input('type');
        $event->nb_place = $request->input('nb_place');
        $duree = $request->input('number')." ".$request->input('timing');
        $event->duree = $duree;
        $event->modified = false;
        $event->nb_pause = $request->input('nb_pause');
        if ($request->input('free')) {
            $event->free = 1;
            $generate->free = 1;
        } else {
            $event->free = 0;
            $generate->free = 0;
        }

        $generate->titre = $request->input('titre');
        $generate->locale = $request->input('locale');
        $generate->date = $request->input('date');
        $generate->heure = $request->input('heure');
            $event->save();
        
            $length = Evenement::pluck('id')->last();
            $generate->id_evenement = $length;
            $generate->id_affiche = $length;
            $generate->id_attestation = $length;
            $generate->save();

        $path = 'public/Justificatif/Evenement_'.$length;
        $result = Storage::makeDirectory($path);
        $nb_animateur  = $request->input('nb_animateur');
        $nb_organisateur = $request->input('nb_org');
        $nb_pf = $request->input('nb_pf');
        $arr = array($nb_animateur,$nb_organisateur,$length,$nb_pf);
        return view('animateur')->with('nb', $arr);
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
        $event = Evenement::find($id);
        $gen = Generation::where('id_evenement', $id)->first();
        $nb_a = Animateur::where('id_evenement', $id)->count();
        $arr = array($event,$gen,$nb_a);
        return view('edit')->with('modify', $arr);
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
        $this->validate($request, [
            'titre' => 'required',
            'type' => 'required',
            'locale' => 'required',
            'number' => 'required',
            'timing' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'plan' => 'required',
            'nb_place' => 'required',
            'nb_pause' => 'required'
        ]);

        $event = Evenement::find($id);      
        $generate = Generation::where('id_evenement', $id)->first();
        
        $event->plan = $request->input('plan');
        $event->type = $request->input('type');
        $event->nb_place = $request->input('nb_place');
        $duree = $request->input('number')." ".$request->input('timing');
        $event->duree = $duree;
        $event->modified = true;
        $event->nb_pause = $request->input('nb_pause');
        if ($request->input('free')) {
            $event->free = 1;
            $generate->free = 1;
        } else {
            $event->free = 0;
            $generate->free = 0;
        }
        
        $generate->titre = $request->input('titre');
        $generate->locale = $request->input('locale');
        $generate->date = $request->input('date');
        $generate->heure = $request->input('heure');
            $event->save();
            $generate->save();

        // $length = $id;
        // $generate->id_evenement = $length;
        // $generate->id_affiche = $length;
        // $generate->id_attestation = $length;
        // $generate->save();

        $nb_animateur  = $request->input('nb_animateur');
        $nb_organisateur = $request->input('nb_org');
        $nb_pf = $request->input('nb_pf');
        $arr = array($id,$nb_animateur,$nb_organisateur,$nb_pf);
        Animateur::where('id_evenement', $id)->delete();

        // foreach ($animate as $value) {
        //     $value->delete();
        // }
        return view('edit_animateur')->with('tab',$arr);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
                //   Evenement
                $event=Evenement::find($id);
                // Animateur 
          $animateur = Animateur::where('id_evenement', $id);
          $file1= Animateur::select('animateur_image')->where('id_evenement', $id)->get();
          // Supression des animateurs
         foreach ($file1 as $files) {
         $p=strlen($files);
         $ss=substr($files,0,$p-2);
         $s=substr($ss,20,$p);
         Storage::delete('public/PDP/'.$s);}
         
         
          // Generation
          $gen=Generation::where('id_evenement', $id);
          // Affiche
          $aff=Affiche::where('id_evenement', $id);
          $file2= Affiche::select('nom')->where('id_evenement', $id)->get();
          $p=strlen($file2);
          $ss=substr($file2,0,$p-3);
          $s=substr($ss,22,$p);
          Storage::delete('public/AF/'.$s);
          
         
          // Attestation
          $att=Attestation::where('id_evenement', $id);
           // Depenses
          $dep=Depenses::where('id_evenement', $id);
          // Participant
          $par=Participant::where('id_evenement', $id);
          // Participant_financier
          $par_f=Participant_financier::where('id_evenement', $id);
          $file3= Participant_financier::select('logo')->where('id_evenement', $id)->get();
          // suppresion des participants financiers
          foreach ($file3 as $files) {
              $p=strlen($files);
            $ss=substr($files,0,$p-2);
             $s=substr($ss,9,$p);
             Storage::delete('public/Organisme/'.$s);}
            // Remplissage
       $com=Remplissage::where('id_evenement', $id);
      
         
      
          //   suppresion des lignes de chaque table
          
           $event->delete();
           $animateur->delete();
           $gen->delete();
           $aff->delete();
           $att->delete();
           $dep->delete();
           $par->delete();
           $par_f->delete();
           $com->delete();
            return redirect('home');
    }
    public function DownloadWord($id){
        $headers = array(
            "Content-type"=>"text/html",
            "Content-Disposition"=>"attachment;Filename=Plan.doc"
        );

        // Plan
          $content1= DB::table('evenements')->select('Plan')->where('id', '=', $id)->get();
         $p=strlen($content1);
         $s=substr($content1,0,$p-3);
         $t= substr( $s,10);
        //  titre
        $content2 = DB::table('generations')->select('titre')->where('id', '=', $id)->get();
        $p1=strlen($content2);
         $s1=substr($content2,0,$p1-2);
         $t1= substr( $s1,10);
        return \Response::make('<html>
                  <head><meta charset="utf-8"></head>
                  <body>
                      <h1 style" text-align: center;"> '.$t1.' </h1>
                      <p>'.$t.'</p>
                  </body>
                  </html>',200, $headers);
 }
 public function search(Request $req){
    if($req->search==""){
        return redirect('home')->with('error', 'Veuillez Saisir Encore Une Fois Le Titre ');
        
    } else {
        $gen=Generation::where('titre','LIKE','%'.$req->search.'%')->get();
        $event = Evenement::orderBy('created_at', 'desc')->paginate(12);
        $arr = array($event,$gen);
         return view('home')->with('evenements',$arr); }
        }
    
}



    
