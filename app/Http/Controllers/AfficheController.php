<?php

namespace App\Http\Controllers;
use App\Affiche;
use App\Animateur;
use App\Evenement;
use App\Generation;
use App\Remplissage;
use App\Participant_financier;
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
        $generate = Generation::where('id_evenement', $id)->first();
$event= Evenement::find($id);
        
        $img_name_ext = $animateur->animateur_image;
        $make = "storage/PDP/".$img_name_ext;
        $aff1A = "storage/AF/001.png";
        //resize the animateur profil
        $resize = Image::make($make)->resize(1054,1054);
        $resize->save($make);
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur
        $ap->insert($make,'top_left',1216,2266);
        $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff1A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 1754, 280, function($font) {   
         $font->file(public_path('fonts/BookA.ttf'));
         $font->size("200");
       $font->color('#000000');
       $font->align('center');
       $font->valign('top'); 
       });
       //inserer la date de l'événement
  $date = $generate->date;
  $m = $date[5].$date[6];
  switch($m)
  {
     case '01':
        $mon = 'Janvier';
        break;
     case '02':
        $mon = 'Février';
        break;
     case '03':
        $mon = 'Mars';
        break;
     case '04':
        $mon = 'Avril';
        break;
     case '05':
        $mon = 'Mai';
        break;
     case '06':
        $mon = 'Juin';
        break;
     case '07':
        $mon = 'Juillet';
        break;
     case '08':
        $mon = 'Août';
        break;
     case '09':
        $mon = 'Septembre';
        break;
     case '10':
        $mon = 'Octobre';
        break;
     case '11':
        $mon = 'Novembre';
        break;
     case '12':
        $mon = 'Décembre';
        break;
  }
  if (strcmp($date[8],'0') == 0) {
     $day = $date[9];
  } else {
    $day = $date[8].$date[9];
  }
  
  $c_d = $day.' '.$mon.' '.$date[0].$date[1].$date[2].$date[3];
  $aff->text($c_d, 828, 715, function($font) {   
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $minute = $heure[3].$heure[4];
    if(strcmp($minute,'00') == 0)
    $time = $heure[0].$heure[1].'h'; 
    else
    $time = $heure[0].$heure[1].'h'.$minute;
 $aff->text($time, 1911.1, 715, function($font) {  
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 14){
      $aff->text($locale, 3029.1, 715, function($font) {   
         $font->file(public_path('fonts/bookman-old-style.ttf'));
       $font->size("120");
       $font->color('#494949');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 14));
         $h = 677.9;
         foreach ($lines as $line) {
            $aff->text($line, 3029.1, $h, function($font) {   
               $font->file(public_path('fonts/bookman-old-style.ttf'));
             $font->size("80");
             $font->color('#494949');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 130;
      }
     }
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 70));
        $h = 987;
        foreach ($lines as $line) {
         $aff->text($line , 44,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("100");
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 130;
     }
    //inserer le nom de l'animateur
    $nom_a = $animateur->nom.' '.$animateur->prenom;
    $aff->text($nom_a, 1754, 3314, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("125");
      $font->color('#000000');
      $font->align('center');
      $font->valign('top');
   });
   //inserer la profession de l'animateur
   $p_a = $animateur->profession;
   $aff->text($p_a, 1754, 3514.8, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("90");
    $font->color('#000000');
    $font->align('center');
    $font->valign('top');
 });
  //comité
$org = Remplissage::where('id_evenement', $id)->count();
$o = Remplissage::where('id_evenement', $id)->get();
foreach ($o as $value) {
   $name[] = '- '.$value->nom.' '.$value->prenom;
}
   switch ($org) {
      case '1':
       $aff->text($name[0], 1192.2, 4060.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("120");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
     });
         break;
      case '2':
         //organisateur 1
         $aff->text($name[0], 1192.2, 4025.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         //organisateur 2
         $aff->text($name[1], 1192.2, 4162.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         break;
       case '3':
          //organisateur 1
       $aff->text($name[0], 1184.7, 3945.6, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 2
       $aff->text($name[1], 1184.7, 4101.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 3
       $aff->text($name[2], 1184.7, 4259.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
          break;
         case '4':
         //organisateur 1
      $aff->text($name[0], 1184.7, 3945, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 2
      $aff->text($name[1], 1184.7, 4067, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 3
      $aff->text($name[2], 1184.7, 4180, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 4
      $aff->text($name[3], 1184.7, 4293, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
         break;
       case '5':
          //organisateur 1
          $aff->text($name[0], 568, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 2
          $aff->text($name[1], 568, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 3
          $aff->text($name[2], 1803.7, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 4
          $aff->text($name[3], 1803.7, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 5
          $aff->text($name[4], 1184.7, 4259.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
             break;
         case '6':
         //organisateur 1
         $aff->text($name[0], 1184.6, 3898, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 2
         $aff->text($name[1], 1184.6, 3975, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 3
         $aff->text($name[2], 1184.6, 4053, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 4
         $aff->text($name[3], 1184.6, 4131, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 5
         $aff->text($name[4], 1184.6, 4211, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 6
         $aff->text($name[5], 1184.6, 4289, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
            break;
   }
      //participant financier
      $nb_pf = Participant_financier::where('id_evenement', $id)->count();
         $pfs = Participant_financier::where('id_evenement', $id)->get();
         foreach ($pfs as $pf) {
           $mf[] = "storage/Organisme/".$pf->logo;
         } 
         switch ($nb_pf) {
            case '1':
               $resize = Image::make($mf[0])->resize(1081,466);
               $resize->save($mf[0]);
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',678 ,4448);
               break;
            case '2':
               for ($i=0; $i < 2; $i++) { 
                  $resize = Image::make($mf[$i])->resize(1081,466);
                  $resize->save($mf[$i]);
               }
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',27,4448);
               //inserer l'image du sponsor 2
               $aff->insert($mf[1],'top_left',1215,4448);
               break;
               case '3':
                  for ($i=0; $i < 3; $i++) { 
                     $resize = Image::make($mf[$i])->resize(732,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',27,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',796 ,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1564 ,4448);
                  break;
               case '4':
                  for ($i=0; $i < 4; $i++) { 
                     $resize = Image::make($mf[$i])->resize(550,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',0,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',591,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1181,4448);
                  //inserer l'image du sponsor 4
                  $aff->insert($mf[3],'top_left', 1771,4448);
                  break;
         }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        if(!$event->modified)
        {
         $affiche = new Affiche;
         $affiche->nom = $name;
         $affiche->id_evenement = $id;
         $affiche->save();
         
          return redirect('home')->with('success', 'Evenement créé et affiche généré');
          
        }
        else
        {
           $affiche = Affiche::where('id_evenement', $id)->first();
           $affiche->nom = $name;
           $affiche->save();
           $eventt = Evenement::find($id);      
           $eventt->modified = false; 
           $eventt->save();
           return redirect('home')->with('success', 'Evenement modifié et affiche généré'); 
        }
       
    }
    public function show2($id)
    {
      $animateur = Animateur::where('id_evenement', $id)->get();
      $generate = Generation::where('id_evenement', $id)->first();
      $event= Evenement::find($id);
        
      
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
      $resize = Image::make($make[$i])->resize(935,935);
      $resize->save($make[$i]);
      }
      //mettre l'arriere plan
      $ap = Image::make("storage/AF/AP.png");
      //inserer l'image de l'animateur1
      $ap->insert($make[0],'top_left', 570,2205);
      //inserer l'image de l'animateur2
      $ap->insert($make[1],'top_left', 1980,2205);
      //enregistrer l'arriere plan
      $ap->save("storage/AF/AP1.png");
      //inserer l'affiche
      $aff = Image::make("storage/AF/AP1.png");
      $aff->insert($aff2A);
     //inserer le titre
     $titre = $generate->titre;
     $aff->text($titre, 1754, 280, function($font) {   
      $font->file(public_path('fonts/BookA.ttf'));
      $font->size("200");
    $font->color('#000000');
    $font->align('center');
    $font->valign('top'); 
    });
    //inserer la date de l'événement
$date = $generate->date;
  $m = $date[5].$date[6];
  switch($m)
  {
     case '01':
        $mon = 'Janvier';
        break;
     case '02':
        $mon = 'Février';
        break;
     case '03':
        $mon = 'Mars';
        break;
     case '04':
        $mon = 'Avril';
        break;
     case '05':
        $mon = 'Mai';
        break;
     case '06':
        $mon = 'Juin';
        break;
     case '07':
        $mon = 'Juillet';
        break;
     case '08':
        $mon = 'Août';
        break;
     case '09':
        $mon = 'Septembre';
        break;
     case '10':
        $mon = 'Octobre';
        break;
     case '11':
        $mon = 'Novembre';
        break;
     case '12':
        $mon = 'Décembre';
        break;
  }
  if (strcmp($date[8],'0') == 0) {
     $day = $date[9];
  } else {
    $day = $date[8].$date[9];
  }
  
  $c_d = $day.' '.$mon.' '.$date[0].$date[1].$date[2].$date[3];
  $aff->text($c_d, 828, 715, function($font) {   
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
//inserer l'heure de l'événement
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $minute = $heure[3].$heure[4];
    if(strcmp($minute,'00') == 0)
    $time = $heure[0].$heure[1].'h'; 
    else
    $time = $heure[0].$heure[1].'h'.$minute;
 $aff->text($time, 1911.1, 715, function($font) {  
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
 //inserer le lieu de l'évènement
 $locale = $generate->locale;
 if(strlen($locale) <= 14){
   $aff->text($locale, 3029.1, 715, function($font) {   
      $font->file(public_path('fonts/bookman-old-style.ttf'));
    $font->size("120");
    $font->color('#494949');
    $font->align('center');
    $font->valign('top');
   }); 
  }
  else {
      $lines = explode("\n", wordwrap($locale, 14));
      $h = 677.9;
      foreach ($lines as $line) {
         $aff->text($line, 3029.1, $h, function($font) {   
            $font->file(public_path('fonts/bookman-old-style.ttf'));
          $font->size("80");
          $font->color('#494949');
          $font->align('center');
          $font->valign('top');
       });
       $h = $h + 130;
   }
  }
     //inserer la description
     $des = $event->description;
     $lines = explode("\n", wordwrap($des, 70));
     $h = 987;
     foreach ($lines as $line) {
      $aff->text($line , 44,$h, function($font){
         $font->file(public_path('fonts/Description.ttf'));
         $font->size("100");
         $font->color('#000000');
         $font->align('left');
         $font->valign('top');
      });
      $h = $h + 130;
  }
   
  //inserer le nom de l'animateur1
if(strlen($fullname[0]) <= 18){
   $aff->text($fullname[0], 991.09, 3279, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
    $font->size("90");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
    });
   }
   else {
      $lines = explode("\n", wordwrap($fullname[0], 18));
      $h = 3179;
      foreach ($lines as $line) {
         $aff->text($line, 991.09, $h, function($font) {   
            $font->file(public_path('fonts/georgia bold.ttf'));
            $font->size("90");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
   }
    //inserer le nom de l'animateur2
   
    if(strlen($fullname[1]) <= 18){
      $aff->text($fullname[1], 2459.09, 3279, function($font) {   
         $font->file(public_path('fonts/georgia bold.ttf'));
       $font->size("90");
       $font->color('#080200');
       $font->align('center');
       $font->valign('top');
       });
      }
      else {
         $lines = explode("\n", wordwrap($fullname[1], 18));
         $h = 3179;
         foreach ($lines as $line) {
            $aff->text($line, 2459.09, $h, function($font) {   
               $font->file(public_path('fonts/georgia bold.ttf'));
               $font->size("90");
               $font->color('#080200');
               $font->align('center');
               $font->valign('top');
              });
          $h = $h + 100;
      }
      }
    //inserer la profession de l'animateur1
    if(strlen($profession[0]) <= 30){
    $aff->text($profession[0], 991.09, 3442, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
    $font->size("90");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
    });
   }
   else {
      $lines = explode("\n", wordwrap($profession[0], 30));
      $h = 3442;
      foreach ($lines as $line) {
         $aff->text($line, 991.09, $h, function($font) {   
            $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
            $font->size("90");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
   }
    //inserer la profession de l'animateur2
    
    if(strlen($profession[1]) <= 30){
      $aff->text($profession[1], 2459.09, 3442, function($font) {   
        $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("90");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
     }
     else {
        $lines = explode("\n", wordwrap($profession[1], 30));
        $h = 3442;
        foreach ($lines as $line) {
           $aff->text($line, 2459.09, $h, function($font) {   
              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
              $font->size("90");
              $font->color('#080200');
              $font->align('center');
              $font->valign('top');
             });
         $h = $h + 100;
     }
     }
//comité
$org = Remplissage::where('id_evenement', $id)->count();
$o = Remplissage::where('id_evenement', $id)->get();
foreach ($o as $value) {
   $name[] = '- '.$value->nom.' '.$value->prenom;
}
   switch ($org) {
      case '1':
       $aff->text($name[0], 1192.2, 4060.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("120");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
     });
         break;
      case '2':
         //organisateur 1
         $aff->text($name[0], 1192.2, 4025.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         //organisateur 2
         $aff->text($name[1], 1192.2, 4162.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         break;
       case '3':
          //organisateur 1
       $aff->text($name[0], 1184.7, 3945.6, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 2
       $aff->text($name[1], 1184.7, 4101.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 3
       $aff->text($name[2], 1184.7, 4259.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
          break;
         case '4':
         //organisateur 1
      $aff->text($name[0], 1184.7, 3945, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 2
      $aff->text($name[1], 1184.7, 4067, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 3
      $aff->text($name[2], 1184.7, 4180, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 4
      $aff->text($name[3], 1184.7, 4293, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
         break;
       case '5':
          //organisateur 1
          $aff->text($name[0], 568, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 2
          $aff->text($name[1], 568, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 3
          $aff->text($name[2], 1803.7, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 4
          $aff->text($name[3], 1803.7, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 5
          $aff->text($name[4], 1184.7, 4259.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
             break;
         case '6':
         //organisateur 1
         $aff->text($name[0], 1184.6, 3898, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 2
         $aff->text($name[1], 1184.6, 3975, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 3
         $aff->text($name[2], 1184.6, 4053, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 4
         $aff->text($name[3], 1184.6, 4131, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 5
         $aff->text($name[4], 1184.6, 4211, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 6
         $aff->text($name[5], 1184.6, 4289, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
            break;
   }
     //participant financier
      $nb_pf = Participant_financier::where('id_evenement', $id)->count();
         $pfs = Participant_financier::where('id_evenement', $id)->get();
         foreach ($pfs as $pf) {
           $mf[] = "storage/Organisme/".$pf->logo;
         } 
         switch ($nb_pf) {
            case '1':
               $resize = Image::make($mf[0])->resize(1081,466);
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',678 ,4448);
               break;
            case '2':
               for ($i=0; $i < 2; $i++) { 
                  $resize = Image::make($mf[$i])->resize(1081,466);
                  $resize->save($mf[$i]);
               }
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',27,4448);
               //inserer l'image du sponsor 2
               $aff->insert($mf[1],'top_left',1215,4448);
               break;
               case '3':
                  for ($i=0; $i < 3; $i++) { 
                     $resize = Image::make($mf[$i])->resize(732,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',27,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',796 ,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1564 ,4448);
                  break;
               case '4':
                  for ($i=0; $i < 4; $i++) { 
                     $resize = Image::make($mf[$i])->resize(550,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',0,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',591,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1181,4448);
                  //inserer l'image du sponsor 4
                  $aff->insert($mf[3],'top_left', 1771,4448);
                  break;
         }
      //enregistrer l'affiche
      $name = "storage/AF/".time().'.'."png";
      $aff->save($name);
      //sauvegarder les infos de l'affiche
        if(!$event->modified)
        {
         $affiche = new Affiche;
         $affiche->nom = $name;
         $affiche->id_evenement = $id;
         $affiche->save();
          return redirect('home')->with('success', 'Evenement créé et affiche généré');
        }
        else
        {
           $affiche = Affiche::where('id_evenement', $id)->first();
           $affiche->nom = $name;
           $affiche->save();
           $eventt = Evenement::find($id);      
           $eventt->modified = false; 
           $eventt->save();
           return redirect('home')->with('success', 'Evenement modifié et affiche généré'); 
        }
     
  
  
    }
    
    public  function show3($id){
        $animateur = Animateur::where('id_evenement', $id)->get();
        $generate = Generation::where('id_evenement', $id)->first();
        $event= Evenement::find($id);
        
        
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
        $resize = Image::make($make[$i])->resize(1040,1040);
        $resize->save($make[$i]);
    }
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur 1
        $ap->insert($make[0],'top_left', 54,2201);
         //inserer l'image de l'animateur 2 
      $ap->insert($make[1],'top_left', 1229,2201);
         //inserer l'image de l'animateur 3
         $ap->insert($make[2],'top_left', 2404,2201);
        //  enregistrer l'arriére plan
         $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff3A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 1754, 280, function($font) {   
         $font->file(public_path('fonts/BookA.ttf'));
         $font->size("200");
       $font->color('#000000');
       $font->align('center');
       $font->valign('top'); 
       });
       //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 828, 715, function($font) {   
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 1911.1, 715, function($font) {  
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 14){
      $aff->text($locale, 3029.1, 715, function($font) {   
         $font->file(public_path('fonts/bookman-old-style.ttf'));
       $font->size("120");
       $font->color('#494949');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 14));
         $h = 677.9;
         foreach ($lines as $line) {
            $aff->text($line, 3029.1, $h, function($font) {   
               $font->file(public_path('fonts/bookman-old-style.ttf'));
             $font->size("80");
             $font->color('#494949');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 130;
      }
     }
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 70));
        $h = 987;
        foreach ($lines as $line) {
         $aff->text($line , 44,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("100");
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 130;
     }
    //inserer le nom de l'animateur 1
    if(strlen($fullname[0]) <= 18){
    $aff->text($fullname[0], 578.4, 3315.5, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("80");
      $font->color('#000000');
      $font->align('center');
      $font->valign('top');
   });
   }
   else {
      $lines = explode("\n", wordwrap($fullname[0], 18));
      $h = 3239.3;
      foreach ($lines as $line) {
         $aff->text($line, 578.4, $h, function($font) {   
            $font->file(public_path('fonts/georgia bold.ttf'));
            $font->size("80");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
       $h = $h + 100;
   }
  }
   //inserer le nom de l'animateur 2
   
   if(strlen($fullname[1]) <= 18){
      $aff->text($fullname[1], 1754, 3315.5, function($font) {   
        $font->file(public_path('fonts/georgia bold.ttf'));
        $font->size("80");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
     });
     }
     else {
        $lines = explode("\n", wordwrap($fullname[1], 18));
        $h = 3239.3;
        foreach ($lines as $line) {
           $aff->text($line, 1754, $h, function($font) {   
              $font->file(public_path('fonts/georgia bold.ttf'));
              $font->size("80");
              $font->color('#000000');
              $font->align('center');
              $font->valign('top');
           });
         $h = $h + 100;
     }
    }
//inserer le nom de l'animateur 3

if(strlen($fullname[2]) <= 18){
   $aff->text($fullname[2], 2933.4, 3315.5, function($font) {   
     $font->file(public_path('fonts/georgia bold.ttf'));
     $font->size("80");
     $font->color('#000000');
     $font->align('center');
     $font->valign('top');
  });
  }
  else {
     $lines = explode("\n", wordwrap($fullname[2], 18));
     $h = 3239.3;
     foreach ($lines as $line) {
        $aff->text($line, 2933.4, $h, function($font) {   
           $font->file(public_path('fonts/georgia bold.ttf'));
           $font->size("80");
           $font->color('#000000');
           $font->align('center');
           $font->valign('top');
        });
      $h = $h + 100;
  }
 }
//inserer la profession de l'animateur 1
if(strlen($profession[0]) <= 30){
$aff->text($profession[0], 578.4,3495, function($font) {   
   $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("80");
  $font->color('#000000');
  $font->align('center');
  $font->valign('top');
});
}
else {
   $lines = explode("\n", wordwrap($profession[0], 30));
   $h = 3495;
   foreach ($lines as $line) {
      $aff->text($line, 578.4, $h, function($font) {   
         $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
         $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
        });
    $h = $h + 100;
}
}
   //inserer la profession de l'animateur 2
   
  if(strlen($profession[1]) <= 30){
   $aff->text($profession[1], 1754,3495, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("80");
     $font->color('#000000');
     $font->align('center');
     $font->valign('top');
   });
   }
   else {
      $lines = explode("\n", wordwrap($profession[1], 30));
      $h = 3495;
      foreach ($lines as $line) {
         $aff->text($line, 1754, $h, function($font) {   
            $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
            $font->size("80");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
   }
     //inserer la Profession de l'animateur 3

 if(strlen($profession[2]) <= 30){
   $aff->text($profession[2], 2933.3,3495, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("80");
     $font->color('#000000');
     $font->align('center');
     $font->valign('top');
   });
   }
   else {
      $lines = explode("\n", wordwrap($profession[2], 30));
      $h = 3495;
      foreach ($lines as $line) {
         $aff->text($line, 2933.3, $h, function($font) {   
            $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
            $font->size("80");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
   }
 //comité
$org = Remplissage::where('id_evenement', $id)->count();
$o = Remplissage::where('id_evenement', $id)->get();
foreach ($o as $value) {
   $name[] = '- '.$value->nom.' '.$value->prenom;
}
   switch ($org) {
      case '1':
       $aff->text($name[0], 1192.2, 4060.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("120");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
     });
         break;
      case '2':
         //organisateur 1
         $aff->text($name[0], 1192.2, 4025.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         //organisateur 2
         $aff->text($name[1], 1192.2, 4162.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         break;
       case '3':
          //organisateur 1
       $aff->text($name[0], 1184.7, 3945.6, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 2
       $aff->text($name[1], 1184.7, 4101.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 3
       $aff->text($name[2], 1184.7, 4259.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
          break;
         case '4':
         //organisateur 1
      $aff->text($name[0], 1184.7, 3945, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 2
      $aff->text($name[1], 1184.7, 4067, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 3
      $aff->text($name[2], 1184.7, 4180, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 4
      $aff->text($name[3], 1184.7, 4293, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
         break;
       case '5':
          //organisateur 1
          $aff->text($name[0], 568, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 2
          $aff->text($name[1], 568, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 3
          $aff->text($name[2], 1803.7, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 4
          $aff->text($name[3], 1803.7, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 5
          $aff->text($name[4], 1184.7, 4259.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
             break;
         case '6':
         //organisateur 1
         $aff->text($name[0], 1184.6, 3898, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 2
         $aff->text($name[1], 1184.6, 3975, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 3
         $aff->text($name[2], 1184.6, 4053, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 4
         $aff->text($name[3], 1184.6, 4131, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 5
         $aff->text($name[4], 1184.6, 4211, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 6
         $aff->text($name[5], 1184.6, 4289, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
            break;
   }
     //participant financier
      $nb_pf = Participant_financier::where('id_evenement', $id)->count();
         $pfs = Participant_financier::where('id_evenement', $id)->get();
         foreach ($pfs as $pf) {
           $mf[] = "storage/Organisme/".$pf->logo;
         } 
         switch ($nb_pf) {
            case '1':
               $resize = Image::make($mf[0])->resize(1081,466);
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',678 ,4448);
               break;
            case '2':
               for ($i=0; $i < 2; $i++) { 
                  $resize = Image::make($mf[$i])->resize(1081,466);
                  $resize->save($mf[$i]);
               }
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',27,4448);
               //inserer l'image du sponsor 2
               $aff->insert($mf[1],'top_left',1215,4448);
               break;
               case '3':
                  for ($i=0; $i < 3; $i++) { 
                     $resize = Image::make($mf[$i])->resize(732,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',27,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',796 ,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1564 ,4448);
                  break;
               case '4':
                  for ($i=0; $i < 4; $i++) { 
                     $resize = Image::make($mf[$i])->resize(550,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',0,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',591,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1181,4448);
                  //inserer l'image du sponsor 4
                  $aff->insert($mf[3],'top_left', 1771,4448);
                  break;
         }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        if(!$event->modified)
        {
         $affiche = new Affiche;
         $affiche->nom = $name;
         $affiche->id_evenement = $id;
         $affiche->save();
 
          return redirect('home')->with('success', 'Evenement créé et affiche généré');
        }
        else
        {
           $affiche = Affiche::where('id_evenement', $id)->first();
           $affiche->nom = $name;
           $affiche->save(); $eventt = Evenement::find($id);      
           $eventt->modified = false; 
           $eventt->save();

           return redirect('home')->with('success', 'Evenement modifié et affiche généré'); 
        }
    }
    public function show4($id)
    {
      $animateur = Animateur::where('id_evenement', $id)->get();
      $generate = Generation::where('id_evenement', $id)->first();
      $event= Evenement::find($id);
        
      
      foreach($animateur as $p){
          $img_name_ext[] = $p->animateur_image;
          $fullname[] = $p->nom.' '.$p->prenom;
           $profession[] = $p->profession;
      }
      for ($i=0;$i<4;$i++)
      {
     
      $img_name[] = strstr($img_name_ext[$i],'.',true);
      $make[$i] = "storage/PDP/".$img_name_ext[$i];
      $aff3A = "storage/AF/004.png";
      //resize the animateur profil dynamicaly
      $resize = Image::make($make[$i])->resize(464,464);
      $resize->save($make[$i]);
   }
      //mettre l'arriere plan
      $ap = Image::make("storage/AF/AP.png");
      //inserer l'image de l'animateur 1
      $ap->insert($make[0],'top_left', 110,2329);
       //inserer l'image de l'animateur 2 
      $ap->insert($make[1],'top_left', 1800,2329);
       //inserer l'image de l'animateur 3
       $ap->insert($make[2],'top_left', 110,3065);
        //inserer l'image de l'animateur 4
       $ap->insert($make[3],'top_left', 1800,3065);
      //  enregistrer l'arriére plan
       $ap->save("storage/AF/AP1.png");
      //inserer l'affiche
      $aff = Image::make("storage/AF/AP1.png");
      $aff->insert($aff3A);
    
     //inserer le titre
     $titre = $generate->titre;
     $aff->text($titre, 1754, 280, function($font) {   
      $font->file(public_path('fonts/BookA.ttf'));
      $font->size("200");
    $font->color('#000000');
    $font->align('center');
    $font->valign('top'); 
    });
    //inserer la date de l'événement
$date = $generate->date;
  $m = $date[5].$date[6];
  switch($m)
  {
     case '01':
        $mon = 'Janvier';
        break;
     case '02':
        $mon = 'Février';
        break;
     case '03':
        $mon = 'Mars';
        break;
     case '04':
        $mon = 'Avril';
        break;
     case '05':
        $mon = 'Mai';
        break;
     case '06':
        $mon = 'Juin';
        break;
     case '07':
        $mon = 'Juillet';
        break;
     case '08':
        $mon = 'Août';
        break;
     case '09':
        $mon = 'Septembre';
        break;
     case '10':
        $mon = 'Octobre';
        break;
     case '11':
        $mon = 'Novembre';
        break;
     case '12':
        $mon = 'Décembre';
        break;
  }
  if (strcmp($date[8],'0') == 0) {
     $day = $date[9];
  } else {
    $day = $date[8].$date[9];
  }
  
  $c_d = $day.' '.$mon.' '.$date[0].$date[1].$date[2].$date[3];
  $aff->text($c_d, 828, 715, function($font) {   
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
//inserer l'heure de l'événement
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $minute = $heure[3].$heure[4];
    if(strcmp($minute,'00') == 0)
    $time = $heure[0].$heure[1].'h'; 
    else
    $time = $heure[0].$heure[1].'h'.$minute;
 $aff->text($time, 1911.1, 715, function($font) {  
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
 //inserer le lieu de l'évènement
 $locale = $generate->locale;
 if(strlen($locale) <= 14){
   $aff->text($locale, 3029.1, 715, function($font) {   
      $font->file(public_path('fonts/bookman-old-style.ttf'));
    $font->size("120");
    $font->color('#494949');
    $font->align('center');
    $font->valign('top');
   }); 
  }
  else {
      $lines = explode("\n", wordwrap($locale, 14));
      $h = 677.9;
      foreach ($lines as $line) {
         $aff->text($line, 3029.1, $h, function($font) {   
            $font->file(public_path('fonts/bookman-old-style.ttf'));
          $font->size("80");
          $font->color('#494949');
          $font->align('center');
          $font->valign('top');
       });
       $h = $h + 130;
   }
  }
     //inserer la description
     $des = $event->description;
     $lines = explode("\n", wordwrap($des, 70));
     $h = 987;
     foreach ($lines as $line) {
      $aff->text($line , 44,$h, function($font){
         $font->file(public_path('fonts/Description.ttf'));
         $font->size("100");
         $font->color('#000000');
         $font->align('left');
         $font->valign('top');
      });
      $h = $h + 130;
  }
   
   
  //inserer le nom de l'animateur 1
  if(strlen($fullname[0]) <= 18){
   $aff->text($fullname[0], 1154.09, 2438.67, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("100");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
     });
   }
   else {
      $lines = explode("\n", wordwrap($fullname[0], 18));
      $h = 2387;
      foreach ($lines as $line) {
         $aff->text($line, 1154.09, $h, function($font) {   
            $font->file(public_path('fonts/georgia bold.ttf'));
            $font->size("85");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
  }
     //inserer le nom de l'animateur 2
     if(strlen($fullname[1]) <= 18){
     $aff->text($fullname[1], 2786.09, 2438.67, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("100");
     $font->color('#080200');
     $font->align('center');
     $font->valign('top');
     });
   }
   else {
      $lines = explode("\n", wordwrap($fullname[1], 18));
      $h = 2387;
      foreach ($lines as $line) {
         $aff->text($line, 2786.09, $h, function($font) {   
            $font->file(public_path('fonts/georgia bold.ttf'));
            $font->size("85");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
  }
     //inserer le nom de l'animateur 3
     
     if(strlen($fullname[2]) <= 18){
      $aff->text($fullname[2], 1154.09, 3200.67, function($font) {   
       $font->file(public_path('fonts/georgia bold.ttf'));
       $font->size("100");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
    }
    else {
       $lines = explode("\n", wordwrap($fullname[2], 18));
       $h = 3121;
       foreach ($lines as $line) {
          $aff->text($line, 1154.09, $h, function($font) {   
             $font->file(public_path('fonts/georgia bold.ttf'));
             $font->size("85");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 100;
    }
   }
     //inserer le nom de l'animateur 4
   
     if(strlen($fullname[3]) <= 18){
      $aff->text($fullname[3], 2786.09, 3200.67, function($font) {   
       $font->file(public_path('fonts/georgia bold.ttf'));
       $font->size("100");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
    }
    else {
       $lines = explode("\n", wordwrap($fullname[3], 18));
       $h = 3121;
       foreach ($lines as $line) {
          $aff->text($line, 2786.09, $h, function($font) {   
             $font->file(public_path('fonts/georgia bold.ttf'));
             $font->size("85");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 100;
    }
   }
     //inserer la profession de l'animateur 1
     if(strlen($profession[0]) <= 30){
     $aff->text($profession[0], 1154.09, 2605.67, function($font) {   
     $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
     $font->size("70");
     $font->color('#080200');
     $font->align('center');
     $font->valign('top');
     });
   }
   else {
      $lines = explode("\n", wordwrap($profession[0], 30));
      $h = 2605.67;
      foreach ($lines as $line) {
         $aff->text($line, 1154.09, $h, function($font) {   
            $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
            $font->size("70");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
  }
     //inserer la profession de l'animateur 2
     
     
     if(strlen($profession[1]) <= 30){
      $aff->text($profession[1], 2786.09, 2605.67, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("70");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
    }
    else {
       $lines = explode("\n", wordwrap($profession[1], 30));
       $h = 2605.67;
       foreach ($lines as $line) {
          $aff->text($line, 2786.09, $h, function($font) {   
             $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
             $font->size("70");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 100;
    }
   }
     //inserer la Profession de l'animateur 3
     
     if(strlen($profession[2]) <= 30){
      $aff->text($profession[2], 1154.09, 3340, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("70");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
    }
    else {
       $lines = explode("\n", wordwrap($profession[2], 30));
       $h = 3340;
       foreach ($lines as $line) {
          $aff->text($line, 1154.09, $h, function($font) {   
             $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
             $font->size("70");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 100;
    }
   }
     //inserer la Profession de l'animateur 4
     
     if(strlen($profession[3]) <= 30){
      $aff->text($profession[3], 2786.09, 3340, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("70");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
    }
    else {
       $lines = explode("\n", wordwrap($profession[3], 30));
       $h = 3340;
       foreach ($lines as $line) {
          $aff->text($line, 2786.09, $h, function($font) {   
             $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
             $font->size("70");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 100;
    }
   }
//comité
$org = Remplissage::where('id_evenement', $id)->count();
$o = Remplissage::where('id_evenement', $id)->get();
foreach ($o as $value) {
   $name[] = '- '.$value->nom.' '.$value->prenom;
}
   switch ($org) {
      case '1':
       $aff->text($name[0], 1192.2, 4060.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("120");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
     });
         break;
      case '2':
         //organisateur 1
         $aff->text($name[0], 1192.2, 4025.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         //organisateur 2
         $aff->text($name[1], 1192.2, 4162.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         break;
       case '3':
          //organisateur 1
       $aff->text($name[0], 1184.7, 3945.6, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 2
       $aff->text($name[1], 1184.7, 4101.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 3
       $aff->text($name[2], 1184.7, 4259.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
          break;
         case '4':
         //organisateur 1
      $aff->text($name[0], 1184.7, 3945, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 2
      $aff->text($name[1], 1184.7, 4067, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 3
      $aff->text($name[2], 1184.7, 4180, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 4
      $aff->text($name[3], 1184.7, 4293, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
         break;
       case '5':
          //organisateur 1
          $aff->text($name[0], 568, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 2
          $aff->text($name[1], 568, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 3
          $aff->text($name[2], 1803.7, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 4
          $aff->text($name[3], 1803.7, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 5
          $aff->text($name[4], 1184.7, 4259.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
             break;
         case '6':
         //organisateur 1
         $aff->text($name[0], 1184.6, 3898, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 2
         $aff->text($name[1], 1184.6, 3975, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 3
         $aff->text($name[2], 1184.6, 4053, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 4
         $aff->text($name[3], 1184.6, 4131, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 5
         $aff->text($name[4], 1184.6, 4211, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 6
         $aff->text($name[5], 1184.6, 4289, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
            break;
   }
     //participant financier
      $nb_pf = Participant_financier::where('id_evenement', $id)->count();
         $pfs = Participant_financier::where('id_evenement', $id)->get();
         foreach ($pfs as $pf) {
           $mf[] = "storage/Organisme/".$pf->logo;
         } 
         switch ($nb_pf) {
            case '1':
               $resize = Image::make($mf[0])->resize(1081,466);
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',678 ,4448);
               break;
            case '2':
               for ($i=0; $i < 2; $i++) { 
                  $resize = Image::make($mf[$i])->resize(1081,466);
                  $resize->save($mf[$i]);
               }
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',27,4448);
               //inserer l'image du sponsor 2
               $aff->insert($mf[1],'top_left',1215,4448);
               break;
               case '3':
                  for ($i=0; $i < 3; $i++) { 
                     $resize = Image::make($mf[$i])->resize(732,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',27,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',796 ,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1564 ,4448);
                  break;
               case '4':
                  for ($i=0; $i < 4; $i++) { 
                     $resize = Image::make($mf[$i])->resize(550,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',0,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',591,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1181,4448);
                  //inserer l'image du sponsor 4
                  $aff->insert($mf[3],'top_left', 1771,4448);
                  break;
         }

      //enregistrer l'affiche
      $name = "storage/AF/".time().'.'."png";
      $aff->save($name);
      //sauvegarder les infos de l'affiche
      if(!$event->modified)
      {
       $affiche = new Affiche;
       $affiche->nom = $name;
       $affiche->id_evenement = $id;
       $affiche->save();

        return redirect('home')->with('success', 'Evenement créé et affiche généré');
      }
      else
      {
         $affiche = Affiche::where('id_evenement', $id)->first();
         $affiche->nom = $name;
         $affiche->save();
         $eventt = Evenement::find($id);      
         $eventt->modified = false; 
         $eventt->save();

         return redirect('home')->with('success', 'Evenement modifié et affiche généré'); 
      }
   
}
    
    public function show5($id)
    {

      $animateur = Animateur::where('id_evenement', $id)->get();
      $generate = Generation::where('id_evenement', $id)->first();
      $event= Evenement::find($id);
        
      
      foreach($animateur as $p){
          $img_name_ext[] = $p->animateur_image;
          $fullname[] = $p->nom.' '.$p->prenom;
           $profession[] = $p->profession;
      }
      for ($i=0;$i<5;$i++)
      {
     
      $img_name[] = strstr($img_name_ext[$i],'.',true);
      $make[$i] = "storage/PDP/".$img_name_ext[$i];
      $aff3A = "storage/AF/005.png";
      //resize the animateur profil dynamicaly
      $resize = Image::make($make[$i])->resize(494,494);
      $resize->save($make[$i]);
  }
      //mettre l'arriere plan
      $ap = Image::make("storage/AF/AP.png");
      //inserer l'image de l'animateur 1
      $ap->insert($make[0],'top_left', 85,2158);
       //inserer l'image de l'animateur 2 
      $ap->insert($make[1],'top_left', 1790,2158);
       //inserer l'image de l'animateur 3
       $ap->insert($make[2],'top_left',85 ,2714);
        //inserer l'image de l'animateur 4
       $ap->insert($make[3],'top_left',1790 ,2714);
       //inserer l'image de l'animateur 5
       $ap->insert($make[4],'top_left', 908,3262);
      //  enregistrer l'arriére plan
       $ap->save("storage/AF/AP1.png");
      //inserer l'affiche
      $aff = Image::make("storage/AF/AP1.png");
      $aff->insert($aff3A);
    
    //inserer le titre
    $titre = $generate->titre;
    $aff->text($titre, 1754, 280, function($font) {   
     $font->file(public_path('fonts/BookA.ttf'));
     $font->size("200");
   $font->color('#000000');
   $font->align('center');
   $font->valign('top'); 
   });
   //inserer la date de l'événement
$date = $generate->date;
  $m = $date[5].$date[6];
  switch($m)
  {
     case '01':
        $mon = 'Janvier';
        break;
     case '02':
        $mon = 'Février';
        break;
     case '03':
        $mon = 'Mars';
        break;
     case '04':
        $mon = 'Avril';
        break;
     case '05':
        $mon = 'Mai';
        break;
     case '06':
        $mon = 'Juin';
        break;
     case '07':
        $mon = 'Juillet';
        break;
     case '08':
        $mon = 'Août';
        break;
     case '09':
        $mon = 'Septembre';
        break;
     case '10':
        $mon = 'Octobre';
        break;
     case '11':
        $mon = 'Novembre';
        break;
     case '12':
        $mon = 'Décembre';
        break;
  }
  if (strcmp($date[8],'0') == 0) {
     $day = $date[9];
  } else {
    $day = $date[8].$date[9];
  }
  
  $c_d = $day.' '.$mon.' '.$date[0].$date[1].$date[2].$date[3];
  $aff->text($c_d, 828, 715, function($font) {   
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
//inserer l'heure de l'événement
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $minute = $heure[3].$heure[4];
    if(strcmp($minute,'00') == 0)
    $time = $heure[0].$heure[1].'h'; 
    else
    $time = $heure[0].$heure[1].'h'.$minute;
 $aff->text($time, 1911.1, 715, function($font) {  
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
//inserer le lieu de l'évènement
$locale = $generate->locale;
if(strlen($locale) <= 14){
  $aff->text($locale, 3029.1, 715, function($font) {   
     $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
   $font->color('#494949');
   $font->align('center');
   $font->valign('top');
  }); 
 }
 else {
     $lines = explode("\n", wordwrap($locale, 14));
     $h = 677.9;
     foreach ($lines as $line) {
        $aff->text($line, 3029.1, $h, function($font) {   
           $font->file(public_path('fonts/bookman-old-style.ttf'));
         $font->size("80");
         $font->color('#494949');
         $font->align('center');
         $font->valign('top');
      });
      $h = $h + 130;
  }
 }
    //inserer la description
    $des = $event->description;
    $lines = explode("\n", wordwrap($des, 70));
    $h = 987;
    foreach ($lines as $line) {
     $aff->text($line , 44,$h, function($font){
        $font->file(public_path('fonts/Description.ttf'));
        $font->size("100");
        $font->color('#000000');
        $font->align('left');
        $font->valign('top');
     });
     $h = $h + 130;
 }
   
  //inserer le nom de l'animateur 1
if(strlen($fullname[0]) <= 18){
   $aff->text($fullname[0], 1115.17, 2262, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
      $font->size("90");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
    });
   }
   else {
      $lines = explode("\n", wordwrap($fullname[0], 18));
      $h = 2180;
      foreach ($lines as $line) {
         $aff->text($line, 1115.17, $h, function($font) {   
            $font->file(public_path('fonts/georgia bold.ttf'));
            $font->size("90");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
   }
    //inserer le nom de l'animateur 2
    if(strlen($fullname[1]) <= 18){
      $aff->text($fullname[1], 2887, 2262, function($font) {   
         $font->file(public_path('fonts/georgia bold.ttf'));
         $font->size("90");
         $font->color('#080200');
         $font->align('center');
         $font->valign('top');
       });
      }
      else {
         $lines = explode("\n", wordwrap($fullname[1], 18));
         $h = 2180;
         foreach ($lines as $line) {
            $aff->text($line, 2887, $h, function($font) {   
               $font->file(public_path('fonts/georgia bold.ttf'));
               $font->size("90");
               $font->color('#080200');
               $font->align('center');
               $font->valign('top');
              });
          $h = $h + 100;
      }
      }
    //inserer le nom de l'animateur 3
    if(strlen($fullname[2]) <= 18){
    $aff->text($fullname[2], 1115.17, 2873, function($font) {   
    $font->file(public_path('fonts/georgia bold.ttf'));
    $font->size("90");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
    });
   }
   else {
      $lines = explode("\n", wordwrap($fullname[2], 18));
      $h = 2783;
      foreach ($lines as $line) {
         $aff->text($line, 1115.17, $h, function($font) {   
            $font->file(public_path('fonts/georgia bold.ttf'));
            $font->size("90");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
   }
    //inserer le nom de l'animateur 4
    
    if(strlen($fullname[3]) <= 18){
      $aff->text($fullname[3], 2887, 2873, function($font) {   
         $font->file(public_path('fonts/georgia bold.ttf'));
         $font->size("90");
         $font->color('#080200');
         $font->align('center');
         $font->valign('top');
       });
      }
      else {
         $lines = explode("\n", wordwrap($fullname[3], 18));
         $h = 2783;
         foreach ($lines as $line) {
            $aff->text($line, 2887, $h, function($font) {   
               $font->file(public_path('fonts/georgia bold.ttf'));
               $font->size("90");
               $font->color('#080200');
               $font->align('center');
               $font->valign('top');
              });
          $h = $h + 100;
      }
      }
        //inserer le nom de l'animateur 5
        if(strlen($fullname[4]) <= 18){
    $aff->text($fullname[4], 2025, 3409, function($font) {   
        $font->file(public_path('fonts/georgia bold.ttf'));
        $font->size("90");
        $font->color('#080200');
        $font->align('center');
        $font->valign('top');
        });
      }
      else {
         $lines = explode("\n", wordwrap($fullname[4], 18));
         $h = 3320;
         foreach ($lines as $line) {
            $aff->text($line, 2025, $h, function($font) {   
               $font->file(public_path('fonts/georgia bold.ttf'));
               $font->size("90");
               $font->color('#080200');
               $font->align('center');
               $font->valign('top');
              });
          $h = $h + 100;
      }
      }
    //inserer la profession de l'animateur 1
    if(strlen($profession[0]) <= 38){
    $aff->text($profession[0], 1115.17, 2419, function($font) {   
    $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
    $font->size("70");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
    });
   }
   else {
      $lines = explode("\n", wordwrap($profession[0], 38));
      $h = 2419;
      foreach ($lines as $line) {
         $aff->text($line, 1115.17, $h, function($font) {   
            $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
            $font->size("70");
            $font->color('#080200');
            $font->align('center');
            $font->valign('top');
           });
       $h = $h + 100;
   }
   }
    //inserer la profession de l'animateur 2
    
    if(strlen($profession[1]) <= 38){
      $aff->text($profession[1], 2887, 2419, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("70");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
     }
     else {
        $lines = explode("\n", wordwrap($profession[1], 38));
        $h = 2419;
        foreach ($lines as $line) {
           $aff->text($line, 2887, $h, function($font) {   
              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
              $font->size("70");
              $font->color('#080200');
              $font->align('center');
              $font->valign('top');
             });
         $h = $h + 100;
     }
     }
     //inserer la Profession de l'animateur 3
     if(strlen($profession[2]) <= 38){
      $aff->text($profession[2], 1115.17, 2999, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("70");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
     }
     else {
        $lines = explode("\n", wordwrap($profession[2], 38));
        $h = 2999;
        foreach ($lines as $line) {
           $aff->text($line, 1115.17, $h, function($font) {   
              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
              $font->size("70");
              $font->color('#080200');
              $font->align('center');
              $font->valign('top');
             });
         $h = $h + 100;
     }
     }
    //inserer la Profession de l'animateur 4
    if(strlen($profession[3]) <= 38){
      $aff->text($profession[3], 2887, 2999, function($font) {   
      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
      $font->size("70");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
      });
     }
     else {
        $lines = explode("\n", wordwrap($profession[3], 38));
        $h = 2999;
        foreach ($lines as $line) {
           $aff->text($line, 2887, $h, function($font) {   
              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
              $font->size("70");
              $font->color('#080200');
              $font->align('center');
              $font->valign('top');
             });
         $h = $h + 100;
     }
     }
        //inserer la Profession de l'animateur 5
        $lines = explode("\n", wordwrap($profession[4], 38));
           $h = 3537;
           foreach ($lines as $line) {
              $aff->text($line, 2025, $h, function($font) {   
                 $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
                 $font->size("70");
                 $font->color('#080200');
                 $font->align('center');
                 $font->valign('top');
                });
            $h = $h + 100;
        }
//comité
$org = Remplissage::where('id_evenement', $id)->count();
$o = Remplissage::where('id_evenement', $id)->get();
foreach ($o as $value) {
   $name[] = '- '.$value->nom.' '.$value->prenom;
}
   switch ($org) {
      case '1':
       $aff->text($name[0], 1192.2, 4060.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("120");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
     });
         break;
      case '2':
         //organisateur 1
         $aff->text($name[0], 1192.2, 4025.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         //organisateur 2
         $aff->text($name[1], 1192.2, 4162.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         break;
       case '3':
          //organisateur 1
       $aff->text($name[0], 1184.7, 3945.6, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 2
       $aff->text($name[1], 1184.7, 4101.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 3
       $aff->text($name[2], 1184.7, 4259.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
          break;
         case '4':
         //organisateur 1
      $aff->text($name[0], 1184.7, 3945, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 2
      $aff->text($name[1], 1184.7, 4067, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 3
      $aff->text($name[2], 1184.7, 4180, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 4
      $aff->text($name[3], 1184.7, 4293, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
         break;
       case '5':
          //organisateur 1
          $aff->text($name[0], 568, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 2
          $aff->text($name[1], 568, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 3
          $aff->text($name[2], 1803.7, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 4
          $aff->text($name[3], 1803.7, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 5
          $aff->text($name[4], 1184.7, 4259.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
             break;
         case '6':
         //organisateur 1
         $aff->text($name[0], 1184.6, 3898, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 2
         $aff->text($name[1], 1184.6, 3975, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 3
         $aff->text($name[2], 1184.6, 4053, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 4
         $aff->text($name[3], 1184.6, 4131, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 5
         $aff->text($name[4], 1184.6, 4211, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 6
         $aff->text($name[5], 1184.6, 4289, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
            break;
   }
     //participant financier
      $nb_pf = Participant_financier::where('id_evenement', $id)->count();
         $pfs = Participant_financier::where('id_evenement', $id)->get();
         foreach ($pfs as $pf) {
           $mf[] = "storage/Organisme/".$pf->logo;
         } 
         switch ($nb_pf) {
            case '1':
               $resize = Image::make($mf[0])->resize(1081,466);
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',678 ,4448);
               break;
            case '2':
               for ($i=0; $i < 2; $i++) { 
                  $resize = Image::make($mf[$i])->resize(1081,466);
                  $resize->save($mf[$i]);
               }
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',27,4448);
               //inserer l'image du sponsor 2
               $aff->insert($mf[1],'top_left',1215,4448);
               break;
               case '3':
                  for ($i=0; $i < 3; $i++) { 
                     $resize = Image::make($mf[$i])->resize(732,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',27,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',796 ,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1564 ,4448);
                  break;
               case '4':
                  for ($i=0; $i < 4; $i++) { 
                     $resize = Image::make($mf[$i])->resize(550,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',0,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',591,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1181,4448);
                  //inserer l'image du sponsor 4
                  $aff->insert($mf[3],'top_left', 1771,4448);
                  break;
         }
      //enregistrer l'affiche
      $name = "storage/AF/".time().'.'."png";
      $aff->save($name);
      //sauvegarder les infos de l'affiche
        if(!$event->modified)
        {
         $affiche = new Affiche;
         $affiche->nom = $name;
         $affiche->id_evenement = $id;
         $affiche->save();
 
          return redirect('home')->with('success', 'Evenement créé et affiche généré');
        }
        else
        {
           $affiche = Affiche::where('id_evenement', $id)->first();
           $affiche->nom = $name;
           $affiche->save();
           $eventt = Evenement::find($id);      
           $eventt->modified = false; 
           $eventt->save();

           return redirect('home')->with('success', 'Evenement modifié et affiche généré'); 
        }


    }
    public function show6($id)
    {
      $animateur = Animateur::where('id_evenement', $id)->get();
      $generate = Generation::where('id_evenement', $id)->first();
        $event= Evenement::find($id);
        
        
        foreach($animateur as $p){
            $img_name_ext[] = $p->animateur_image;
            $fullname[] = $p->nom.' '.$p->prenom;
             $profession[] = $p->profession;
        }
        for ($i=0;$i<6;$i++)
        {
       
        $img_name[] = strstr($img_name_ext[$i],'.',true);
        $make[$i] = "storage/PDP/".$img_name_ext[$i];
        $aff3A = "storage/AF/006.png";
        //resize the animateur profil dynamicaly
        $resize = Image::make($make[$i])->resize(508,508);
        $resize->save($make[$i]);
    }
        //mettre l'arriere plan
        $ap = Image::make("storage/AF/AP.png");
        //inserer l'image de l'animateur 1
        $ap->insert($make[0],'top_left', 57,2156);
         //inserer l'image de l'animateur 2 
        $ap->insert($make[1],'top_left', 57,2675);
         //inserer l'image de l'animateur 3
         $ap->insert($make[2],'top_left', 57,3194);
         //inserer l'image de l'animateur 4
        $ap->insert($make[3],'top_left',1754,2156);
        //inserer l'image de l'animateur 5 
       $ap->insert($make[4],'top_left', 1754,2675);
        //inserer l'image de l'animateur 6
        $ap->insert($make[5],'top_left', 1754,3194);
        //  enregistrer l'arriére plan
         $ap->save("storage/AF/AP1.png");
        //inserer l'affiche
        $aff = Image::make("storage/AF/AP1.png");
        $aff->insert($aff3A);
        //inserer le titre
        $titre = $generate->titre;
        $aff->text($titre, 1754, 280, function($font) {   
         $font->file(public_path('fonts/BookA.ttf'));
         $font->size("200");
       $font->color('#000000');
       $font->align('center');
       $font->valign('top'); 
       });
       //inserer la date de l'événement
  $date = $generate->date;
  $aff->text($date, 828, 715, function($font) {   
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
 //inserer l'heure de l'événement
 $heure = $generate->heure;
 $aff->text($heure, 1911.1, 715, function($font) {  
   $font->file(public_path('fonts/bookman-old-style.ttf'));
   $font->size("120");
 $font->color('#494949');
 $font->align('center');
 $font->valign('top');
});
    //inserer le lieu de l'évènement
    $locale = $generate->locale;
    if(strlen($locale) <= 14){
      $aff->text($locale, 3029.1, 715, function($font) {   
         $font->file(public_path('fonts/bookman-old-style.ttf'));
       $font->size("120");
       $font->color('#494949');
       $font->align('center');
       $font->valign('top');
      }); 
     }
     else {
         $lines = explode("\n", wordwrap($locale, 14));
         $h = 677.9;
         foreach ($lines as $line) {
            $aff->text($locale, 3029.1, 715, function($font) {   
               $font->file(public_path('fonts/bookman-old-style.ttf'));
             $font->size("80");
             $font->color('#494949');
             $font->align('center');
             $font->valign('top');
          });
          $h = $h + 130;
      }
     }
        //inserer la description
        $des = $event->description;
        $lines = explode("\n", wordwrap($des, 70));
        $h = 987;
        foreach ($lines as $line) {
         $aff->text($line , 44,$h, function($font){
            $font->file(public_path('fonts/Description.ttf'));
            $font->size("100");
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
         });
         $h = $h + 130;
     }
    //inserer le nom de l'animateur 1
 if(strlen($fullname[0]) <= 18){
   $aff->text($fullname[0],  1157.1,2281, function($font) {   
     $font->file(public_path('fonts/georgia bold.ttf'));
     $font->size("80");
     $font->color('#000000');
     $font->align('center');
     $font->valign('top');
  });
   }
   else {
     $lines = explode("\n", wordwrap($fullname[0], 18));
     $h = 2201;
     foreach ($lines as $line) {
        $aff->text($line, 1157.1, $h, function($font) {   
           $font->file(public_path('fonts/georgia bold.ttf'));
           $font->size("77");
           $font->color('#080200');
           $font->align('center');
           $font->valign('top');
          });
      $h = $h + 87;
  }
  }
  
  //inserer le nom de l'animateur 2
  if(strlen($fullname[1]) <= 18){
     $aff->text($fullname[1],  1157.1,2831, function($font) {   
       $font->file(public_path('fonts/georgia bold.ttf'));
       $font->size("80");
       $font->color('#000000');
       $font->align('center');
       $font->valign('top');
    });
     }
     else {
       $lines = explode("\n", wordwrap($fullname[1], 18));
       $h = 2751;
       foreach ($lines as $line) {
          $aff->text($line, 1157.1, $h, function($font) {   
             $font->file(public_path('fonts/georgia bold.ttf'));
             $font->size("77");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 87;
    }
    }
  //inserer le nom de l'animateur 3
   
  if(strlen($fullname[2]) <= 18){
     $aff->text($fullname[2],  1157.1,3353, function($font) {   
       $font->file(public_path('fonts/georgia bold.ttf'));
       $font->size("80");
       $font->color('#000000');
       $font->align('center');
       $font->valign('top');
    });
     }
     else {
       $lines = explode("\n", wordwrap($fullname[2], 18));
       $h = 3273;
       foreach ($lines as $line) {
          $aff->text($line, 1157.1, $h, function($font) {   
             $font->file(public_path('fonts/georgia bold.ttf'));
             $font->size("77");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 87;
    }
    }
  //inserer le nom de l'animateur 4
  if(strlen($fullname[3]) <= 18){
     $aff->text($fullname[3],  2885.1,2281, function($font) {   
       $font->file(public_path('fonts/georgia bold.ttf'));
       $font->size("80");
       $font->color('#000000');
       $font->align('center');
       $font->valign('top');
    });
     }
     else {
       $lines = explode("\n", wordwrap($fullname[3], 18));
       $h = 2201;
       foreach ($lines as $line) {
          $aff->text($line, 2885.1, $h, function($font) {   
             $font->file(public_path('fonts/georgia bold.ttf'));
             $font->size("77");
             $font->color('#080200');
             $font->align('center');
             $font->valign('top');
            });
        $h = $h + 87;
    }
    }
    
    //inserer le nom de l'animateur 5
    if(strlen($fullname[4]) <= 18){
       $aff->text($fullname[4],  2885.1,2831, function($font) {   
         $font->file(public_path('fonts/georgia bold.ttf'));
         $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
       }
       else {
         $lines = explode("\n", wordwrap($fullname[4], 18));
         $h = 2751;
         foreach ($lines as $line) {
            $aff->text($line, 2885.1, $h, function($font) {   
               $font->file(public_path('fonts/georgia bold.ttf'));
               $font->size("77");
               $font->color('#080200');
               $font->align('center');
               $font->valign('top');
              });
          $h = $h + 87;
      }
      }
    //inserer le nom de l'animateur 6
     
    if(strlen($fullname[5]) <= 18){
       $aff->text($fullname[5],  2885.1,3353, function($font) {   
         $font->file(public_path('fonts/georgia bold.ttf'));
         $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
       }
       else {
         $lines = explode("\n", wordwrap($fullname[5], 18));
         $h = 3273;
         foreach ($lines as $line) {
            $aff->text($line, 2885.1, $h, function($font) {   
               $font->file(public_path('fonts/georgia bold.ttf'));
               $font->size("77");
               $font->color('#080200');
               $font->align('center');
               $font->valign('top');
              });
          $h = $h + 87;
      }
      }
  //inserer la profession de l'animateur 1
  if(strlen($profession[0]) <= 38){
  $aff->text($profession[0], 1157.1, 2434, function($font) {   
  $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
  $font->size("70");
  $font->color('#000000');
  $font->align('center');
  $font->valign('top');
  });
  }
  else {
     $lines = explode("\n", wordwrap($profession[0], 38));
     $h = 2434;
     foreach ($lines as $line) {
        $aff->text($line, 1157.1, $h, function($font) {   
           $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
           $font->size("70");
           $font->color('#000000');
           $font->align('center');
           $font->valign('top');
          });
      $h = $h + 87;
  }
  }
  //inserer la profession de l'animateur 2
  
  if(strlen($profession[1]) <= 38){
     $aff->text($profession[1], 1157.1, 2986, function($font) {   
     $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
     $font->size("70");
     $font->color('#000000');
     $font->align('center');
     $font->valign('top');
     });
     }
     else {
        $lines = explode("\n", wordwrap($profession[1], 38));
        $h = 2986;
        foreach ($lines as $line) {
           $aff->text($line, 1157.1, $h, function($font) {   
              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
              $font->size("70");
              $font->color('#000000');
              $font->align('center');
              $font->valign('top');
             });
         $h = $h + 87;
     }
     }
    //inserer la Profession de l'animateur 3
    if(strlen($profession[2]) <= 38){
     $aff->text($profession[2], 1157.1, 3508, function($font) {   
     $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
     $font->size("70");
     $font->color('#000000');
     $font->align('center');
     $font->valign('top');
     });
     }
     else {
        $lines = explode("\n", wordwrap($profession[2], 38));
        $h = 3508;
        foreach ($lines as $line) {
           $aff->text($line, 1157.1, $h, function($font) {   
              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
              $font->size("70");
              $font->color('#000000');
              $font->align('center');
              $font->valign('top');
             });
         $h = $h + 87;
     }
     }
  //inserer la profession de l'animateur 4 
  if(strlen($profession[3]) <= 38){
     $aff->text($profession[3], 2885.1, 2434, function($font) {   
     $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
     $font->size("70");
     $font->color('#000000');
     $font->align('center');
     $font->valign('top');
     });
     }
     else {
        $lines = explode("\n", wordwrap($profession[3], 38));
        $h = 2434;
        foreach ($lines as $line) {
           $aff->text($line, 2885.1, $h, function($font) {   
              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
              $font->size("70");
              $font->color('#000000');
              $font->align('center');
              $font->valign('top');
             });
         $h = $h + 87;
     }
     }
     //inserer la profession de l'animateur 5
     
     if(strlen($profession[4]) <= 38){
        $aff->text($profession[4], 2885.1, 2986, function($font) {   
        $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
        $font->size("70");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
        });
        }
        else {
           $lines = explode("\n", wordwrap($profession[4], 38));
           $h = 2986;
           foreach ($lines as $line) {
              $aff->text($line, 2885.1, $h, function($font) {   
                 $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
                 $font->size("70");
                 $font->color('#000000');
                 $font->align('center');
                 $font->valign('top');
                });
            $h = $h + 87;
        }
        }
       //inserer la Profession de l'animateur 6
       if(strlen($profession[5]) <= 38){
        $aff->text($profession[5], 2885.1, 3508, function($font) {   
        $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
        $font->size("70");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
        });
        }
        else {
           $lines = explode("\n", wordwrap($profession[5], 38));
           $h = 3508;
           foreach ($lines as $line) {
              $aff->text($line, 2885.1, $h, function($font) {   
                 $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
                 $font->size("70");
                 $font->color('#000000');
                 $font->align('center');
                 $font->valign('top');
                });
            $h = $h + 87;
        }
        }
 //comité
$org = Remplissage::where('id_evenement', $id)->count();
$o = Remplissage::where('id_evenement', $id)->get();
foreach ($o as $value) {
   $name[] = '- '.$value->nom.' '.$value->prenom;
}
   switch ($org) {
      case '1':
       $aff->text($name[0], 1192.2, 4060.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("120");
        $font->color('#000000');
        $font->align('center');
        $font->valign('top');
     });
         break;
      case '2':
         //organisateur 1
         $aff->text($name[0], 1192.2, 4025.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         //organisateur 2
         $aff->text($name[1], 1192.2, 4162.22, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("120");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
         break;
       case '3':
          //organisateur 1
       $aff->text($name[0], 1184.7, 3945.6, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 2
       $aff->text($name[1], 1184.7, 4101.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
       //organisateur 3
       $aff->text($name[2], 1184.7, 4259.5, function($font) {   
          $font->file(public_path('fonts/georgia.ttf'));
       $font->size("80");
          $font->color('#000000');
          $font->align('center');
          $font->valign('top');
       });
          break;
         case '4':
         //organisateur 1
      $aff->text($name[0], 1184.7, 3945, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 2
      $aff->text($name[1], 1184.7, 4067, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 3
      $aff->text($name[2], 1184.7, 4180, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
      //organisateur 4
      $aff->text($name[3], 1184.7, 4293, function($font) {   
         $font->file(public_path('fonts/georgia.ttf'));
      $font->size("80");
         $font->color('#000000');
         $font->align('center');
         $font->valign('top');
      });
         break;
       case '5':
          //organisateur 1
          $aff->text($name[0], 568, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 2
          $aff->text($name[1], 568, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 3
          $aff->text($name[2], 1803.7, 3945.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 4
          $aff->text($name[3], 1803.7, 4101.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
          //organisateur 5
          $aff->text($name[4], 1184.7, 4259.5, function($font) {   
             $font->file(public_path('fonts/georgia.ttf'));
          $font->size("80");
             $font->color('#000000');
             $font->align('center');
             $font->valign('top');
          });
             break;
         case '6':
         //organisateur 1
         $aff->text($name[0], 1184.6, 3898, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 2
         $aff->text($name[1], 1184.6, 3975, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 3
         $aff->text($name[2], 1184.6, 4053, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 4
         $aff->text($name[3], 1184.6, 4131, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 5
         $aff->text($name[4], 1184.6, 4211, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
         //organisateur 6
         $aff->text($name[5], 1184.6, 4289, function($font) {   
            $font->file(public_path('fonts/georgia.ttf'));
         $font->size("60");
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
         });
            break;
   }
     //participant financier
      $nb_pf = Participant_financier::where('id_evenement', $id)->count();
         $pfs = Participant_financier::where('id_evenement', $id)->get();
         foreach ($pfs as $pf) {
           $mf[] = "storage/Organisme/".$pf->logo;
         } 
         switch ($nb_pf) {
            case '1':
               $resize = Image::make($mf[0])->resize(1081,466);
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',678 ,4448);
               break;
            case '2':
               for ($i=0; $i < 2; $i++) { 
                  $resize = Image::make($mf[$i])->resize(1081,466);
                  $resize->save($mf[$i]);
               }
               //inserer l'image du sponsor 1
               $aff->insert($mf[0],'top_left',27,4448);
               //inserer l'image du sponsor 2
               $aff->insert($mf[1],'top_left',1215,4448);
               break;
               case '3':
                  for ($i=0; $i < 3; $i++) { 
                     $resize = Image::make($mf[$i])->resize(732,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',27,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',796 ,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1564 ,4448);
                  break;
               case '4':
                  for ($i=0; $i < 4; $i++) { 
                     $resize = Image::make($mf[$i])->resize(550,466);
                     $resize->save($mf[$i]);
                  }
                  //inserer l'image du sponsor 1
                  $aff->insert($mf[0],'top_left',0,4448);
                  //inserer l'image du sponsor 2
                  $aff->insert($mf[1],'top_left',591,4448);
                  //inserer l'image du sponsor 3
                  $aff->insert($mf[2],'top_left',1181,4448);
                  //inserer l'image du sponsor 4
                  $aff->insert($mf[3],'top_left', 1771,4448);
                  break;
         }
        //enregistrer l'affiche
        $name = "storage/AF/".time().'.'."png";
        $aff->save($name);
        //sauvegarder les infos de l'affiche
        if(!$event->modified)
        {
         $affiche = new Affiche;
         $affiche->nom = $name;
         $affiche->id_evenement = $id;
         $affiche->save();
 
          return redirect('home')->with('success', 'Evenement créé et affiche généré');
        }
        else
        {
           $affiche = Affiche::where('id_evenement', $id)->first();
           $affiche->nom = $name;
           $affiche->save();
           $eventt = Evenement::find($id);      
           $eventt->modified = false; 
           $eventt->save();

           return redirect('home')->with('success', 'Evenement modifié et affiche généré'); 
        }
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
