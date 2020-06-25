@extends('layouts.main')

@section('content')
<section class="breadcrumbs-area ptb-100 port bread-card">
    <div class="container">
        <br>
        <h3 align="center"><u>Formulaire de participation</u></h3>
        <br>
        <form action="{{route('participate.store')}} " method="post">
            @csrf
            <input type="hidden" name="id" value={{__($eve)}} class="form-control">
            <div class="form-row">
                <div class="form-group col-md-4" style="padding: unset !important; ">
                     <input type="text" name="nom" id="nom" class="form-control"  placeholder="Saisissez votre nom">
                </div>
                <div class="form-group col-md-4" style="padding-left: 7px !important; padding-right: 7px !important;">
                    <input type="text" name="prenom" id="prenom" class="form-control"  placeholder="Saisissez votre prenom">
                </div>
                <div class="form-group col-md-4" style="padding: unset !important;">
                    <input type="text" name="telephone" id="telephone" class="form-control"  placeholder="Saisissez votre telephone">
                </div>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Saisissez votre adressse mail">
            </div>
            <div class="form-group">
                <input type="text" name="profession" id="profession" class="form-control" placeholder="Saisissez votre profession">
            </div>
            <div class="form-group">
                <input type="text" name="cin" id="cin" class="form-control" placeholder="Saisissez votre CIN">
            </div>
            <div class="form-group">
                <input type="date" name="naissance" id="naissance" class="form-control" placeholder="Saisissez votre date naissance">
            </div>
            
        
        <div class="form-group">
            <button type="submit"  style="display:table;
            margin:0 auto;" class="submit">Participer</button>
        </div>
        </form> 
    </div>
</section>
@endsection