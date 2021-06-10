<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personalizar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" defer>
    <script src="https://cdn.babylonjs.com/babylon.js"></script>
    <script src="https://cdn.babylonjs.com/loaders/babylonjs.loaders.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
    <!-- Start of Async Callbell Code -->
<script>
  window.callbellSettings = {
    token: "iUh8Nge8ozN1jkCU2jpEfHaq"
  };
</script>
<script>
</script>
<!-- End of Async Callbell Code -->

</head>
<style>
    body{
            background-color: #f1f1f1;
        }
</style>
@yield('style')
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md nav fixed-top">
        @if(Auth::user())
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" width="45" height="45" alt="Logo" class="d-inline-block align-top logo">
            </a>
            <a id="inicio" class="navbar-brand" href="{{ route('home') }}"><h4 class="titulo">Gaby's Bakery</h4></a>
            <div>
                <button id="btn"class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class="fas fa-bars fa-2x btn-menu"></i>
                </button>
            </div>
        @else
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.jpg') }}" width="45" height="45" alt="Logo" class="d-inline-block align-top logo">
            </a>
            <a id="inicio" class="navbar-brand" href="{{ url('/') }}"><h4 class="titulo">Gaby's Bakery</h4></a>
            <div>
                <button id="btn"class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class="fas fa-bars fa-2x btn-menu"></i>
                </button>
            </div>
        @endif
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    @if(Auth::user())
                        @if(Route::currentRouteName() == 'home')
                            <li class="nav-item dropdown">
                                <!-- <a class="nav-link categoria" href="{{ route('home.customize') }}"> <span><i class="fas fa-birthday-cake"></i></span> Personalizar Producto</a>-->
                            <a class="nav-link categoria" href="{{ route('date') }}" onclick="cargar_estado_perzonalizar_2(1)"> <span><i class="fas fa-birthday-cake"></i></span> Personalizar Producto</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link categoria" href="#" id="navbardrop" data-toggle="dropdown"><span><i class="fas fa-list-ol"></i></span> Categorias</a>
                                <div class="dropdown-menu">
                                    @foreach ($category as $item)
                                        <a class="dropdown-item" value="{{ $item->id }}" href="{{ route ('home', $item->id) }}">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endif
                    <li class="nav-item dropdown">
                        <a  id="boton" class="nav-link" href="#" id="navbardrop" data-toggle="dropdown"><i class="fas fa-bars fa-2x btn-menu"></i></a>
                        <a id="letra" class="nav-link categoria" href="#" id="navbardrop" data-toggle="dropdown" style="display: none;">Menu</a>
                        <div class="dropdown-menu dropdown-menu-right"> 
                            @if( !Auth::user() )
                                <a class="dropdown-item" href="{{ route('login') }}">Iniciar Sesion</a>
                                <a class="dropdown-item" href="{{ route('register') }}">Registrarse</a>
                            @endif
                            @if(Auth::user())
                                <a class="dropdown-item" href="{{ route('invoice', auth()->user()->id) }}">Lista de Facturas</a>
                                @if( Auth::user()->hasPermissionTo('Acceso_Panel_Admin'))
                                    <a class="dropdown-item" href="{{ route('admin') }}">Panel Administrativo</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </nav> 
        <div class="container-fluid cont">
                @yield('content')
        </div>
    </div>
   
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
    <script src="{{ asset('js/home/custom_product.js') }}" defer></script>
    <script src="{{ asset('js/home/home.js') }}" defer></script>
</body>
</html>
