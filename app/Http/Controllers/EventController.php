<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evenement;
use App\Generation;
use App\Animateur;
use Illuminate\Support\Facades\Storage;
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
        
        $length = Evenement::count();
        $generate->id_evenement = $length;
        $generate->id_affiche = $length;
        $generate->id_attestation = $length;
        $generate->save();

        $path = 'public/Justificatif/Evenement_'.$length;
        $result = Storage::makeDirectory($path);
        $nb_animateur  = $request->input('nb_animateur');

        return view('animateur')->with('nb', $nb_animateur);

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
        $arr = array($id,$nb_animateur);
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
    { $s=Evenement::find($id);
       $s->delete();
      return redirect('home');
    }
    
}
