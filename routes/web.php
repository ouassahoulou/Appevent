<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Evenement;
use App\Generation;

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
Route::get('/search/index','PageController@search')->name('search_index');
Route::get('/search/home','EventController@search')->name('search_home');
Route::get('/search/gp','ParticipantController@search')->name('search_gp');
Route::resource('finance', 'PFinancier');
Route::get('/image', function(){
   
    $aff = Image::make("storage/AF/006.png");
    
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
     return $aff->response('png');

});
Route::get('/test', function(){

   $event = Generation::find(1);      

   $aff = Image::make("storage/AF/006.png");

   $height = Image::make("storage/Organisme/fsac.png")->height();
   $width = Image::make("storage/Organisme/fsac.png")->width();
   
   
   $resize = Image::make("storage/Organisme/fsac.png")->resize(1109,500);

   //inserer l'image du sponsor 1
   $aff->insert($resize,'top_left',786 ,4436);
   
   return $aff->response('png');
});


