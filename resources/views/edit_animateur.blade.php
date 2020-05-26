@extends('layouts.app')

@section('content')
<body style="background-color: #0093FF;>
        <section class="contact-area ptb-100">
            <div class="container" style="max-width: 650px; " >
        <h1  style="color: rgb(228, 241, 250);  " align="center"><strong>{{__('Les Animateurs:')}}</strong></h1><br><br>
    <form action="{{route('animate.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- @method('DELETE') --}}
        <input type="hidden" name="nb_animateur" value={{__($tab[1])}} class="form-control">
        <input type="hidden" name="id_ev" value={{__($tab[0])}} class="form-control">
        @for ($i = 0; $i < $tab[1]; $i++)
        {{-- <p> {{__('A'.(1+$i))}} </p> --}}
        <div class="form-group">
            <p class=" h4 text-center">{{__('Animateur'.(1+$i))}} </p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                 <input type="text" name={{__('nom'.$i)}} id={{__('nom'.$i)}} class="form-control" placeholder="Nom" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" name={{__('prenom'.$i)}} id={{__('prenom'.$i)}} class="form-control" placeholder="Prenom" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" name={{__('profession'.$i)}} id={{__('profession'.$i)}} class="form-control" placeholder="Profession"required>
            </div>
            <div class="form-group col-md-3">
                
                <input style=" height: 33px;padding-left: -23px; width: 197%;"  type="file" name={{__('animateur_image['.$i.']')}}  id={{__('animateur_image['.$i.']')}} placeholder="Choisir fichier" required>
              
            </div>
        </div>
        @endfor
        
        <div class="form-group">
            <button type="submit"style="display: block;
            margin : auto;"   class="submit">{{__("Modifier l'affiche")}}</button>
        </div>
    </form>
</div>
@endsection

