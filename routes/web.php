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
// Route::get('/at', function(){
//     // return view('attestation');
//     $pdf = PDF::loadView('attestation');
//         return $pdf->stream();
// });


