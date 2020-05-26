<!doctype html>
<html class="no-js" lang="zxx">
    <head>
		<meta charset="utf-8">
		<link rel="icon" href="{!! asset('img/AMRST.ico') !!}"/>
       <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/eleganticons-fonts.css">
        <link rel="stylesheet" href="css/shortcode/shortcodes.css">
         </head>
    <body>
		
		<header class="intelligent-header">
			<div class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<div class="logo">
								<img src="{{ asset('img/logo.png') }}"width="140">
							</div>
						</div>
						<div class="col-md-9 col-xs-12">
							<div class="main-menu text-right">
								<nav>
									<ul class="menu">
										
										@if (Route::has('login'))
										
											  
										  
											  @auth
												 <li> <a class="active" href="{{ url('/home') }}"><strong>Admin Home Page<strong></a><li>
							  
												@else
												 <li>  <a class="active"href="{{ route('login') }}"><strong>Login</strong></a></li>
		  
													  @if (Route::has('register'))
														 <li> <a class="active" href="{{ route('register') }}"><strong>Register</strong></a></li>
								  
													   @endif
												 @endauth
										  
									 @endif
				  
									</ul>
								</nav>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="slider gray-bg slider-bg-3 ptb-150">
			<div class="container">
				<div class="slider-info-text slider-text-style-3 text-center">
					<div class="info-inner">
						<h2 class="page-title" style="color:#0e60b7e0;">Application Web</h2>
						<span>Lorem ipsum dolor sit amet consectetur .</span>				
					</div>
				</div>			
			</div>
		</div>
		
		<div class="service-area pt-90 pb-50">
			<div class="container">
				@include('inc.messages')
				<div class="row">
					@foreach ($evenements[0] as $evenement)
					    @foreach ($evenements[1] as $generation)
						   @if ($evenement->id==$generation->id_evenement)
						    @if ($generation->date > date('Y-m-d'))
					                <div class="col-md-4 col-sm-6">
						                <div class="single-service white-bg text-center">
							               <h2>{{$generation->titre}}</h2>
							                <h3>{{$generation->date}}</h3>
											   <h4><strong>{{__('Heure:')}}</strong>	{{$generation->heure}} </h4>
											   <h4><strong>{{__('Type: ')}}</strong>	{{$evenement->type}} </h4>
							                 <br><h5 ><a href="{{Route('home_detail',$evenement->id)}}" style="color:#0e60b7e0;">{{__('Pour Plus de Details')}}</a></h5>
								            {{-- <a class="submit" href="{{route('participate.edit',$evenement->id)}}" role="button">Participer  </a> --}}
								         </div>
									 </div> 
							 @endif                                                 
			                @endif
                      @endforeach
	              @endforeach
				</div>
			</div>
		</div>
		
			
		<div class="justify-content-center" style="padding-left: 600px;"  >
            {{$evenements[0]->links()}}
        </div>
		
    </body>
</html>

						
		
		