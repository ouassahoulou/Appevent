@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h3 align="center"><u>{{__("Gestion financières ")}}</u></h3>
        <br>
        <div class="card text-center">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link " id="nav-link" href="{{route('gestion_f')}}">{{__('Payant')}}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="nav-link" href="{{route('gestion_fp')}}">{{__('Gratuit')}}</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              
              @foreach ($evenements[0] as $evenement)
              @foreach ($evenements[1] as $generation)
                  @if ($evenement->id==$generation->id_evenement)
                  <a href="{{route('depense.show',$evenement->id)}}">
                      <div class="card">
                          <div class="card-body">
                              <h2>{{$generation->titre}}</h2>
                              <div class="blockquote-footer">{{__('le '.$generation->date.' à '.$generation->locale)}}</div>
                          </div>
                      </div>
                  </a>
                      <br>  
                   @endif
              @endforeach
              @endforeach
                  
           </div>
          </div>    <br><br><div class="justify-content-center"  style=" display:table;
          margin:0 auto;"  >
     {{$evenements[0]->links()}}
 </div>     
    </div>
@endsection