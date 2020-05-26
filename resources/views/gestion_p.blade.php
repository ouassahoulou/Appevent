@extends('layouts.app')

@section('content')
<body style="background:#ebf7ff;">
<br><h2 align="center"  ><strong>{{__("Gestion des participants ")}}</strong></h2><br><br>
<div class="container">
    <div class="row">
        @foreach ($evenements[0] as $evenement)
        @foreach ($evenements[1] as $generation)
            @if ($evenement->id==$generation->id_evenement)
            <div class="col-md-3 col-sm-6" >
             <div class="single-service white-bg text-center">
                 <a href="{{route('participate.show',$evenement->id)}}">
              
                        <h4>{{$generation->titre}}</h4>
                        <h6>{{__(' Le '.$generation->date )}}</h6>
                        <h5>{{__( ' à '.$generation->locale)}}</h5>
                     </a>
               </div>
            </div>
            
           
                    
                
               
             @endif
       @endforeach
  @endforeach
      
  <div class="justify-content-center" style="padding-left: 600px;"  >
    {{$evenements[0]->links()}}
</div>

    </div>
</body>
@endsection