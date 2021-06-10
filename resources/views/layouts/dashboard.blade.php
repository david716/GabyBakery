<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
        

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" defer>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" defer>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" defer>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

        @yield('style')

        <link rel="preconnect" href="https://fonts.gstatic.com">
        
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

        <style>
            :root {
                --primary: #231c63;
                --light: #ffffff;
                --grey: #f1f1f1;
            }
            body {
                overflow: hidden;
                background: var(--grey) !important;
                font-family: 'Roboto', 'sans-serief';
                font-weight: 300;
                color: var(--primary);
            }
            a:hover {
                text-decoration: none;
            }
            .bg-primary { background-color: var(--primary) !important; }
            .bg-light { background-color: var(--light) !important; }
            .btn-search {
                right: 5px;
            }
            .avatar {
                max-width: 35px;
            }
            .content {
                overflow-y: auto;
                height: 100vh;
                padding: 5rem;
            }
            .scrollbar {
                margin-left: 30px;
                float: left;
                height: 300px;
                width: 65px;
                background: var(--primary);
                overflow-y: scroll;
                margin-bottom: 25px;
            }
            .force-overflow {
                min-height: 450px;
            }
            #sidedar-container {
                min-height: 100vh;
            }
            #sidedar-container.active {
                left: 0px;
            }
            #sidedar-container .logo {
                padding: .85rem 1.25rem;
            }
            #sidedar-container .menu {
                width: 18rem;
            }
            #img-logo {
                border: 1px solid;
                border-color: #000;
                border-radius: 50%;
                display: block;
                margin: 0 auto;
            }
            .items{
                padding: 15px 0px 10px 30px;
            }
        </style>

        <title>admin</title>

    </head>
    <body>

        <div class="d-flex">

            <div id="sidedar-container" class="bg-primary">

                <div class="logo">

                    <img 
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Logo gaby's bakery" 
                        id="img-logo" 
                        width="120px" 
                        height="120px"
                    >

                    <h4 class="text-light font-weight-bold" style="text-align: center; padding-top: 5px;"> Gaby's Bakery Shop </h4>

                </div>

                <div class="dropdown-divider"></div>

                <div class="menu">

                    <a href="" class="d-block items text-light"> <i class="bi bi-house-door-fill mr-2 lead"></i> Home </a>
                    <a href="{{ route('user.index') }}" class="d-block items text-light"> <i class="bi bi-people-fill mr-2 lead"></i> Usuarios </a>
                    <a href="{{ route('category.index') }}" class="d-block items text-light"> <i class="bi bi-list-stars mr-2 lead"></i> Categorias </a>
                    <a href="{{ route('products.index') }}" class="d-block items text-light"> <i class="bi bi-shop mr-2 lead"></i> Productos </a>
                    <a href="{{ route('decorations.index') }}" class="d-block items text-light"> <i class="bi bi-gift mr-2 lead"></i> Decoraciones </a>
                    <a href="{{ route('doughs.index') }}" class="d-block items text-light"> <i class="bi bi-distribute-vertical mr-2 lead"></i> Masas </a>
                    <a href="{{ route('fillers.index') }}" class="d-block items text-light"> <i class="bi bi-circle-half mr-2 lead"></i> Rellenos </a>
                    <a href="{{ route('cake_coverage.index') }}" class="d-block items text-light"> <i class="bi bi-circle-square mr-2 lead"></i> Cubiertas </a>
                    <a href="{{ route('invoices.index') }}" class="d-block items text-light"> <i class="bi bi-tags"></i> Facturas </a>

                </div>

            </div>

            <div class="w-100">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">

                    <div class="container">
                
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        
                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <form class="form-inline position-relative my-2 d-inline-block">

                            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">

                            <button class="btn btn-search position-absolute" type="submit"> <i class="bi bi-search"></i> </button>

                        </form>

                        <div class="container">

                            <a href={{ route('invoices.create') }} class="btn" type="submit"> <i class="bi bi-cart4 mr-2 lead"></i> </a>

                        </div>
                  
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            
                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item dropdown">
                                        
                                    <a class="nav-link dropdown-toggle navbar-brand" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <i class="bi bi-person-circle avatar mr-2"></i>

                                        Perfil

                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="#"> Perfil </a>

                                        <a class="dropdown-item" href="#"> Another action </a>

                                        <div class="dropdown-divider"></div>

                                        <a 
                                            class="dropdown-item" 
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                        >

                                            {{ __('Logout') }}
                                        
                                            <form
                                                id="logout-form" 
                                                action="{{ route('logout') }}" 
                                                method="POST" 
                                                class="d-none"
                                            >

                                                @csrf
                                            
                                            </form>
                    
                                        </a>

                                    </div>

                                </li>
                            </ul>

                        </div>

                    </div>

                </nav>

                <!--<div class="container" style="overflow: hidden; overflow-y: scroll; max-height: 90vh;">-->

                    <div class="container">

                        <div class="row">
        
                            <div class="py-4 col-12 ">
        
                                @yield('botones')
        
                            </div>
                            
                        </div>
        
                    </div>
        
                    <main class="py-4">
    
                        @yield('content')
                        
                    </main>
                
               <!-- </div>-->

            </div>

        </div>

        @yield('scripts')

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js" defer></script>
        <script src="" defer></script>

        <script>

            $(document).ready( function () {

                $('#myTable').DataTable();

            } );
            
        </script>
        
    </body>
</html>