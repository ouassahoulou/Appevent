@extends('layouts.app')

@section('content')
    
    <div class="container">
        <form action="{{route('finance.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="nb_financier" value={{__($arr[2])}} class="form-control">
            <input type="hidden" name="id_ev" value={{__($arr[0])}} class="form-control">
            <input type="hidden" name="nb_a" value={{__($arr[1])}} class="form-control">
            @for ($i = 0; $i < $arr[2]; $i++)

            <p class=" h4 text-center">{{__('Participant Financiers'.(1+$i))}} </p>

            <div class="form-row">
                <div class="form-group col-md-3">
                     <input type="text" name={{_('nom'.$i)}} id={{_('nom'.$i)}} class="form-control" placeholder="Nom" required>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" name={{_('prenom'.$i)}} id={{_('prenom'.$i)}} class="form-control" placeholder="Prenom" required>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" name={{_('telephone'.$i)}} id={{_('telephone'.$i)}} class="form-control" placeholder="Telephone" required>
                </div>
                <div class="form-group col-md-3">
                    <input type="email" name={{_('email'.$i)}} id={{_('email'.$i)}} class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" name={{_('nom_org'.$i)}} id={{_('nom_org'.$i)}} class="form-control" placeholder="Nom de l'Organisme" required>
                </div>
                <div class="form-group col-md-4">
                    <input type="number" name={{_('Mt_investi'.$i)}} id={{_('Mt_investi'.$i)}} class="form-control" placeholder="Montant Investi" required>
                </div>
                <div class="form-group col-md-4">
                    <input  type="file" name={{_('participant_financier['.$i.']')}}  id={{_('participant_financier['.$i.']')}} placeholder="Choisir Une photo" required>
                   </div>
                </div>
            @endfor
                <div class="form-group">
                    <button type="submit"   class="submit">{{__("Générer l'affiche")}}</button>
                </div>
        </form>
    </div>

@endsection