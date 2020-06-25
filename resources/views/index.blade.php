<!DOCTYPE html>

        <html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8"> 
    <title>AMPRST</title>
    <link rel="icon" href="{!! asset('img/AMRST.ico') !!}"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"href="{{ asset('css/meanmenu.css') }}" >
    <link  rel="stylesheet" href="{{ asset('css/shortcode/slider.css') }}" >
    <link  rel="stylesheet" href="{{ asset('css/shortcode/portfolio.css') }}" >
    

	<link  rel="stylesheet" href="{{ asset('css/shortcode/shortcodes.css') }}" > 
     <link  rel="stylesheet" href="{{ asset('css/shortcode/header.css') }}" >
     <link  rel="stylesheet" href="{{ asset('css/shortcode/default.css') }}" >
	<link  rel="stylesheet" href="{{ asset('css/shortcode/service.css') }}" >
	<link  rel="stylesheet" href="{{ asset('css/shortcode/blog.css') }}" >
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
	<link rel="stylesheet" href="{{ asset('css/eleganticons-fonts.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" >
	<link rel="stylesheet"href="{{ asset('css/shortcode/footer.css') }}" >
	<link rel="stylesheet"href="{{ asset('css/shortcode/slider.css') }}" >
	{{-- <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/eleganticons-fonts.css">
	<link rel="stylesheet" href="css/shortcode/shortcodes.css">
	 --}}
	
    </head>
   
    <body>
<header class="intelligent-header">
			<div class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<div class="logo"><a class="active" href="{{ url('/') }}">
								<img src="{{ asset('img/logo.png') }}"width="140">
							</div>
						</div>
						<div class="col-md-9 col-xs-12">
							<div class="main-menu text-right">
								<nav>
									<ul class="menu">
										@if (Route::has('login'))
											  @auth
												 <li> <a class="active" href="{{ url('/home') }}"><strong>Admin Home Page<strong></a></li>
							  
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
							<div class="mobile-menu"></div>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<div class="slider gray-bg slider-bg-3 ptb-150">@include('inc.messages')
			<div class="container">
				<div class="slider-info-text slider-text-style-3 text-center">
					<div class="info-inner">
						<h2 class="page-title" style="color:#0e60b7e0;">Application Web</h2>
						<span>Lorem ipsum dolor sit amet consectetur .</span>				
					</div>
				</div>			
			</div>
		</div>
		<br><br><br>
		<div class="container">
			<form action="{{route('search_index')}}" method="get" role="search">
				{{ csrf_field() }}
				<div class="input-group">
					
							<input type="text" class="form-control" name="search" placeholder=" Titre de l'évenement" style="font-size: 12px; height: 30px; border-radius: 7px;" required> 
						
						
							<span class="input-group-btn"> 
								<button class="btn btn-light"   type="submit" style="margin-left: 4px; border-radius: 6px;">Search</button>
							</span>
						
				</div>
			</form>
		</div><br><br>
		
		<div class="service-area pt-90 pb-50">
			<div class="container">
				
				<div class="row">
					@foreach ($evenements[0] as $evenement)
					    @foreach ($evenements[1] as $generation)
						   @if ($evenement->id==$generation->id_evenement)
						    
					                <div class="col-md-4 col-sm-6">
						                <div class="single-service white-bg text-center">
							               <h2>{{$generation->titre}}</h2>
							                <h3>{{$generation->date}}</h3>
											   <h4><strong>{{__('Heure:')}}</strong>	{{$generation->heure}} </h4>
											   <h4><strong>{{__('Type: ')}}</strong>	{{$evenement->type}} </h4>
							                 <br><h5 ><a href="{{Route('home_detail',$evenement->id)}}" style="color:#0e60b7e0;">{{__('Pour Plus de Details')}}</a></h5>
								         </div>
									 </div> 
							                                                
			                @endif
                      @endforeach
	              @endforeach
				</div>
			</div>
		</div>
		
		<div class="justify-content-center" style=" display:table;
		margin:0 auto;"  >
			{{$evenements[0]->links()}}
				</div> 
				
			   
			
		
		
			
		
		<br>
		<footer class="footer-area ptb-80" style="background-color: rgb(141, 141, 141)">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12 text-center">
		                <div class="footer-style">
		                    <div class="logo footer-logo">
								
								<div class="logo"  >
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
		
	
       
       
   
        <script src="{{ asset('js/vendor/jquery-1.12.0.min.js') }}"></script>
	
		<script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
	
		<script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>

           
	

	
		