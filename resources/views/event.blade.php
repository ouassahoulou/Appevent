 @extends('layouts.app')

@section('content')
<section class="contact-area ptb-100" style="background-color: #0093FF;">
    
    <div class="container" style="max-width: 650px; " >  
        <h1 style="color: rgb(228, 241, 250);  " align="center"><Strong>{{__("Creation de   l'Événement ")}}</Strong></h1><br>
        <form action="{{route('event.store')}}" method="post">
            @csrf
            <div class="form-group">
            <label style="color: rgb(228, 241, 250); "for="titre"><strong>{{__('Titre')}}</strong></label>
            <input type="text" name="titre" id="titre" class="form-control ">
            </div>
            <div class="form-group">
                <label  style="color: rgb(228, 241, 250); " for="titre"><strong>{{__('Type')}}</strong></label>
                <select name="type" id="type" class="form-control">
                    <option selected>{{__('Scientifique')}}</option>
                    <option>{{__('Culturel')}}</option>
                  </select>
                </div>
            <div class="form-group">
            <label style="color: rgb(228, 241, 250); "  for="locale"><strong>{{__('Locale')}}</strong></label>
            <input type="text" name="locale" id="locale" class="form-control ">
            </div>
            <label style="color: rgb(228, 241, 250); " for="duree"><strong>{{__('Duree')}}</strong></label>
            <div class="form-row">
                <div class="form-group col-md-6">
                    
                    <input type="text" name="number" id="number" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group col-md-6">
                    <select name="timing" id="timing" class="form-control">
                        <option selected>{{__('Minutes')}}</option>
                        <option>{{__('Heures')}}</option>
                        <option>{{__('Jours')}}</option>
                      </select>
                </div>
            </div>   
            <div class="form-group">       
            <label style="color: rgb(228, 241, 250); "  for="date"><strong>{{__('Date')}}</strong></label>
            <input type="date" name="date" id="date" class="form-control ">
            </div>
            <div class="form-group">
            <label style="color: rgb(228, 241, 250); " for="heure"><strong>{{__('Heure')}}</strong></label>
            <input type="time" name="heure" id="heure" class="form-control ">
            </div>
            <div class="form-group">
            <label style="color: rgb(228, 241, 250); " for="plan"><strong>{{__('Plan')}}</strong></label>
            <textarea name="plan" id="plan" class="form-control "></textarea>
            </div>
            <div class="form-group">
                <label style="color: rgb(228, 241, 250); " for="description"><strong>{{__('Description')}}</strong></label>
                <textarea name="description" id="description" class="form-control "></textarea>
                </div>
            <div class="form-group">
            <label style="color: rgb(228, 241, 250); "  for="nb_place"><strong>{{__('Nombre de place')}}</strong></label>
            <input type="number" name="nb_place" id="nb_place" class="form-control ">
            </div>
            <div class="form-group">
            <label style="color: rgb(228, 241, 250); " for="nb_pause"><strong>{{__('Nombre de pause')}}</strong></label>
            <input type="number" name="nb_pause" id="nb_pause" class="form-control ">
            </div>
            <div class="form-group">
                <label  style="color: rgb(228, 241, 250); " for="nb_animateur"><strong>{{__("Nombre d'animateur")}}</strong></label>
                <input type="number" name="nb_animateur" id="nb_animateur" class="form-control ">
            </div>  
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="free">
                    <label style="color: rgb(228, 241, 250); "  class="custom-control-label" for="customCheck1">{{__('free')}}</label>
                  </div>
            </div>
            <div class="form-group">
            <button type="submit"  style="display: block;
            margin : auto;"   class="submit">{{__('Gestion des animateurs')}}</button>
            </div> 
        </form>
    </div>
</section>
    
@endsection