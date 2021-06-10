<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Administrador') }}</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app_admin.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" defer>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" defer>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
    </head>
    <body>
    
    @yield('style')
        <div id="mySidebar" class="sidebar" style="width: 240px;">     
            <div style="background-color: #367fa9;">
                <a style="padding: 9.5px !important;" href="{{ route('home') }}" class="navbar-brand">
                    <img src="{{ asset('images/logo.jpg') }}" width="30" height="30" alt="Logo" class="img-logo"><span style="color: #fff; font-size: 20px;"> Gaby's Bakery</span>
                </a>
            </div>    
            <a href="{{ url('/admin') }}" class="nav-link"> <i class="bi bi-house-door-fill mr-2 lead"></i> Home </a>
            <a href="{{ route('user.index') }}" class="nav-link"> <i class="bi bi-people-fill mr-2 lead"></i> Usuarios </a>
            <a href="{{ route('products.index') }}" class="nav-link"> <i class="bi bi-shop mr-2 lead"></i> Productos </a>
            <a href="{{ route('category.index') }}" class="nav-link"> <i class="bi bi-list-stars mr-2 lead"></i> Categorias </a>
            <a href="{{ route('doughs.index') }}" class="nav-link"> <i class="bi bi-distribute-vertical mr-2 lead"></i> Masas </a>
            <a href="{{ route('fillers.index') }}" class="nav-link"> <i class="bi bi-circle-half mr-2 lead"></i> Rellenos </a>
            <a href="{{ route('cake_coverage.index') }}" class="nav-link"> <i class="bi bi-circle-square mr-2 lead"></i> Cubiertas </a>
            <a href="{{ route('toppers.index') }}" class="nav-link"> <i class="bi bi-award mr-2 lead"></i>  Toppers </a>
            <a href="{{ route('extras.index') }}" class="nav-link"> <i class="bi bi-gift mr-2 lead"></i> Extras </a>
            <a href="{{ route('invoices.index') }}" class="nav-link"> <i class="bi bi-tags mr-2 lead"></i> Facturas </a>
            <a id="calendario" href="{{ route('invoices.calendar') }}" class="nav-link"> <i class="bi bi-calendar mr-2 lead"></i> Calendario </a>
        </div>

        <div id="main" style="margin-left:240px; padding: 0;">
            <nav class="navbar navbar-expand-lg navbar-dark  sticky-top" style=" background-color: #3c8dbc;">
                <a class="navbar-brand" href="#"></a>
                <button id="btn" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item menu">
                            <a id="btn-mostrar" class="nav-link"  onclick="openNav()"  style="display: none; color: #fff;"><i class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item menu">
                            <a id="btn-ocultar" class="nav-link"  onclick="closeNav()" style="color: #fff;"><i class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item perfil-usuario">
                            <div class="dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #fff;"><i class="fas fa-user-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"> 
                                    <a class="dropdown-item" href="#">Perfil de usuario</a>
                                    <a class="dropdown-item" href="{{ route('role.index') }}">Roles</a>
                                    <a class="dropdown-item" href="{{ route('permission.index') }}">Permisos</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                        {{ __('Salir') }}
                                        <form id="logout-form"  action="{{ route('logout') }}"  method="POST"  class="d-none" >
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="py-4 col-12 ">
                    @yield('content')  
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
        <script src="{{ asset('js/admin/admin.js') }}" defer></script>
        <script src="{{ asset('js/admin/category.js') }}" defer></script>
        <script src="{{ asset('js/admin/coverage.js') }}" defer></script>
        <script src="{{ asset('js/admin/doug.js') }}" defer></script>
        <script src="{{ asset('js/admin/events.js') }}" defer></script>
        <script src="{{ asset('js/admin/extra.js') }}" defer></script>
        <script src="{{ asset('js/admin/filler.js') }}" defer></script>
        <script src="{{ asset('js/admin/invoice.js') }}" defer></script>
        <script src="{{ asset('js/admin/product.js') }}" defer></script>
        <script src="{{ asset('js/admin/roles_permisos.js') }}" defer></script>
        <script src="{{ asset('js/admin/topper.js') }}" defer></script>
        <script src="{{ asset('js/admin/weigth.js') }}" defer></script>
        @yield('scripts')
    </body>
</html>
