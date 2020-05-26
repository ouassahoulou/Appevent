@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h3 align="center"><u>{{__("Gestion financières ")}}</u></h3>
    <br>
    <form action="{{route('dep')}}" method="post">
        @csrf
        <input type="hidden" name="id_eve" value={{__($depenses[1])}}>
        <div class="row">
            <div class="form-group col-md-2">
                <input type="number" name="nb_dep" id="nb_dep" placeholder="Combien ?" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="submit">{{__('Ajouter une dépense')}}</button>
            </div>
        </div>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
          <tr>
            {{-- <th scope="col">{{__('N°')}}</th> --}}
            <th scope="col">{{__('Libélé')}}</th>
            <th scope="col">{{__('Date')}}</th>
            <th scope="col">{{__('Somme (Dhs)')}}</th>
            <th scope="col">{{__('Justificatif')}}</th>
            <th scope="col">{{__('Action')}}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($depenses[0] as $item)
            <tr>
                {{-- <th scope="row">{{$item->id}}</th> --}}
                <td>{{$item->label}}</td>
                <td>{{$item->date}}</td>
                <td>{{$item->somme}}</td>
                @if (!($item->justificatif))
                <td>{{__('Non justifié')}}</td>
                @else
                <td>{{$item->justificatif}}</td>
                @endif
                <td> <div class="form-row">
                    <div class="form-group">
                    <form action="{{ Route('depense.edit1',$item->id) }}" method="post">
                    {{csrf_field()}}

                        <button type="submit"  class="btn btn-link">{{__('Modifier')}}</button>
                    </form>
              </div>
            
              <div class="form-group">
                    <form action="{{ Route('depense.destroy',$item->id) }}" method="post">
                        {{csrf_field()}}
                   <input type="hidden" name="_method" value="DELETE">
                       <button type="submit" onclick="return confirm('Vous êtes sûre de bien vouloir supprimer la dépense N° {{$item->id}}')" class="btn btn-link">{{__('Supprimer')}}</button>
                  </form>
                </div>
                </div>
                </td>
              </tr>
            @endforeach
        </tbody>
    </table>
    {{$depenses[0]->links()}}

    {{-- <div class="text-center">
        <div class="form-row">
            <div class="form-group col-md-6">
                <a href="{{route('depense.edit',$depenses[1])}}"> <button type="button" style="line-height: 0.5;" class="btn btn-secondary">{{__('Justificatifs')}}</button> </a>
            </div>
            <div class="form-group col-md-6">
                <a href="{{route('export_excel.export',$depenses[1])}}"> <button type="button" style="line-height: 0.5;" class="btn btn-success">{{__('Excel')}}</button> </a>
            </div>
        </div>
     </div> --}}
     <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" style="line-height: 0.5;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{__('Télécharger')}}
        </button>
     <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <a class="dropdown-item" href="{{route('depense.edit',$depenses[1])}}">{{__('Justificatifs')}}</a>
        <a class="dropdown-item" href="{{route('export_excel.export',$depenses[1])}}">{{__('Excel')}}</a>
      </div>
     </div>
</div>
@endsection