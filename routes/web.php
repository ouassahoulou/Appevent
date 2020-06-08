<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('/', 'PageController')->name('index','index');

Route::get('/gp', 'PageController@gp')->name('gestion_p');
Route::get('/gf', 'PageController@gf')->name('gestion_f');
Route::post('/d', 'PageController@dep')->name('dep');
Route::get('/gfp', 'PageController@gf_p')->name('gestion_fp');
Route::get('/p', 'PageController@show')->name('show_p');
Route::get('/detaila/{id}', 'PageController@detail_a')->name('admin_detail');
Route::get('/detailh/{id}', 'PageController@detail_h')->name('home_detail');
Route::get('/profil/{name}', 'PageController@profil')->name('profil_admin');
Route::get('/affiche/{name}', 'PageController@affiche')->name('affiche');
Route::delete('/DeleteAll', 'ParticipantController@deleteAll')->name('part.deleteAll');
Auth::routes(['register' => false]);
Route::get('/part/{id}', 'ParticipantController@destroy')->name('part.destroy');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('event', 'EventController');
Route::resource('profil', 'ProfilController');
Route::resource('animate', 'AnimateurController');
Route::resource('participate', 'ParticipantController');
Route::resource('/', 'PageController');
Route::resource('affiche', 'AfficheController');
Route::get('/affiche1A/{id}', 'AfficheController@show1')->name('affiche.show1');
Route::get('/affiche2A/{id}', 'AfficheController@show2')->name('affiche.show2');
Route::get('/affiche3A/{id}', 'AfficheController@show3')->name('affiche.show3');
Route::get('/affiche4A/{id}', 'AfficheController@show4')->name('affiche.show4');
Route::get('/affiche5A/{id}', 'AfficheController@show5')->name('affiche.show5');
Route::get('/affiche6A/{id}', 'AfficheController@show6')->name('affiche.show6');
Route::get('/affiche1AM/{id}', 'AfficheController@show1')->name('affiche.show_m1');
Route::get('/affiche2AM/{id}', 'AfficheController@show2')->name('affiche.show_m2');
Route::get('/affiche3AM/{id}', 'AfficheController@show3')->name('affiche.show_m3');
Route::resource('attestation', 'AttestationController');
Route::get('/zip{name}', 'attestationController@zip')->name('zip');
Route::resource('depense', 'DepenseController');
Route::post('/depense/{id}', 'DepenseController@edit1')->name('depense.edit1');
Route::get('/export_dep/excel/{id}', 'ExcelController@exportdepenses')->name('export_dep.exportdepenses');
 Route::get('/export_par/excel/{id}', 'ExcelController@exportparticipant')->name('export_par.exportparticipant');
Route::get('/downloadPDF/{id}','ParticipantController@downloadPDF');
Route::get('/downloadWORD/{id}','EventController@DownloadWord');

Route::get('/image', function(){
   
    $aff = Image::make("storage/AF/002.png");
    
    $titre = "Intelligence Artificielle";
    $aff->text($titre, 1754, 280, function($font) {   
      $font->file(public_path('fonts/BookA.ttf'));
   $font->size("200");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top'); 
  });
  $des = "As machines become increasingly capable, tasks considered to require 'intelligence' are often removed from the definition of AI, a phenomenon known as the AI effect.[3] A quip in Tesler's Theorem says 'AI is whatever hasn't been done yet'[4] For instance, optical character recognition is frequently excluded from things considered to be AI,[5] having become a routine technology.[6] Modern machine capabilities generally classified as AI include successfully.";
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
     $heure = '11:11:11';
     $aff->text($heure, 1911.1, 715, function($font) {  
      $font->file(public_path('fonts/bookman-old-style.ttf'));
      $font->size("120");
    $font->color('#494949');
    $font->align('center');
    $font->valign('top');
   });
   $fullname = 'Ouassahoulou Reda Mohammed';
   $profession = 'Concepteur et ingénieur de génie logiciel
Administrateur';
//inserer le nom de l'animateur1
if(strlen($fullname) <= 18){
$aff->text($fullname, 991.09, 3279, function($font) {   
   $font->file(public_path('fonts/georgia bold.ttf'));
 $font->size("90");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
 });
}
else {
   $lines = explode("\n", wordwrap($fullname, 18));
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

 if(strlen($fullname) <= 18){
   $aff->text($fullname, 2459.09, 3279, function($font) {   
      $font->file(public_path('fonts/georgia bold.ttf'));
    $font->size("90");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
    });
   }
   else {
      $lines = explode("\n", wordwrap($fullname, 18));
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
 if(strlen($profession) <= 30){
 $aff->text($profession, 991.09, 3442, function($font) {   
   $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
 $font->size("90");
 $font->color('#080200');
 $font->align('center');
 $font->valign('top');
 });
}
else {
   $lines = explode("\n", wordwrap($profession, 30));
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
 
 if(strlen($profession) <= 30){
   $aff->text($profession, 2459.09, 3442, function($font) {   
     $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
   $font->size("90");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
   });
  }
  else {
     $lines = explode("\n", wordwrap($profession, 30));
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
//    //inserer le nom de l'animateur 1
//    if(strlen($fullname) <= 18){
//    $aff->text($fullname, 1154.09, 2438.67, function($font) {   
//       $font->file(public_path('fonts/georgia bold.ttf'));
//       $font->size("100");
//       $font->color('#080200');
//       $font->align('center');
//       $font->valign('top');
//      });
//    }
//    else {
//       $lines = explode("\n", wordwrap($fullname, 18));
//       $h = 2387;
//       foreach ($lines as $line) {
//          $aff->text($line, 1154.09, $h, function($font) {   
//             $font->file(public_path('fonts/georgia bold.ttf'));
//             $font->size("85");
//             $font->color('#080200');
//             $font->align('center');
//             $font->valign('top');
//            });
//        $h = $h + 100;
//    }
//   }
//      //inserer le nom de l'animateur 2
//      if(strlen($fullname) <= 18){
//      $aff->text($fullname, 2786.09, 2438.67, function($font) {   
//       $font->file(public_path('fonts/georgia bold.ttf'));
//       $font->size("100");
//      $font->color('#080200');
//      $font->align('center');
//      $font->valign('top');
//      });
//    }
//    else {
//       $lines = explode("\n", wordwrap($fullname, 18));
//       $h = 2387;
//       foreach ($lines as $line) {
//          $aff->text($line, 2786.09, $h, function($font) {   
//             $font->file(public_path('fonts/georgia bold.ttf'));
//             $font->size("85");
//             $font->color('#080200');
//             $font->align('center');
//             $font->valign('top');
//            });
//        $h = $h + 100;
//    }
//   }
//      //inserer le nom de l'animateur 3
     
//      if(strlen($fullname) <= 18){
//       $aff->text($fullname, 1154.09, 3200.67, function($font) {   
//        $font->file(public_path('fonts/georgia bold.ttf'));
//        $font->size("100");
//       $font->color('#080200');
//       $font->align('center');
//       $font->valign('top');
//       });
//     }
//     else {
//        $lines = explode("\n", wordwrap($fullname, 18));
//        $h = 3121;
//        foreach ($lines as $line) {
//           $aff->text($line, 1154.09, $h, function($font) {   
//              $font->file(public_path('fonts/georgia bold.ttf'));
//              $font->size("85");
//              $font->color('#080200');
//              $font->align('center');
//              $font->valign('top');
//             });
//         $h = $h + 100;
//     }
//    }
//      //inserer le nom de l'animateur 4
     
//      if(strlen($fullname) <= 18){
//       $aff->text($fullname, 2786.09, 3200.67, function($font) {   
//        $font->file(public_path('fonts/georgia bold.ttf'));
//        $font->size("100");
//       $font->color('#080200');
//       $font->align('center');
//       $font->valign('top');
//       });
//     }
//     else {
//        $lines = explode("\n", wordwrap($fullname, 18));
//        $h = 3121;
//        foreach ($lines as $line) {
//           $aff->text($line, 2786.09, $h, function($font) {   
//              $font->file(public_path('fonts/georgia bold.ttf'));
//              $font->size("85");
//              $font->color('#080200');
//              $font->align('center');
//              $font->valign('top');
//             });
//         $h = $h + 100;
//     }
//    }
//         $profession = 'Concepteur et ingénieur de génie logiciel
// Administrateur';
//      //inserer la profession de l'animateur 1
//      if(strlen($profession) <= 30){
//      $aff->text($profession, 1154.09, 2605.67, function($font) {   
//      $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//      $font->size("70");
//      $font->color('#080200');
//      $font->align('center');
//      $font->valign('top');
//      });
//    }
//    else {
//       $lines = explode("\n", wordwrap($profession, 30));
//       $h = 2605.67;
//       foreach ($lines as $line) {
//          $aff->text($line, 1154.09, $h, function($font) {   
//             $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//             $font->size("70");
//             $font->color('#080200');
//             $font->align('center');
//             $font->valign('top');
//            });
//        $h = $h + 100;
//    }
//   }
//      //inserer la profession de l'animateur 2
     
     
//      if(strlen($profession) <= 30){
//       $aff->text($profession, 2786.09, 2605.67, function($font) {   
//       $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//       $font->size("70");
//       $font->color('#080200');
//       $font->align('center');
//       $font->valign('top');
//       });
//     }
//     else {
//        $lines = explode("\n", wordwrap($profession, 30));
//        $h = 2605.67;
//        foreach ($lines as $line) {
//           $aff->text($line, 2786.09, $h, function($font) {   
//              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//              $font->size("70");
//              $font->color('#080200');
//              $font->align('center');
//              $font->valign('top');
//             });
//         $h = $h + 100;
//     }
//    }
//      //inserer la Profession de l'animateur 3
     
//      if(strlen($profession) <= 30){
//       $aff->text($profession, 1154.09, 3340, function($font) {   
//       $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//       $font->size("70");
//       $font->color('#080200');
//       $font->align('center');
//       $font->valign('top');
//       });
//     }
//     else {
//        $lines = explode("\n", wordwrap($profession, 30));
//        $h = 3340;
//        foreach ($lines as $line) {
//           $aff->text($line, 1154.09, $h, function($font) {   
//              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//              $font->size("70");
//              $font->color('#080200');
//              $font->align('center');
//              $font->valign('top');
//             });
//         $h = $h + 100;
//     }
//    }
//      //inserer la Profession de l'animateur 4
     
//      if(strlen($profession) <= 30){
//       $aff->text($profession, 2786.09, 3340, function($font) {   
//       $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//       $font->size("70");
//       $font->color('#080200');
//       $font->align('center');
//       $font->valign('top');
//       });
//     }
//     else {
//        $lines = explode("\n", wordwrap($profession, 30));
//        $h = 3340;
//        foreach ($lines as $line) {
//           $aff->text($line, 2786.09, $h, function($font) {   
//              $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
//              $font->size("70");
//              $font->color('#080200');
//              $font->align('center');
//              $font->valign('top');
//             });
//         $h = $h + 100;
//     }
//    }
     return $aff->response('png');

});
Route::get('/test', function(){
   $pdf = PDF::loadView('book');
   $customPaper = array(0,0,567.00,283.80);
   $pdf->setPaper('A3', 'portrait');
return $pdf->stream();
// $aff = Image::make("storage/AF/003.png");
// return $aff->stream();
});


