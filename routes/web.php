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
Route::get('/affiche1AM/{id}', 'AfficheController@show1')->name('affiche.show_m1');
Route::get('/affiche2AM/{id}', 'AfficheController@show2')->name('affiche.show_m2');
Route::get('/affiche3AM/{id}', 'AfficheController@show3')->name('affiche.show_m3');
Route::resource('attestation', 'AttestationController');
Route::get('/zip{name}', 'attestationController@zip')->name('zip');
Route::resource('depense', 'DepenseController');
Route::post('/depense/{id}', 'DepenseController@edit1')->name('depense.edit1');
Route::get('/export_excel/excel/{id}', 'ExcelController@export')->name('export_excel.export');
Route::get('/downloadPDF/{id}','ParticipantController@downloadPDF');
Route::get('/image', function(){
    $aff1A = "storage/AF/003.png";
    $aff = Image::make($aff1A);
    $des = "L'innovation est la recherche constante d'améliorations de l'existant, par contraste avec l'invention, qui vise à créer du nouveau. Elle est la capacité qui permet de trouver des solutions à des problèmes complexes qui peuvent être techniques, financiers, organisationnels ou méthodiques, et qui par leur complexité ne peuvent pas s’obtenir simplement en appliquant des formules préétablies.";
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
   $nom_a = "Ouassahoulou Reda";
    //inserer le nom de l'animateur 1
    
    $aff->text($nom_a, 2700, 4891, function($font) {   
        $font->file(public_path('fonts/georgia bold.ttf'));
        $font->size("155");
        $font->color('#080200');
        $font->align('center');
        $font->valign('top');
     });
     //inserer le nom de l'animateur 2
      
     $aff->text($nom_a, 1110, 5154, function($font) {   
        $font->file(public_path('fonts/georgia bold.ttf'));
        $font->size("155");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
  });
  //inserer le nom de l'animateur 3
      
  $aff->text($nom_a, 4290, 5154, function($font) {   
     $font->file(public_path('fonts/georgia bold.ttf'));
     $font->size("155");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
  });
  //inserer la profession de l'animateur
  $p_a = "Etudiant professeur";
//inserer la profession de l'animateur 1
   
$aff->text($p_a, 2700, 5092, function($font) {   
    $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
    $font->size("140");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
 });
    //inserer la profession de l'animateur 2
    
    $aff->text($p_a, 1110, 5347, function($font) {   
       $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
       $font->size("140");
      $font->color('#080200');
      $font->align('center');
      $font->valign('top');
   });
      //inserer la Profession de l'animateur 3
 $aff->text($p_a, 4290, 5347, function($font) {   
    $font->file(public_path('fonts/BookAntiquaBoldItalic.ttf'));
    $font->size("140");
    $font->color('#080200');
    $font->align('center');
    $font->valign('top');
  });
  //inserer la date de l'événement
  $date = "22-22-1111";
 $aff->text($date, 948, 6090, function($font) {   
     $font->file(public_path('fonts/RFlexBold.ttf'));
  $font->size("250");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
 });
 //inserer l'heure de l'événement
 $heure = "11:11:11";
 $aff->text($heure, 2700, 6090, function($font) {  
     $font->file(public_path('fonts/RFlexBold.ttf'));
  $font->size("250");
   $font->color('#080200');
   $font->align('center');
   $font->valign('top');
 });
    //inserer le lieu de l'évènement
    $locale = "Université Hassan II Amphithéatre A2";
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
     return $aff->response('png');
});


