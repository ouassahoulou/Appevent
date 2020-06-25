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
    <link  rel="stylesheet" href="{{ asset('css/app.css') }}" >

    <link  rel="stylesheet" href="{{ asset('css/shortcode/breadcrumb.css') }}" >
    <link  rel="stylesheet" href="{{ asset('css/shortcode/header.css') }}" >
    <link  rel="stylesheet" href="{{ asset('css/shortcode/default.css') }}" >
	<link  rel="stylesheet" href="{{ asset('css/shortcode/service.css') }}" >
	<link  rel="stylesheet" href="{{ asset('css/shortcode/blog.css') }}" >
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
	<link rel="stylesheet" href="{{ asset('css/eleganticons-fonts.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" >
	<link rel="stylesheet"href="{{ asset('css/shortcode/footer.css') }}" >
	<link rel="stylesheet"  href="{{ asset('css/iofrm-style.css') }}" >
    <link rel="stylesheet"  href="{{ asset('css/iofrm-theme10.css') }}" >
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
											<li><a class="active" href="{{ url('/') }}"><strong>Accueil<strong></a></li>
										@if (Route::has('login'))
										
											  
										  
											  @auth
												 <li> <a class="active" href="{{ url('/home') }}"><strong>Admin Home Page<strong></a></li>
							  
												@else
													@if (!Route::is('login'))
													<li>  <a class="active"href="{{ route('login') }}"><strong>Login</strong></a></li>
													@endif
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
		
           
        
		@include('inc.messages')
		@yield('content')
		
        <script src="{{ asset('js/vendor/jquery-1.12.0.min.js') }}"></script>
	
		<script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
	
		<script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>