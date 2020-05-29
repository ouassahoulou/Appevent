@extends('layouts.app')

@section('content')


<body style="background: white">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="analysis-area">
                        <div class="container-fluid">
                           
                            <div class="row">
                            <div class="col-md-4 col-sm-4 p-0" >
                                {{-- style="background-image: url({{asset('img/g_e.png')}}); background-position: center;
                            background-repeat: no-repeat;
                            background-size: cover;" --}}
                                    <div class="analysis-box"  style="background-color: #C6DAE7" >
                                       
                                        <h4 style="color: rgb(0, 0, 0);"><strong>{{__('Gestion des événements:')}}</strong></h4>
                                        <a  href="{{route('event.index')}} " style="color:rgb(0, 5, 80);"  ><strong  > <u>{{__('Créer un événement')}}</u> </strong> </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 p-0" style="background-color: #5E93DB">
                                    <div class="analysis-box">
                                        
                                        <h4 style="color: rgb(0, 0, 0);"><strong>{{__('Gestion des participants:')}}</strong></h4>
                                        <a  href="{{route('gestion_p')}}" style="color:rgb(0, 5, 80);"   ><strong > <u>{{__('Lister les participants')}}</u> </strong> </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 p-0" style="background-color: #C6DAE7">
                                    <div class="analysis-box">
                                        
                                        <h4 style="color: rgb(0, 0, 0);"><strong>{{__('Gestion financiéres:')}}</strong></h4>
                                        <a  href="{{route('gestion_f')}}" style="color:rgb(0, 5, 80);"   ><strong > <u>{{__('Personalisation des dépenses')}}</u> </strong> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="section-title text-center mb-70">
                        <br><h1 style="color:#051C2C;">{{__('Administrateur')}}</h1>
                        <h4 style="color:rgb(0, 5, 80);" ><strong>{{__('Home / Events')}}</strong></h4>
                        
                    </div>	

                    <div class="container">
                        <div class="row">
                            
                          @foreach ($evenements[0] as $evenement)
                                @foreach ($evenements[1] as $generation)
                                    @if ($evenement->id==$generation->id_evenement)
                            
                                          <div class="col-md-4 col-sm-6" >
                                              <div class="single-service text-center">
                                               <h2 style="color: rgb(0, 5, 80)" >{{$generation->titre}}</h2>
                                                <h3 style="color: rgb(0, 5, 80)" >{{$generation->date}}</h3>
                                                   <h4 style="color: rgb(0, 5, 80)" ><strong>{{__('Heure:')}}</strong>	{{$generation->heure}} </h4>
                                                   <h4 style="color: rgb(0, 5, 80)" ><strong>{{__('Nombre De Place:')}} </strong>{{$evenement->nb_place}}</h4>
                                                     <a  style="color: rgb(0, 5, 80)" href="{{Route('admin_detail',$evenement->id)}}"  role="button" style="color:#0093FF;"  > {{__('Details')}} </a>
                                               <a style="color: rgb(0, 5, 80)"  class="submit" href="event/{{$evenement->id}}/edit" role="button" style="color:#0093FF;" > / {{__('Modifier')}}</a>
                                               <div> <form action="{{ Route('event.destroy',$evenement->id) }}" method="post">
                                                {{csrf_field()}}
                                           <input type="hidden" name="_method" value="DELETE">
                                               <button style="background-color: rgb(0, 5, 80)" type ="submit" onclick="return confirm('Vous êtes Sûre De Bien Vouloir Supprimer L\'Évenement:  {{$generation->titre}}')" class="submit">{{__('Annuler')}}</a>
                                          </form>
                                  </div>
                                                                        
                                                </div>
                                            </div>
                                                               
                                            
                            
                                     @endif
                               @endforeach
                          @endforeach
                       </div>
                 </div>        
        <br>
        
        <div class="justify-content-center" style="padding-left: 600px;"  >
            {{$evenements[0]->links()}}
        </div>
        
           
          
        
</body>

@endsection
