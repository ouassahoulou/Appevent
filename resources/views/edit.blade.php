@extends('layouts.app')

@section('content')

<section class="contact-area ptb-100" style="background-color: #0093FF;">
    
    <div class="container" style="max-width: 650px; " >  
        <h1 style="color: rgb(228, 241, 250);  " align="center"><Strong>{{__("Modification de l'Évenement  ".$modify[0]->id)}}</Strong></h1><br><br>
    <form action="{{route('event.update',$modify[0]->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
        <label  style="color: rgb(228, 241, 250); "for="titre"><strong>{{__('Titre')}}</strong></label>
        <input type="text" name="titre" value="{{old('titre',$modify[1]->titre)}}" id="titre" class="form-control ">
        </div>
        <div class="form-group">
            <label style="color: rgb(228, 241, 250); "for="titre"><strong>{{__('Type')}}</strong></label>
            <select name="type" id="type" class="form-control">
                <option selected>{{__('Scientifique')}}</option>
                <option>{{__('Culturel')}}</option>
              </select>
            </div>
        <div class="form-group">
        <label  style="color: rgb(228, 241, 250); "for="locale"><strong>{{__('Locale')}}</strong></label>
        <input type="text" name="locale" value="{{old('locale',$modify[1]->locale)}}" id="locale" class="form-control ">
        </div>
        <label style="color: rgb(228, 241, 250); for="duree"><strong>{{__('Duree')}}</strong></label>
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
        <label style="color: rgb(228, 241, 250); " for="date"><strong>{{__('Date')}}</strong></label>
        <input type="date" name="date" value="{{old('date',$modify[1]->date)}}" id="date" class="form-control ">
        </div>
        <div class="form-group">
        <label style="color: rgb(228, 241, 250);  " for="heure"><strong>{{__('Heure')}}</strong></label>
        <input type="time" name="heure" value="{{old('heure',$modify[1]->heure)}}" id="heure" class="form-control ">
        </div>
        <div class="form-group">
        <label  style="color: rgb(228, 241, 250); " for="plan"><strong>{{__('Plan')}}</strong></label>
        <textarea name="plan" id="plan"  class="form-control " placeholder="{{old('plan',$modify[0]->plan)}}"></textarea>
        </div>
        <div class="form-group">
            <label style="color: rgb(228, 241, 250);"  for="description"><strong>{{__('Description')}}</strong></label>
            <textarea name="description" id="description"  class="form-control " placeholder="{{old('description',$modify[0]->description)}}"></textarea>
            </div>
        <div class="form-group">
        <label  style="color: rgb(228, 241, 250);" for="nb_place"><strong>{{__('Nombre de place')}}</strong></label>
        <input type="number" name="nb_place" value="{{old('nb_place',$modify[0]->nb_place)}}" id="nb_place" class="form-control ">
        </div>
        <div class="form-group">
        <label style="color: rgb(228, 241, 250);"  for="nb_pause"><strong>{{__('Nombre de pause')}}</strong></label>
        <input type="number" name="nb_pause" value="{{old('nb_pause',$modify[0]->nb_pause)}}" id="nb_pause" class="form-control ">
        </div>
        <div class="form-group">
            <label  style="color: rgb(228, 241, 250);" for="nb_animateur"><strong>{{__("Nombre d'animateur")}}</strong></label>
            <input type="number" name="nb_animateur" value="{{old('nb_animateur',$modify[2])}}" id="nb_animateur" class="form-control ">
        </div>  
        
        <div class="form-group">
            <button type="submit"  style="display: block;
            margin : auto;"  class="submit">{{__('Gestion des animateurs')}}</button>
        </div>
    </form>
</div>
</section>
@endsection

