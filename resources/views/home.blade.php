@extends('layouts.app')
@section('content')
<a id="app-whatsapp" class="nav-brand"  target="_blanck" href="https://api.whatsapp.com/send?phone=573022680398&amp;text=Hola me puedes ayudar?">
    <i class="fab fa-whatsapp"></i>
</a>
<a id="app-instagram" class="nav-brand"  target="_blanck" href="https://www.instagram.com/gabybakeshop/">
    <i class="fab fa-instagram"></i>
</a>
<div class="container-fluid">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExbampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($last_products as $item)
                @if ($loop->first)
                    <div class="carousel-item active">
                @else
                    <div class="carousel-item">
                @endif
                        <div class="container-fluid">
                            <div class="card">
                                <img src="{{ asset($item->images) }}" class="img-fondo">
                                <div class="card-img-overlay">
                                    <div class="card-deck">
                                        <div class="card">
                                            <div class="card-body quitar-padding">
                                                <a role="button" data-toggle="modal" data-target="#myModal" onclick='modal("{{$item->images}}","{{$item->product_name}}","{{$item->description}}", "{{$item->product_type_id}}", "{{$item->id}}")'><img src="{{ asset($item->images) }}" class="img-producto-carrusel"></a>
                                            </div>
                                        </div>
                                        <div class="card info-producto quitar-fondo">
                                            <div class="card-body text-left quitar-padding" style="background-color: #f8fafc7a;
                                                background-image: linear-gradient(to right bottom, #f8fafca1, #495057b8);">
                                                <div class="card-header nombre-producto-carrusel">
                                                    {{ $item->product_name }} 
                                                </div>
                                                <div class="card-body detalle-producto-carrusel">
                                                    <p>
                                                        {{ Str::words($item->description, 40)}}
                                                    </p>
                                                </div>
                                                <div class="card-footer quitar-fondo">
                                                    <center>
                                                        <a class="btn btn-lg btn-detalle" role="button" data-toggle="modal" data-target="#myModal" onclick='modal("{{$item->images}}","{{$item->product_name}}","{{$item->description}}", "{{$item->product_type_id}}", "{{$item->id}}")'> Ver Detalle </a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
        </div>
    </div>

    <div class="container">
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-xl" style="margin-top: 70px;">
                <div class="modal-content"> 
                    <div class="container-fluid contenedor-modal" style="background-image: linear-gradient(to bottom right, rgba(66, 142, 255, 0.226), rgba(0, 255, 98, 0.37));">
                        <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times-circle" style="color: red; margin-top: 5px;"></i></button>
                        <div class="card-deck detalles-productos" style="padding:40px 0px 80px 0px; ">
                            <div class="card">
                                <div class="card-body" style="padding: 0px;">
                                    <img id="imagen" width="100%" height="100%">
                                </div>
                            </div>
                            <div class="card" style="background: none; border: none;">
                                <div class="card-body text-left" style="padding: 0px;">
                                    <div id="titulo" class="card-header" style="background: none; font-weight: bold; font-size: 25px;"></div>
                                    <div class="card-body" style="background: none; border: none;">
                                        <p id="informacion"></p>
                                    </div>
                                    <div class="card-footer" style="background: none; border: none;">
                                        <!--<center>
                                            <a class="btn btn-sm btn-reserva" role="button" data-toggle="modal" data-target="#myModal"> Realizar Reserva </a>
                                        </center>-->
                                        <div class="row" id="botones">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid productos">
        <center><h3 class="titulo-catalogo">Catalogo de productos</h3></center>
        <hr>
        @if(!empty($products))
            <div class="album">
                <div class="row">
                    @foreach($products as $item)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow quitar-fondo">
                                <a role="button" data-toggle="modal" data-target="#myModal" onclick='modal("{{$item->images}}","{{$item->product_name}}","{{$item->description}}", "{{$item->product_type_id}}", "{{$item->id}}")'><img class="card-img-top" src="{{ asset($item->images) }}" height="240"></a>
                                    <div class="card-body info-productos-catalogo">
                                        <div class="text-center nombre-producto-catalogo">
                                            {{ $item->product_name }} 
                                        </div>
                                        <!--<p> {{ $item->description }} </p>-->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                @if ($item->product_type_id != 1)
                                                    <!--<a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('home.customizeE', $item->id) }}" style="padding-top: 5px;">Personalizar</a>-->
                                                    @if(Auth::user())    
                                                        <a type="button" class="btn btn-sm btn-outline-secondary personalizar" href="{{ route('date') }}" onclick="cargar_id('{{$item->id}}'), cargar_estado_perzonalizar(1)" style="padding-top: 5px;">Personalizar</a>
                                                    @endif
                                                @endif
                                                    <a type="button" class="btn btn-sm btn-outline-secondary comprar" href="{{ route('date') }}" onclick="cargar_id('{{$item->id}}'), cargar_estado_comprar(1)">Comprar</a>
                                            </div>
                                            <div>
                                                <small class="text-muted">
                                                    <span class="precio"> {{ '$ ' . $item->total_value }} </span>
                                                </small>
                                            </div>
                                        </div>
                                        <small class="text-muted estrellas text-center">
                                            @for ($i = 0; $i < $item->rating; $i++)
                                                <span><i class="fas fa-star star"></i></span> 
                                            @endfor
                                        </small>
                                    </div>
                            </div>
                        </div>  
                    @endforeach
                </div>
        @else
            <center>
                <span> <i class="fas fa-exclamation-triangle"></i> No hay productos disponibles </span>
            </center>
        @endif
            </div>
            <div class="mx-auto" style="width: 200px;">
                {{ $products->links() }}
            </div>
    </div>
</div>
@endsection