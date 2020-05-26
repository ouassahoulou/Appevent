<?php

namespace App\Http\Controllers;

use App\Attestation;
use App\Evenement;
use App\Generation;
use App\Participant;

// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AttestationController extends Controller
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
    public function zip($folder)
    {
        $f = "AT\\".$folder;
        $zip_file = 'attestations.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = 'C:\xampp\htdocs\Appevent01\storage\app\public\AT\\'.$folder;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $participants = Participant::where('id_evenement', $id)->get();
        $event = Generation::where('id_evenement', $id)->first();
        //creation du repertoire 
        $folder = 'Eve'.time();
        foreach ($participants as $p) {
            $att = Image::make('storage/AT/Attestation.png');
            //saisir le nom
            $fullname1 = $p->nom.' '.$p->prenom;
            $att->text($fullname1, 1240, 1391.2, function($font) {   
                $font->file(public_path('fonts/georgia bold.ttf'));
                $font->size("113.2");
                $font->color('#080200');
                $font->align('center');
                $font->valign('top'); 
            });
            //saisir le titre
            $titre = $event->titre;
            $att->text($titre, 1240, 2158.8, function($font) {   
                $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
                $font->size("148");
                $font->color('#080200');
                $font->align('center');
                $font->valign('top'); 
            });
            //saisir la date
            $date = $event->date;
            $att->text($date, 1001.5, 2594, function($font) {   
                $font->file(public_path('fonts/book-antiqua.ttf'));
                $font->size("110");
                $font->color('#080200');
                $font->align('center');
                $font->valign('top'); 
            });
            //saisir l'emplacement
            $locale = $event->locale;
            $att->text($locale, 1873.7, 2594, function($font) {   
                $font->file(public_path('fonts/book-antiqua.ttf'));
                $font->size("110");
                $font->color('#080200');
                $font->align('center');
                $font->valign('top'); 
            });

            //enregistrer l'attestation
            $fullname2 = $p->nom.'_'.$p->prenom;
            $name = "storage/AT/".$fullname2.'_'.time().'.'."png";
            $att->save($name);
            
            //enregistrer les infos de l'attestation
            $attestation = new Attestation;
            $attestation->path = $name;
            $attestation->id_participant = $p->id;
            $attestation->id_evenement = $id;
            $attestation->folder = $folder;
            $attestation->save();
        }
        
        return redirect()->route('attestation.edit', $id);
        // return redirect('home')->with('success', 'Attestations généré'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $a = Attestation::where('id_evenement', $id)->first();
        $folder = $a->folder;
         $f = 'public/AT/'.$folder;
         
         $result = Storage::makeDirectory($f);
        $store = 'storage/AT/'.$folder;
        $att = Attestation::where('id_evenement', $id)->get();
        foreach ($att as $a) {
            $path = $a->path;
            $pdf = PDF::loadView('attestation', compact('path'));
            
            $ch = $store.'/'.time().'.'.'pdf';
            $pdf->save($ch);
        }
        return redirect()->route('zip',$folder);
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
