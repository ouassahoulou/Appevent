 @extends('layouts.app')

@section('content')
<section class="contact-area ptb-100">
    
    <div class="container">  
        <h1 align="center"><u>{{__("Creation d'un événement")}}</u></h1>
        <br>
            <form action="{{route('event.store')}}" method="post">
            @csrf
            <div class="form-group">
            <label for="titre"><strong>{{__('Titre')}}</strong></label>
            <input type="text" name="titre" id="titre" class="form-control "  required>
            </div>
            <div class="form-group">
                <label  for="titre"><strong>{{__('Type')}}</strong></label>
                <select name="type" id="type" class="form-control">
                    <option selected>{{__('Scientifique')}}</option>
                    <option>{{__('Culturel')}}</option>
                  </select>
                </div>
            <div class="form-group">
            <label  for="locale"><strong>{{__('Locale')}}</strong></label>
            <input type="text" name="locale" id="locale" class="form-control" maxlength="28" required>
            </div>
            <label for="duree"><strong>{{__('Duree')}}</strong></label>
            <div class="form-row">
                <div class="form-group col-md-6">
                    
                    <input type="text" name="number" id="number" class="form-control" placeholder="Nombre"  required>
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
            <label  for="date"><strong>{{__('Date')}}</strong></label>
            <input type="date" name="date" id="date" class="form-control "  required>
            </div>
            <div class="form-group">
            <label for="heure"><strong>{{__('Heure')}}</strong></label>
            <input type="time" name="heure" id="heure" class="form-control "  required>
            </div>
            <div class="form-group">
            <label for="plan"><strong>{{__('Plan')}}</strong></label>
            <textarea name="plan" id="plan" class="form-control "  required></textarea>
            </div>
            <div class="form-group">
                <label for="description"><strong>{{__('Description')}}</strong></label>
                <textarea name="description" id="description" minlength="300" maxlength="450" class="form-control "  required></textarea>
                </div>
            <div class="form-group">
            <label  for="nb_place"><strong>{{__('Nombre de place')}}</strong></label>
            <input type="number" name="nb_place" id="nb_place" class="form-control "  required>
            </div>
            <div class="form-group">
            <label for="nb_pause"><strong>{{__('Nombre de pause')}}</strong></label>
            <input type="number" name="nb_pause" id="nb_pause" class="form-control "  required>
            </div>
            <div class="form-group">
                <label  for="nb_animateur"><strong>{{__("Nombre d'animateur")}}</strong></label>
                <input type="number" name="nb_animateur" id="nb_animateur" min="1"  max="6" class="form-control "  required>
            </div>
            <div class="form-group">
                <label  for="nb_org"><strong>{{__("Nombre de comité")}}</strong></label>
                <input type="number" name="nb_org" id="nb_org"  min="1"  max="6" class="form-control "  required>
            </div>
            <div class="form-group">
                <label  for="nb_org"><strong>{{__("Nombre de participant financiers")}}</strong></label>
                <input type="number" name="nb_pf" id="nb_pf"  min="1"  max="4" class="form-control "  required>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="free">
                    <label  class="custom-control-label" for="customCheck1">{{__('free')}}</label>
                  </div>
            </div>
            
            <div class="form-group">
            <button type="submit"  style="display: block;
            margin : auto;"   class="submit">{{__('Animateurs - Comité')}}</button>
            </div> 
        </form>
    </div>
</section>

@endsection