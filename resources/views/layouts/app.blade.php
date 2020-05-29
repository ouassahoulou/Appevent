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
<link rel="icon" href="{!! asset('img/AMRST.ico') !!}"/>
    
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

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/share.js') }}"></script>

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5ec719e39d73fe001243bd17&product=image-share-buttons&cms=sop' async='async'></script>

</head>
<body>
    <header class="intelligent-header" >
        <div class="header-area" style="margin-top: -50px;" >
           
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" style="margin-bottom: 2rem !important;" href="{{ url('/') }}">
                            {{-- {{ config('app.name', 'Laravel') }} --}}
                            <div class="col-md-3 col-xs-12"  style="top: 25px;">
                                <div class="logo">
                                    <img src="{{ asset('img/logo.png') }}"width="140">
                                </div>
                            </div>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-top:62px">
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
                                        <li class="nav-item">
                                           <a href="{{ url('/home') }}" class="nav-link"> HOME </a> 
                                        </li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->nom }} <span class="caret"></span>
                                        </a>
        
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            
                                            <a class="dropdown-item" href="{{route('profil_admin',Auth::user()->id)}} "> {{__('Profil')}} </a>
                                            {{-- <a class="dropdown-item" href="{{route('profil_admin',Auth::user()->id)}} "> {{__(Auth::user()->nom)}} </a> --}}
        
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
            
        </div>
    </header>
    <div id="app">
        
        <div class="service-area pt-90 pb-50">
			

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
            
        </div>
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
