@extends('layouts.app')

@section('content')
<section class="contact-area ptb-100" style="background-color: #0093FF;">
    
    <div class="container" style="max-width: 650px; " >  
        <h1 style="color: rgb(228, 241, 250);  " align="center"><Strong>{{__('Modification Profil : ')}}</Strong></h1><br>
        <form action="{{route('profil.update',$admin->id)}} " method="post" >
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="row">
                    <div class="col">
                      <input type="text" name="nom" id="nom" class="form-control" value="{{old('nom',$admin->nom)}}">
                    </div>
                    <div class="col">
                      <input type="text" name="prenom" id="prenom" class="form-control" value="{{old('prenom',$admin->prenom)}}">
                    </div>
                  </div>
            </div>
              <div class="form-group">
                <input type="text" name="titre" id="titre" class="form-control" value="{{old('titre',$admin->titre)}}">
            </div>
              <div class="form-group">
                  <input type="text" name="telephone" id="telephone" class="form-control" value="{{old('telephone',$admin->telephone)}}">
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" value="{{old('email',$admin->email)}}">
            </div>
            <div class="form-group">
                <input type="text" name="login" id="login" class="form-control" value="{{old('login',$admin->Login)}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="password" name="password" id="password" class="form-control" placeholder="New password">
                </div>
                <div class="form-group col-md-6">
                    <input type="password" name="c_password" id="c_password" class="form-control" placeholder="Confirm password">
                </div> 
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="free">
                    <label class="custom-control-label" for="customCheck1">{{__('free')}}</label>
                  </div>
            </div>
            <div class="form-group">
                <button type="submit"   class="submit">{{__('Confirmer la modification')}}</button>
            </div>
            </form>
    </div>
</section>
@endsection