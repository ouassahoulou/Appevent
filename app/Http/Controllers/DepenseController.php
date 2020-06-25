<?php

namespace App\Http\Controllers;

use DB;
use App\Depenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;





class DepenseController extends Controller
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
    public function index(Request $request)
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
        $nb = $request->input('nb_dep');
        $id = $request->input('id_eve');
        // suppresion de la derniere ligne de output
         $laast=Depenses::where('id_evenement', $id)->get()->last();
         if($laast!=null)
         {  $laast->output=0;
          }
         
        //   suppresion de la premiere ligne de input
        $first=Depenses::where('id_evenement', $id)->get()->first();
        if($first!=null)
        { $first->input=0;
         }

         for ($i=0; $i < $nb; $i++) { 
             $dep = new Depenses;
             $qte = $request->input('quantité'.$i);
             $dep->label = $qte.' x '.$request->input('label'.$i);
             $dep->date = $request->input('date'.$i);
             $dep->somme = $qte*($request->input('somme'.$i));
             $dep->Input=0;
             $dep->Output=0;
            // if ($request->input('j'.$i))
            //  echo 'j'.$i;
            //  else
            //  echo ' nop ';
             if ($request->input('j'.$i)) {
                
                $dep->justificatif = null;
             }
             else {
                if (!$request->justif[$i] )
                {return  redirect()->route('depense.show', $id)->with('error', 'Veuiller Vérifier le Switch Button pour les justificatifs ');}
 else {
    
     $justif = $request->input('label'.$i).'.'.$request->justif[$i]->extension();
                $p = 'public/Justificatif/Evenement_'.$id;
                $path = $request->justif[$i]->storeAs($p, $justif);
                $dep->justificatif = $justif;
             }}
             $dep->id_evenement = $id;

             $dep->save();
        }
        if($laast!=null)
        $laast->save();
        if($first!=null)
         $first->save();
        // output depenses
        $p=Depenses::where('id_evenement',$id)->get()->last();
        $result = DB::table('depenses')->where('id_evenement',$id)->selectRaw('sum(somme)')->get();
        $pp=strlen($result);
        $ss=substr($result,0,$pp-2);
        $s=substr($ss,15,$pp);
         $p->output=$s; 
         $p->save();
         // input depenses
         $premiereligne=Depenses::where('id_evenement',$id)->get()->first();
         $result2 = DB::table('participant_financiers')->where('id_evenement',$id)->selectRaw('sum(montant_investi)')->get();

        $q=strlen($result2);
        $sss=substr($result2,0,$q-2);
        $z=substr($sss,25,$q);
        $premiereligne->input=$z;
        $premiereligne->save();
        
       return redirect()->route('depense.show', $id);
    }

                
                    
             
               
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depenses = Depenses::where('id_evenement', $id)->paginate(7);
        $arr = array($depenses,$id);
        return view('list_dep')->with('depenses', $arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $f = 'Justificatif\Evenement_'.$id;
        $zip_file = 'justificatif.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = 'C:\xampp\htdocs\Appevent01\storage\app\public\Justificatif\Evenement_'.$id;
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        return response()->download($zip_file);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    {
        return view('modify_dep')->with('nb', $id);
    }
    public function update(Request $request, $id)
    {
        $dep = Depenses::find($id);
        $id_eve = $dep->id_evenement;
        if ($dep->justificatif) {
            $justif = $dep->justificatif;
            $path = 'storage/Justificatif/Evenement_'.$id_eve.'/'.$justif;
            Storage::delete($path);
        }
        $qte = $request->input('quantité');
             $dep->label = $qte.' x '.$request->input('label');
             $dep->date = $request->input('date');
             $dep->somme = $qte*($request->input('somme'));
            // if ($request->input('j'.$i))
            //  echo 'j'.$i;
            //  else
            //  echo ' nop ';
             if ($request->input('j')) {
                
                $dep->justificatif = null;
             }
             else {
                $justif = $request->input('label').'.'.$request->justif->extension();
                $p = 'public/Justificatif/Evenement_'.$id_eve;
                $path = $request->justif->storeAs($p, $justif);
                $dep->justificatif = $justif;
             }
             
             $dep->save();
             
        return redirect()->route('depense.show',$id_eve);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $dep = Depenses::find($id);
        $id_eve = $dep->id_evenement;
        if ($dep->justificatif) {
            $justif = $dep->justificatif;
            $path = 'storage/Justificatif/Evenement_'.$id_eve.'/'.$justif;
            Storage::delete($path);
        }
        $dep->delete();
        return redirect()->route('depense.show',$id_eve);
    }
   
   
}
