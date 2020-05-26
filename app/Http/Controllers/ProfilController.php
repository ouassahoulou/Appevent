<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
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
        $admin = Admin::find($id);
        return view('modify')->with('admin', $admin);
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
        $this->validate($request,[
            'nom' => 'required',
            'prenom' => 'required',
            'titre' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'login' => 'required',
            'password' => 'required',
            'c_password' => 'required'   
        ]);

        $admin = Admin::find($id);
        $password = $request->input('password');
        $confirm = $request->input('c_password');
        if (strcmp($password,$confirm) == 0) {
            $admin->nom = $request->input('nom');
            $admin->prenom = $request->input('prenom');
            $admin->telephone = $request->input('telephone');
            $admin->email = $request->input('email');
            $admin->login = $request->input('login');
            $admin->password = Hash::make($password);
            $admin->save();

            return redirect()->route('profil_admin',$admin->id);
        } else {
            return redirect()->route('profil_admin',$admin->id);
        }
        
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
