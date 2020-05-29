<?php

namespace App\Http\Controllers;
use App\Affiche;
use App\Animateur;
use App\Evenement;
use App\Generation;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class AfficheController extends Controller
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

    }
    
    public function show1($id)
    {
        $animateur = Animateur::where('id_evenement', $id)->first();
        $generate = Generation::find($id);
        $event= Evenement::find($id);
        
        $img_name_ext = $animateur->animateur_image;
        $img_name = strstr($img_name_ext,'.',true);
        $make = "storage/PDP/".$img_name_ext;
        $aff1A = "storage/AF/001.png";
        //resize the animateur profil
        $resize = Image::make($make)->resize(1500,1500);
        $resize->save($make);
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur
        $ap->insert($make,'top_left',1950,3336);
        $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff1A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 2700, 780, function($font) {   
            $font->file(public_path('fonts/Title.otf'));
         $font->size("400");
          $font->color('#080200');
          $font->align('center');
          $font->valign('top'); 
        });
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 63));
        $h = 1825;
        foreach ($lines as $line) {
         $aff->text($line , 219,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("170");
            $font->color('#080200');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 170;
     }
        //inserer l'animateur
     $aff->text('Animé Par :', 2700, 3100, function($font) {   
         $font->file(public_path('fonts/RSB.ttf'));
      $font->size("190");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
    });
    //inserer le nom de l'animateur
    $nom_a = $animateur->nom.' '.$animateur->prenom;
    $aff->text($nom_a, 2700, 4891, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("185");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
   });
   //inserer la profession de l'animateur
   $p_a = $animateur->profession;
   $aff->text($p_a, 2700, 5100, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("170");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
 });
  //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 948, 6090, function($font) {   
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 2700, 6090, function($font) {  
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 21){
      $aff->text($locale, 4471, 6050, function($font) {   
         $font->file(public_path('fonts/RFlexBold.ttf'));
      $font->size("180");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 21));
         $h = 6040;
         foreach ($lines as $line) {
          $aff->text($line , 4471,$h, function($font){
             $font->file(public_path('fonts/RFlexBold.ttf'));
             $font->size("170");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 170;
      }
     }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        $affiche = new Affiche;
        $affiche->nom = $name;
        $affiche->id_evenement = $id;
        $affiche->save();

        //return $aff->response('png');
         return redirect('home')->with('success', 'Evenement créé et affiche généré');
    }
    public function show2($id)
    {
        $animateur = Animateur::where('id_evenement', $id)->get();
        $generate = Generation::find($id);
        $event = Evenement::find($id);
        
        foreach($animateur as $p){
        $img_name_ext[] = $p->animateur_image;
        $fullname[] = $p->nom.' '.$p->prenom;
        $profession[] = $p->profession;
        }
        for($i=0; $i<2; $i++)
        {
            $img_name[] = strstr($img_name_ext[$i],'.',true);
            $make[$i] = "storage/PDP/".$img_name_ext[$i];
            $aff2A = "storage/AF/002.png";
        //resize the animateur profil dynamicely
        $resize = Image::make($make[$i])->resize(1500,1500);
        $resize->save($make[$i]);
        }
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur1
        $ap->insert($make[0],'top_left', 900,3336);
        //inserer l'image de l'animateur2
        $ap->insert($make[1],'top_left', 3000,3336);
        //enregistrer l'arriere plan
        $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff2A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 2700, 780, function($font) {   
            $font->file(public_path('fonts/Title.otf'));
         $font->size("400");
          $font->color('#080200');
          $font->align('center');
          $font->valign('top'); 
        });
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 63));
        $h = 1825;
        foreach ($lines as $line) {
         $aff->text($line , 219,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("170");
            $font->color('#080200');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 170;
     }
     //inserer l'animateur
     $aff->text('Animé Par :', 2700, 3100, function($font) {   
      $font->file(public_path('fonts/RSB.ttf'));
   $font->size("190");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
 });
    //inserer le nom de l'animateur1
    
    $aff->text($fullname[0], 1654, 4911, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
   $font->size("165");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
 });
 //inserer le nom de l'animateur2
 
 $aff->text($fullname[1], 3754, 4911, function($font) {   
     $font->file(public_path('fonts/georgia bold.ttf'));
  $font->size("165");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
});
   //inserer la profession de l'animateur1
   
   $aff->text($profession[0], 1654, 5100, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("150");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
  });
  //inserer la profession de l'animateur2
  
  $aff->text($profession[1], 3754, 5100, function($font) {   
     $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
  $font->size("150");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
  });
  //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 948, 6090, function($font) {   
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 2700, 6090, function($font) {  
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 21){
      $aff->text($locale, 4471, 6050, function($font) {   
         $font->file(public_path('fonts/RFlexBold.ttf'));
      $font->size("180");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 21));
         $h = 6040;
         foreach ($lines as $line) {
          $aff->text($line , 4471,$h, function($font){
             $font->file(public_path('fonts/RFlexBold.ttf'));
             $font->size("170");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 170;
      }
     }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        $affiche = new Affiche;
        $affiche->nom = $name;
        $affiche->id_evenement = $id;
        $affiche->save();
    
        //return $aff->response('png');
         return redirect('home')->with('success', 'Evenement créé et affiche généré');
    }
    public  function show3($id){
        $animateur = Animateur::where('id_evenement', $id)->get();
        $generate = Generation::find($id);
        $event = Evenement::find($id);
        
        foreach($animateur as $p){
            $img_name_ext[] = $p->animateur_image;
            $fullname[] = $p->nom.' '.$p->prenom;
             $profession[] = $p->profession;
        }
        for ($i=0;$i<3;$i++)
        {
       
        $img_name[] = strstr($img_name_ext[$i],'.',true);
        $make[$i] = "storage/PDP/".$img_name_ext[$i];
        $aff3A = "storage/AF/003.png";
        //resize the animateur profil dynamicaly
        $resize = Image::make($make[$i])->resize(1500,1500);
        $resize->save($make[$i]);
    }
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur 1
        $ap->insert($make[0],'top_left', 1950,3336);
         //inserer l'image de l'animateur 2 
        $ap->insert($make[1],'top_left', 360,3600);
         //inserer l'image de l'animateur 3
         $ap->insert($make[2],'top_left', 3536,3600);
        //  enregistrer l'arriére plan
         $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff3A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 2700, 780, function($font) {   
            $font->file(public_path('fonts/Title.otf'));
         $font->size("400");
          $font->color('#080200');
          $font->align('center');
          $font->valign('top'); 
        });
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 63));
        $h = 1825;
        foreach ($lines as $line) {
         $aff->text($line , 219,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("170");
            $font->color('#080200');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 170;
     }
     //inserer l'animateur
     $aff->text('Animé Par :', 2700, 3100, function($font) {   
      $font->file(public_path('fonts/RSB.ttf'));
   $font->size("190");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
 });
    //inserer le nom de l'animateur 1
    
    $aff->text($fullname[0], 2700, 4891, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("155");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
   });
   //inserer le nom de l'animateur 2
    
   $aff->text($fullname[1], 1110, 5154, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("155");
  $font->color('#080200');
  $font->align('center');
  $font->valign('top');
});
//inserer le nom de l'animateur 3
    
$aff->text($fullname[2], 4290, 5154, function($font) {   
   $font->file(public_path('fonts/georgia bold.ttf'));
   $font->size("155");
  $font->color('#080200');
  $font->align('center');
  $font->valign('top');
});
//inserer la profession de l'animateur 1
   
$aff->text($profession[0], 2700, 5092, function($font) {   
   $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("140");
  $font->color('#080200');
  $font->align('center');
  $font->valign('top');
});
   //inserer la profession de l'animateur 2
   
   $aff->text($profession[1], 1110, 5347, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("140");
     $font->color('#080200');
     $font->align('center');
     $font->valign('top');
  });
     //inserer la Profession de l'animateur 3
$aff->text($profession[2], 4290, 5347, function($font) {   
   $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("140");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
 });

  //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 948, 6090, function($font) {   
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 2700, 6090, function($font) {  
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 21){
      $aff->text($locale, 4471, 6050, function($font) {   
         $font->file(public_path('fonts/RFlexBold.ttf'));
      $font->size("180");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 21));
         $h = 6040;
         foreach ($lines as $line) {
          $aff->text($line , 4471,$h, function($font){
             $font->file(public_path('fonts/RFlexBold.ttf'));
             $font->size("170");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 170;
      }
     }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        $affiche = new Affiche;
        $affiche->nom = $name;
        $affiche->id_evenement = $id;
        $affiche->save();

        //return $aff->response('png');
         return redirect('home')->with('success', 'Evenement créé et affiche généré');
    }
    public function show_m1($id)
    {
        $animateur = Animateur::where('id_evenement', $id)->first();
        $generate = Generation::find($id);
        $event= Evenement::find($id);
        
        $img_name_ext = $animateur->animateur_image;
        $img_name = strstr($img_name_ext,'.',true);
        $make = "storage/PDP/".$img_name_ext;
        $aff1A = "storage/AF/001.png";
        //resize the animateur profil
        $resize = Image::make($make)->resize(1500,1500);
        $resize->save($make);
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur
        $ap->insert($make,'top_left',1950,3336);
        $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff1A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 2700, 780, function($font) {   
            $font->file(public_path('fonts/Title.otf'));
         $font->size("400");
          $font->color('#080200');
          $font->align('center');
          $font->valign('top'); 
        });
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 63));
        $h = 1825;
        foreach ($lines as $line) {
         $aff->text($line , 219,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("170");
            $font->color('#080200');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 170;
     }
        //inserer l'animateur
        $aff->text('Animé Par :', 2700, 3100, function($font) {   
         $font->file(public_path('fonts/RSB.ttf'));
      $font->size("190");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
    });
    //inserer le nom de l'animateur
    $nom_a = $animateur->nom.' '.$animateur->prenom;
    $aff->text($nom_a, 2700, 4891, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("185");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
   });
   //inserer la profession de l'animateur
   $p_a = $animateur->profession;
   $aff->text($p_a, 2700, 5100, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("170");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
 });
  //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 948, 6090, function($font) {   
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 2700, 6090, function($font) {  
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 21){
      $aff->text($locale, 4471, 6050, function($font) {   
         $font->file(public_path('fonts/RFlexBold.ttf'));
      $font->size("180");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 21));
         $h = 6040;
         foreach ($lines as $line) {
          $aff->text($line , 4471,$h, function($font){
             $font->file(public_path('fonts/RFlexBold.ttf'));
             $font->size("170");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 170;
      }
     }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        $affiche = new Affiche;
        $affiche->nom = $name;
        $affiche->id_evenement = $id;
        $affiche->save();

        //return $aff->response('png');
         return redirect('home')->with('success', 'Evenement modifié et affiche généré');
    }
    public function show_m2($id)
    {
        $animateur = Animateur::where('id_evenement', $id)->get();
        $generate = Generation::find($id);
        $event = Evenement::find($id);
        
        foreach($animateur as $p){
        $img_name_ext[] = $p->animateur_image;
        $fullname[] = $p->nom.' '.$p->prenom;
        $profession[] = $p->profession;
        }
        for($i=0; $i<2; $i++)
        {
            $img_name[] = strstr($img_name_ext[$i],'.',true);
            $make[$i] = "storage/PDP/".$img_name_ext[$i];
            $aff2A = "storage/AF/002.png";
        //resize the animateur profil dynamicely
        $resize = Image::make($make[$i])->resize(1500,1500);
        $resize->save($make[$i]);
        }
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur1
        $ap->insert($make[0],'top_left', 900,3336);
        //inserer l'image de l'animateur2
        $ap->insert($make[1],'top_left', 3000,3336);
        //enregistrer l'arriere plan
        $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff2A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 2700, 780, function($font) {   
            $font->file(public_path('fonts/Title.otf'));
         $font->size("400");
          $font->color('#080200');
          $font->align('center');
          $font->valign('top'); 
        });
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 63));
        $h = 1825;
        foreach ($lines as $line) {
         $aff->text($line , 219,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("170");
            $font->color('#080200');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 170;
     }
        //inserer l'animateur
        $aff->text('Animé Par :', 2700, 3100, function($font) {   
         $font->file(public_path('fonts/RSB.ttf'));
      $font->size("190");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
    });
    //inserer le nom de l'animateur1
    
    $aff->text($fullname[0], 1654, 4911, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
   $font->size("165");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
 });
 //inserer le nom de l'animateur2
 
 $aff->text($fullname[1], 3754, 4911, function($font) {   
     $font->file(public_path('fonts/georgia bold.ttf'));
  $font->size("165");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
});
   //inserer la profession de l'animateur1
   
   $aff->text($profession[0], 1654, 5100, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("150");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
  });
  //inserer la profession de l'animateur2
  
  $aff->text($profession[1], 3754, 5100, function($font) {   
     $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
  $font->size("150");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
  });
  //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 948, 6090, function($font) {   
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 2700, 6090, function($font) {  
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 21){
      $aff->text($locale, 4471, 6050, function($font) {   
         $font->file(public_path('fonts/RFlexBold.ttf'));
      $font->size("180");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 21));
         $h = 6040;
         foreach ($lines as $line) {
          $aff->text($line , 4471,$h, function($font){
             $font->file(public_path('fonts/RFlexBold.ttf'));
             $font->size("170");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 170;
      }
     }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        $affiche = new Affiche;
        $affiche->nom = $name;
        $affiche->id_evenement = $id;
        $affiche->save();
    
        //return $aff->response('png');
         return redirect('home')->with('success', 'Evenement modifié et affiche généré');
    }
    public  function show_m3($id){
        $animateur = Animateur::where('id_evenement', $id)->get();
        $generate = Generation::find($id);
        $event = Evenement::find($id);
        
        foreach($animateur as $p){
            $img_name_ext[] = $p->animateur_image;
            $fullname[] = $p->nom.' '.$p->prenom;
             $profession[] = $p->profession;
        }
        for ($i=0;$i<3;$i++)
        {
       
        $img_name[] = strstr($img_name_ext[$i],'.',true);
        $make[$i] = "storage/PDP/".$img_name_ext[$i];
        $aff3A = "storage/AF/003.png";
        //resize the animateur profil dynamicaly
        $resize = Image::make($make[$i])->resize(1500,1500);
        $resize->save($make[$i]);
    }
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur 1
        $ap->insert($make[0],'top_left', 1950,3336);
         //inserer l'image de l'animateur 2 
        $ap->insert($make[1],'top_left', 360,3600);
         //inserer l'image de l'animateur 3
         $ap->insert($make[2],'top_left', 3536,3600);
        //  enregistrer l'arriére plan
         $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff3A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 2700, 780, function($font) {   
            $font->file(public_path('fonts/Title.otf'));
         $font->size("400");
          $font->color('#080200');
          $font->align('center');
          $font->valign('top'); 
        });
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 63));
        $h = 1825;
        foreach ($lines as $line) {
         $aff->text($line , 219,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("170");
            $font->color('#080200');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 170;
     }
        //inserer l'animateur
        $aff->text('Animé Par :', 2700, 3100, function($font) {   
         $font->file(public_path('fonts/RSB.ttf'));
      $font->size("190");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
    });
    //inserer le nom de l'animateur 1
    
    $aff->text($fullname[0], 2700, 4891, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("155");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
   });
   //inserer le nom de l'animateur 2
    
   $aff->text($fullname[1], 1110, 5154, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("155");
  $font->color('#080200');
  $font->align('center');
  $font->valign('top');
});
//inserer le nom de l'animateur 3
    
$aff->text($fullname[2], 4290, 5154, function($font) {   
   $font->file(public_path('fonts/georgia bold.ttf'));
   $font->size("155");
  $font->color('#080200');
  $font->align('center');
  $font->valign('top');
});
//inserer la profession de l'animateur 1
   
$aff->text($profession[0], 2700, 5092, function($font) {   
   $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("140");
  $font->color('#080200');
  $font->align('center');
  $font->valign('top');
});
   //inserer la profession de l'animateur 2
   
   $aff->text($profession[1], 1110, 5347, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("140");
     $font->color('#080200');
     $font->align('center');
     $font->valign('top');
  });
     //inserer la Profession de l'animateur 3
$aff->text($profession[2], 4290, 5347, function($font) {   
   $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("140");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
 });

  //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 948, 6090, function($font) {   
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 2700, 6090, function($font) {  
   $font->file(public_path('fonts/RFlexBold.ttf'));
$font->size("250");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 21){
      $aff->text($locale, 4471, 6050, function($font) {   
         $font->file(public_path('fonts/RFlexBold.ttf'));
      $font->size("180");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 21));
         $h = 6040;
         foreach ($lines as $line) {
          $aff->text($line , 4471,$h, function($font){
             $font->file(public_path('fonts/RFlexBold.ttf'));
             $font->size("170");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 170;
      }
     }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        $affiche = new Affiche;
        $affiche->nom = $name;
        $affiche->id_evenement = $id;
        $affiche->save();

        //return $aff->response('png');
         return redirect('home')->with('success', 'Evenement modifié et affiche généré');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Share::currentPage()->facebook();
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
