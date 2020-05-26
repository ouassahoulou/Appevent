@extends('layouts.app')

@section('content')
<h2 align="center"><u>{{__('Modification de la dépense')}}</u></h2>
<div class="container">
    <form action="{{route('depense.update',$nb)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id_dep" value={{__($nb)}} class="form-control">
        <input type="hidden" name="id_eve" value={{__('ok')}} class="form-control">
        
        
        <div class="form-group">
            <p class=" h4 text-center">{{__('Dépense ')}} </p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                 <input type="text" name={{__('label')}} id={{__('label')}} class="form-control" placeholder="Libélé" required>
            </div>
            <div class="form-group col-md-2">
                <input type="date" name={{__('date')}} id={{__('date')}} class="form-control" required>
            </div>
            <div class="form-group col-md-2">
                <input type="number" name={{__('quantité')}} id={{__('quantité')}} class="form-control" placeholder="quantité" value="1" required>
            </div>
            <div class="form-group col-md-2">
                <input type="number" name={{__('somme')}} id={{__('somme')}} class="form-control" placeholder="Somme (en Dhs)" required>
           </div>
            <div class="form-group col-md-3">
                  <input type="file" name={{__('justif')}}  id={{__('justif')}} placeholder="Justificatif" >
              </div>
        </div>
        <div class="form-group">
            {{-- <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id={{__('customCheck1['.$i.']')}} name={{__('j['.$i.']')}}>
                <label class="custom-control-label" for={{__('customCheck1['.$i.']')}}>{{__('Sans justificatif')}}</label>
              </div> --}}
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id={{__('customSwitch1')}} name={{__('j')}}>
                <label class="custom-control-label" name={{__('j')}} for={{__('customSwitch1')}}>Sans Justificatif</label>
              </div>
        </div>
        
        
        <button type="submit"   class="submit">{{__("AJOUTER")}}</button>
    </form>
</div>
@endsection