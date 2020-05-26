<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- CSSSSS&SHORTCODES -->
    <link  rel="stylesheet" href="{{ asset('css/app.css') }}" >
<link  rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" >
<link  rel="stylesheet" href="{{ asset('css/shortcode/breadcrumb.css') }}" >
<link  rel="stylesheet" href="{{ asset('css/shortcode/default.css') }}" >
<link  rel="stylesheet" href="{{ asset('css/shortcode/service.css') }}" >
<link  rel="stylesheet" href="{{ asset('css/shortcode/shortcodes.css') }}" >
<link  rel="stylesheet" href="{{ asset('css/shortcode/blog.css') }}" >
    
    <!-- CSRF Token -->




    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        html {
    height: 100%;
}
body {
	
    background-size: 120% auto;
    position: fixed;
	padding: 0px;
	margin: 0px;
	width: 100%;
	height: 100%;
	font: normal 14px/1.618em "Roboto", sans-serif;
	-webkit-font-smoothing: antialiased;
}
body:before {
    content: "";
    height: 0px;
    padding: 0px;
    border: 110em solid #5473ee;
	position: absolute;
	left: 50%;
	top: 100%;
    z-index: 2;
    display: block;
    -webkit-border-radius: 50%;
    border-radius: 50%;
	-webkit-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
    -webkit-animation: puff_portrait 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
    animation: puff_portrait 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
}
h1, h2 {
    font-weight: 400;
    margin: 0px 0px 5px 0px;
}
h1 {
    font-size: 24px;
}
h2 {
    font-size: 16px;
}
p {
    margin: 0px;
}
.profile-card {
	background: rgb(5, 1, 29);
	width: 56px;
	height: 56px;
	position: absolute;
	left: 50%;
	top: 50%;
    z-index: 2;
	overflow: hidden;
    opacity: 0;
    margin-top: 70px;
	-webkit-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	-webkit-border-radius: 50%;
	border-radius: 50%;
	-webkit-box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
	box-shadow: 0px 3px 6px rgba(0 ,0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
    -webkit-animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_landscape 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
    animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_landscape 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
}
.profile-card header {
    width: 179px;
    height: 280px;
    padding: 40px 20px 30px 20px;
    display: inline-block;
    float: left;
    border-right: 2px dashed #EEEEEE;
	background: #FFFFFF;
    color: #000000;
    margin-top: 50px;
    opacity: 0;
    text-align: center;
    -webkit-animation: moveIn 1s 3.1s ease forwards;
    animation: moveIn 1s 3.1s ease forwards;
}
.profile-card header h1 {
    color: rgb(9, 0, 105);
}
.profile-card header a {
    display: inline-block;
    text-align: center;
    position: relative;
    margin: 25px 30px;
}
.profile-card header a:after {
	position: absolute;
    content: "";
	bottom: 3px;
	right: 3px;
	width: 20px;
	height: 20px;
    border: 4px solid #FFFFFF;
    -webkit-transform: scale(0);
    transform: scale(0);
    background: -webkit-linear-gradient(top, #2196F3 0%, #2196F3 50%, #FFC107 50%, #FFC107 100%);
    background: linear-gradient(#2196F3 0%, #2196F3 50%, #FFC107 50%, #FFC107 100%);
    -webkit-border-radius: 50%;
    border-radius: 50%;
    -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
    -webkit-animation: scaleIn 0.3s 3.5s ease forwards;
    animation: scaleIn 0.3s 3.5s ease forwards;
}
.profile-card header a > img {
    width: 120px;
    max-width: 100%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    -webkit-transition: -webkit-box-shadow 0.3s ease;
    transition: box-shadow 0.3s ease;
    -webkit-box-shadow: 0px 0px 0px 8px rgba(0, 0, 0, 0.06);
    box-shadow: 0px 0px 0px 8px rgba(0, 0, 0, 0.06);
}
.profile-card header a:hover > img {
    -webkit-box-shadow: 0px 0px 0px 12px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 0px 12px rgba(0, 0, 0, 0.1);
}
.profile-card .profile-bio {
    width: 175px;        
    height: 180px;
    display: inline-block;
    float: right;
    padding: 50px 20px 30px 20px;
	background: #FFFFFF;
    color: #333333;
    margin-top: 50px;
    text-align: center;
    opacity: 0;
    -webkit-animation: moveIn 1s 3.1s ease forwards;
    animation: moveIn 1s 3.1s ease forwards;
}
.profile-social-links {
    width: 218px;        
    display: inline-block;
    float: right;
    margin: 0px;
    padding: 15px 20px;
	background: #FFFFFF;
    margin-top: 50px;
    text-align: center;
    opacity: 0;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-animation: moveIn 1s 3.1s ease forwards;
    animation: moveIn 1s 3.1s ease forwards;
}
.profile-social-links li {
    list-style: none;
    margin: -5px 0px 0px 0px;
    padding: 0px;
    float: left;
    width: 33.3%;
    text-align: center;
}
.profile-social-links li a {
    display: inline-block;
    width: 24px;
    height: 24px;
    padding: 6px;
    position: relative;
    overflow: hidden!important;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.profile-social-links li a img {
    position: relative;
    z-index: 1;
}
.profile-social-links li a:before {
    display: block;
    content: "";
    background: rgba(0, 0, 0, 0.3);
    position: absolute;
    left: 0px;
    top: 0px;
    width: 36px;
    height: 36px;
    opacity: 1;
    -webkit-transition: transform 0.4s ease, opacity 1s ease-out;
    transition: transform 0.4s ease, opacity 1s ease-out;
    -webkit-transform: scale3d(0, 0, 1);
    transform: scale3d(0, 0, 1);
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.profile-social-links li a:hover:before {
    -webkit-animation: ripple 1s ease forwards;
    animation: ripple 1s ease forwards;
}
.profile-social-links li a img,
.profile-social-links li a svg {
    width: 24px;
}


@media screen and (min-aspect-ratio: 4/3) {
    body {
        background-size: 100% auto;
    }
    body:before {
        width: 0px;
    }
    @-webkit-keyframes puff {
        0% {
            top: 100%;
            width: 0px;
            padding-bottom: 0px;
        }
    	100% {
            top: 50%;
            width: 100%;
            padding-bottom: 100%;
        }	
    }
    @keyframes puff {
        0% {
            top: 100%;
            width: 0px;
            padding-bottom: 0px;
        }
    	100% {
            top: 50%;
            width: 100%;
            padding-bottom: 100%;
        }	
    }
}
@media screen and (min-height: 480px) {
	.profile-card {
		-webkit-animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_portrait 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
		animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_portrait 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
	}
	.profile-card header {
        width: auto;
        height: auto;
        padding: 30px 20px;
        display: block;
        float: none;
        border-right: none;
    }
    .profile-card .profile-bio {
        width: auto;
        height: auto;
        padding: 15px 20px 30px 20px;
        display: block;
        float: none; 
    }
    .profile-social-links {
        width: 100%;       
        display: block;
        float: none; 
    }
}
@media screen and (min-aspect-ratio: 4/3) {
    body {
        background-size: 100% auto;
    }
    body:before {
        width: 0px;
		-webkit-animation: puff_landscape 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
		animation: puff_landscape 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
	}
}
@-webkit-keyframes init {
    0% {
    	width: 0px;
    	height: 0px;
    }
	100% {
        width: 56px;
        height: 56px;
        margin-top: 0px;
        opacity: 1;
    }	
}
@keyframes init {
    0% {
    	width: 0px;
    	height: 0px;
    }
	100% {
        width: 56px;
        height: 56px;
        margin-top: 0px;
        opacity: 1;
    }	
}
@-webkit-keyframes puff_portrait {
    0% {
        top: 100%;
        height: 0px;
        padding: 0px;
    }
	100% {
        top: 50%;
        height: 100%;
        padding: 0px 100%;
    }	
}
@keyframes puff_portrait {
    0% {
        top: 100%;
        height: 0px;
        padding: 0px;
    }
	100% {
        top: 50%;
        height: 100%;
        padding: 0px 100%;
    }	
}
@-webkit-keyframes puff_landscape {
	0% {
		top: 100%;
		width: 0px;
		padding-bottom: 0px;
	}
	100% {
		top: 50%;
		width: 100%;
		padding-bottom: 100%;
	}	
}
@keyframes puff_landscape {
	0% {
		top: 100%;
		width: 0px;
		padding-bottom: 0px;
	}
	100% {
		top: 50%;
		width: 100%;
		padding-bottom: 100%;
	}	
}
@-webkit-keyframes borderRadius {
    0% {
        -webkit-border-radius: 50%;
    }
	100% {
        -webkit-border-radius: 0px;
    }	
}
@keyframes borderRadius {
    0% {
        -webkit-border-radius: 50%;
    }
	100% {
        border-radius: 0px;
    }	
}
@-webkit-keyframes moveDown {
    0% {
   	    top: 50%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 100%;
    }	
}
@keyframes moveDown {
    0% {
   	    top: 50%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 100%;
    }	
}
@-webkit-keyframes moveUp {
    0% {
        background: #FFB300;
        top: 100%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 50%;
       background: #E0E0E0;
    }	
}
@keyframes moveUp {
    0% {
        background: #FFB300;
        top: 100%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 50%;
       background: #E0E0E0;
    }	
}
@-webkit-keyframes materia_landscape {
    0% {
        background: #E0E0E0;
    }
    50% {
        -webkit-border-radius: 4px;
    }
    100% {
        width: 440px;
        height: 280px;
        background: #FFFFFF;
        -webkit-border-radius: 4px;
    }
}
@keyframes materia_landscape {
    0% {
        background: #E0E0E0;
    }
    50% {
        border-radius: 4px;
    }
    100% {
        width: 440px;
        height: 280px;
        background: #FFFFFF;
        border-radius: 4px;
    }
}
@-webkit-keyframes materia_portrait {
	0% {
		background: #E0E0E0;
	}
	50% {
		-webkit-border-radius: 4px;
	}
	100% {
		width: 280px;
		height: 440px;
		background: #FFFFFF;
		-webkit-border-radius: 4px;
	}
}
@keyframes materia_portrait {
	0% {
		background: #E0E0E0;
	}
	50% {
		border-radius: 4px;
	}
	100% {
		width: 280px;
		height: 390px;
		background: #FFFFFF;
		border-radius: 4px;
	}
}
@-webkit-keyframes moveIn {
    0% {
        margin-top: 50px;
        opacity: 0;
    }
	100% { 
        opacity: 1;
        margin-top: -20px;
    }	
}
@keyframes moveIn {
    0% {
        margin-top: 50px;
        opacity: 0;
    }
	100% { 
        opacity: 1;
        margin-top: -20px;
    }	
}
@-webkit-keyframes scaleIn {
    0% {
        -webkit-transform: scale(0);
    }
	100% { 
        -webkit-transform: scale(1);
    }	
}
@keyframes scaleIn {
    0% {
        transform: scale(0);
    }
	100% { 
        transform: scale(1);
    }	
}
@-webkit-keyframes ripple {
    0% {
        transform: scale3d(0, 0, 0); 
    }
    50%, 100% {
        -webkit-transform: scale3d(1, 1, 1);
    }
    100% {
        opacity: 0;
    }
}
@keyframes ripple {
    0% {
        transform: scale3d(0, 0, 0); 
    }
    50%, 100% {
        transform: scale3d(1, 1, 1);
    }
    100% {
        opacity: 0;
    }
}
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    {{-- <a class="dropdown-item" href="{{route('profil_admin',Auth::user()->id)}} "> {{__('Profil')}} </a> --}}
                                    <a class="dropdown-item" href="{{route('profil_admin',Auth::user()->id)}} "> {{__(Auth::user()->nom)}} </a>

                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @stack('scripts')
</body>
</html>
