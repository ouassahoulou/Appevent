@extends('layouts.app')

@section('content')
<body >
<br><h2 align="center"  ><strong>{{__("Gestion des Participants ")}}</strong></h2><br><br>
<br><br>
<br><br><br>
		<div class="container">
			<form action="{{route('search_gp')}}" method="get" role="search">
				{{ csrf_field() }}
				<div class="input-group">
					<input type="text" class="form-control" name="search"
						placeholder=" Titre de l'Evenement?"> <span class="input-group-btn">
						<button class="btn btn-unique btn-rounded btn-sm my-0"  style="     border-color: #626fff color:rgb(0, 5, 80);" type="submit">Search</button>
						   
					</span>
				</div>
			</form>
		</div><br><br>
<div class="container">
    <div class="row">
        @foreach ($evenements[0] as $evenement)
        @foreach ($evenements[1] as $generation)
            @if ($evenement->id==$generation->id_evenement)
            <div class="col-md-4 col-sm-6" >
             <div class="single-service white-bg text-center">
                 <a href="{{route('participate.show',$evenement->id)}}">
              
                        <h3>{{$generation->titre}}</h3>
                        <h5>{{__(' Le '.$generation->date )}}</h5>
                        <h6>{{__( ' à '.$generation->locale)}}</h6>
                     </a>
               </div>
            </div>
              @endif
       @endforeach
  @endforeach
         <br><br><div class="justify-content-center"  style=" display:table;
         margin:0 auto;"  >
    {{$evenements[0]->links()}}
</div>    
         </div>
</body>
@endsection  
                    