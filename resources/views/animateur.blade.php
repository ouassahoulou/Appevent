@extends('layouts.app')

@section('content')

<section class="contact-area ptb-100">
    <div class="container">
<h1  align="center"><strong>{{__('Les Animateurs:')}}</strong></h1><br><br>
    <form action="{{route('animate.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="nb_animateur" value={{__($nb[0])}} class="form-control">
        <input type="hidden" name="nb_org" value={{__($nb[1])}} class="form-control">
        <input type="hidden" name="id_eve" value={{__($nb[2])}} class="form-control">
        <input type="hidden" name="id_ev" value="ok" class="form-control">
        <input type="hidden" name="nb_pf" value={{__($nb[3])}} class="form-control">
        @for ($i = 0; $i < $nb[0]; $i++)
        
        <div class="form-group">
            <p class=" h4 text-center">{{__('Animateur'.(1+$i))}} </p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                 <input type="text" name={{__('nom'.$i)}} id={{__('nom'.$i)}} max="32" class="form-control" placeholder="Nom" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" name={{__('prenom'.$i)}} id={{__('prenom'.$i)}} max="77" class="form-control" placeholder="Prenom" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" name={{__('profession'.$i)}} id={{__('profession'.$i)}} class="form-control" placeholder="Profession" required>
            </div>
            <div class="form-group col-md-3">
                
                  <input style=" height: 33px; padding-left: -23px; width: 197%;"   type="file" name={{__('animateur_image['.$i.']')}}  id={{__('animateur_image['.$i.']')}} placeholder="Choisir fichier" required>
                
              </div>
              {{-- <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id={{__('inputGroupFile02['.$i.']')}}>
                  <label class="custom-file-label" for={{__('inputGroupFile02['.$i.']')}} name={{__('animateur_image['.$i.']')}} aria-describedby="inputGroupFileAddon02">{{__('Choisir un fichier')}} </label>
                </div>
              </div> --}}
        </div>
        
        @endfor
        @for ($i = 0; $i < $nb[1]; $i++)
        <div class="form-group">
            <p class=" h4 text-center">{{__('Organisateur'.(1+$i))}} </p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="text" name={{__('nom_org'.$i)}} id={{__('nom_org'.$i)}} class="form-control" placeholder="Nom" required>
           </div>
           <div class="form-group col-md-6">
               <input type="text" name={{__('prenom_org'.$i)}} id={{__('prenom_org'.$i)}} class="form-control" placeholder="Prenom" required>
           </div>
        </div>
        @endfor
        <br><button  type="submit" class="submit">{{__("Participants financiers")}}</button>
    </form>
</div>
{{-- <script>
    @for ($i = 0; $i < $nb; $i++){
    
    $('#inputGroupFile02['+$i+']').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    }
</script> --}}
@endsection