
		@extends('layouts.main')

    @section('content')
    



<section class="breadcrumbs-area gray-bg ptb-100 port bread-card solid-color">
  <div class="container">
    <div class="section-title text-center mb-70">
                    <br><br><h2 class="page-title">{{$event[1]->titre}}</h2>
                    <h4 style="color:#0e60b7e0;"><strong>{{__('Evenement de Type')}}  </strong> : {{$event[0]->type}} </h4>
                     <h2><div class=arrow_down_alt ><h2></div>
                    <a  href="{{route('participate.edit',$event[0]->id)}}" ><button  class="submit">Participer </button></a>
     
    </div>	
    <div class="row pt-60">
      
    <div class="col-md-4">
      <div class="portfolio-meta">
        <ul>
         <li> <svg class="bi bi-calendar-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 2a2 2 0 012-2h12a2 2 0 012 2H0z"/>
            <path fill-rule="evenodd" d="M0 3h16v11a2 2 0 01-2 2H2a2 2 0 01-2-2V3zm6.5 4a1 1 0 100-2 1 1 0 000 2zm4-1a1 1 0 11-2 0 1 1 0 012 0zm2 1a1 1 0 100-2 1 1 0 000 2zm-8 2a1 1 0 11-2 0 1 1 0 012 0zm2 1a1 1 0 100-2 1 1 0 000 2zm4-1a1 1 0 11-2 0 1 1 0 012 0zm2 1a1 1 0 100-2 1 1 0 000 2zm-8 2a1 1 0 11-2 0 1 1 0 012 0zm2 1a1 1 0 100-2 1 1 0 000 2zm4-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
          </svg><span>{{__('    Date : ')}} </span> {{$event[1]->date}}  </li>
        <li><svg class="bi bi-clock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M16 8A8 8 0 110 8a8 8 0 0116 0zM8 3.5a.5.5 0 00-1 0V9a.5.5 0 00.252.434l3.5 2a.5.5 0 00.496-.868L8 8.71V3.5z" clip-rule="evenodd"/>
        </svg> <span>{{__('    Heure : ')}} </span> {{$event[1]->heure}} </li>
        <li> <svg class="bi bi-stopwatch-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M5.5.5A.5.5 0 016 0h4a.5.5 0 010 1H9v1.07A7.002 7.002 0 018 16 7 7 0 017 2.07V1H6a.5.5 0 01-.5-.5zm3 4.5a.5.5 0 00-1 0v3.5h-3a.5.5 0 000 1H8a.5.5 0 00.5-.5V5z" clip-rule="evenodd"/>
        </svg><span>{{__('   Durée: ')}} </span> {{$event[0]->duree}} </li>
        <li><svg class="bi bi-pause-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.5 3.5A1.5 1.5 0 017 5v6a1.5 1.5 0 01-3 0V5a1.5 1.5 0 011.5-1.5zm5 0A1.5 1.5 0 0112 5v6a1.5 1.5 0 01-3 0V5a1.5 1.5 0 011.5-1.5z"/>
        </svg><span>{{__('   Nombre De Pauses : ')}} </span> {{$event[0]->nb_pause}} </li>
        <li><svg class="bi bi-people-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 100-6 3 3 0 000 6zm-5.784 6A2.238 2.238 0 015 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 005 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" clip-rule="evenodd"/>
        </svg><span>{{__('    Nombre de place restant : ')}} </span> {{$event[2]}}</li>
          <li><svg class="bi bi-geo-alt" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 16s6-5.686 6-10A6 6 0 002 6c0 4.314 6 10 6 10zm0-7a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
        </svg><span>{{__('  Locale : ')}} </span> {{$event[1]->locale}} </li>
    <li> <svg class="bi bi-card-text" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 00-.5.5v9a.5.5 0 00.5.5h13a.5.5 0 00.5-.5v-9a.5.5 0 00-.5-.5zm-13-1A1.5 1.5 0 000 3.5v9A1.5 1.5 0 001.5 14h13a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0014.5 2h-13z" clip-rule="evenodd"/>
          <path fill-rule="evenodd" d="M3 5.5a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zM3 8a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9A.5.5 0 013 8zm0 2.5a.5.5 0 01.5-.5h6a.5.5 0 010 1h-6a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
        </svg>
        <span>{{__(' Plan : ')}}</span> {{ $event[0]->Plan}}   </li>
        
 </ul>
      </div>					
    </div>
    <div class="col-md-8">
      <div class="project-desc">
    <div class="text-center">
      
        <img src="{{URL::asset($event[4])}}" alt="Event" height="667" width="500"> 
      
    
    </div>
    </div>
       </div>
      </div>
    </div>
  </section>
  <footer class="footer-area ptb-80" style="background-color: rgb(141, 141, 141)">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="footer-style">
                    <div class="logo footer-logo">
            
            <div class="logo">
              <img src="{{ asset('img/logob.png') }}"width="140">
            </div>
            <p style="color:white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> labore et dolore magna aliqua</p>
          </div>
                        <ul>
                            <li><a href="#"><i class="social_facebook "></i></a></li>
                            <li><a href="#"><i class="social_twitter "></i></a></li>
                            <li><a href="#"><i class="social_googleplus "></i></a></li>
                            <li><a href="#"><i class="social_linkedin "></i></a></li>
                            <li><a href="#"><i class="social_pinterest "></i></a></li>
                        </ul>
                        <p class="adress" style="color:white"><i class="icon_house_alt "></i>Casablanca,Morroco</p>
                        <p style="color:white">Copyright@ 2020 <a href="#" style="color:white">Lorem.com</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
   
  
</body></html>
         
            
       @endsection

		
         
 
        
    

