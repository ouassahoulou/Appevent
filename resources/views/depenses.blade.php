@extends('layouts.app')

@section('content')
<h2 align="center"><u>{{__('Formulaire de dépenses')}}</u></h2><br><br>
<div class="container">
    <form action="{{route('depense.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="nb_dep" value={{__($nb[0])}} class="form-control">
        <input type="hidden" name="id_eve" value={{__($nb[1])}} class="form-control">
        @for ($i = 0; $i < $nb[0]; $i++)
        
        <div class="form-group">
            <p class=" h4 text-center">{{__('Dépense '.(1+$i))}} </p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                 <input type="text" name={{__('label'.$i)}} id={{__('label'.$i)}} class="form-control" placeholder="Libélé" required>
            </div>
            <div class="form-group col-md-2">
                <input type="date" name={{__('date'.$i)}} id={{__('date'.$i)}} class="form-control" required>
            </div>
            <div class="form-group col-md-2">
                <input type="number" name={{__('quantité'.$i)}} id={{__('quantité'.$i)}} class="form-control" placeholder="quantité" value="1" required>
            </div>
            <div class="form-group col-md-2">
                <input type="number" name={{__('somme'.$i)}} id={{__('somme'.$i)}} class="form-control" placeholder="Somme (en Dhs)" required>
           </div>
            <div class="form-group col-md-3">
                  <input type="file"  accept="application/pdf,image/png" style="background: #ffffff; border: 1px solid rgba(0,0,0,.15); height: 37px; padding-left: 3px; padding-top: 3px; border-radius: 3px;" name={{__('justif['.$i.']')}}  id={{__('justif['.$i.']')}} placeholder="Justificatif" >
              </div>
        </div>
        <div class="form-group">
            {{-- <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id={{__('customCheck1['.$i.']')}} name={{__('j['.$i.']')}}>
                <label class="custom-control-label" for={{__('customCheck1['.$i.']')}}>{{__('Sans justificatif')}}</label>
              </div> --}}
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id={{__('customSwitch1'.$i)}} name={{__('j'.$i)}}>
                <label class="custom-control-label" name={{__('j'.$i)}} for={{__('customSwitch1'.$i)}}>Sans justificatif</label>
              </div>
        </div>
        @endfor
        
        <button type="submit"   class="submit">{{__("AJOUTER")}}</button>
    </form>
</div>
@endsection