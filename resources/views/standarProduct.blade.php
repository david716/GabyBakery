@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card-deck">
        @foreach($product as $item)
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <h2><label for="exampleFormControlInput1" class="form-label d-block p-3">{{ $item->product_name }}</label></h2>
                        <div class="row">
                            <div class="col">
                                <div class="card box-shadow">
                                    <img class="card-img-top" src="{{ asset($item->images) }}">
                                </div>
                            </div>  
                        </div>
                        <h4><label for="exampleFormControlInput1" class="form-label d-block p-3">{{ $item->description }}</label></h4>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product_custom') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id"  id="user_id" value="{{auth()->user()->id}}" readonly>
                        <input type="hidden" name="product_id" id="product_id" value="{{ $item->id }}">
                        <input type="hidden" name="purchase_date" id="purchase_date">
                        <input type="hidden" name="purchase_hour" id="purchase_hour">
                        <input type="hidden" name="delivery_date" id="delivery_date">
                        <input type="hidden" name="delivery_hour" id="delivery_hour">
                        <input type="hidden" name="estado_id" id="estado_id">
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Nombre del producto</label>
                                <input type="text" value="{{ $item->product_name }}" class="form-control"  placeholder="nombre del producto" required readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Tipo Producto</label>
                                <input  type="text" class="form-control" value="{{ $item->product_type }}" required readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Categoria</label>
                                <input type="text" value="{{ $item->category }}"  class="form-control"  placeholder="Categoria" required readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Porciones</label>
                                <input type="text" value="{{ $item->slice }}"  class="form-control"  placeholder="Rodajas" required readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label data-width="auto">Peso</label>
                                <input type="text" value="{{ $item->weight }}"  class="form-control"  placeholder="Peso" required readonly>
                            </div>
                        </div>    
                        <br>
                        @if($item->weight_id == 1)
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Cubierta</label>
                                    <input type="text" value="{{ $item->coverage }}"  class="form-control"  placeholder="Cubierta" required readonly>                            
                                </div>
                                <div class="col">
                                    <label data-width="auto">Masa 1 y 2</label>
                                    <input type="text" value="{{ $item->dough_1_2 }}"  class="form-control"  placeholder="Masa 1 y 2" required readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Masa 3 y 4</label>
                                    <input type="text" value="{{ $item->dough_3_4 }}"  class="form-control"  placeholder="Masa 3 y 4" required readonly>
                                </div>
                                <div class="col">
                                    <label data-width="auto">Relleno</label>
                                    <input type="text" value="{{ $item->filler }}"  class="form-control"  placeholder="Relleno" required readonly>
                                </div>
                            </div>    
                        @else
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Cubierta</label>
                                    <input type="text" value="{{ $item->coverage }}"  class="form-control"  placeholder="Cubierta" required readonly>
                                </div>
                                <div class="col">
                                    <label data-width="auto">Masa</label>
                                    <input type="text" value="{{ $item->dough }}"  class="form-control"  placeholder="Masa" required readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Relleno 1</label>
                                    <input type="text" value="{{ $item->filler_1 }}"  class="form-control"  placeholder="Relleno 1" required readonly>
                                </div>
                                <div class="col">
                                    <label data-width="auto">Relleno 2</label>
                                    <input type="text" value="{{ $item->filler_2 }}"  class="form-control"  placeholder="Relleno 2" required readonly>
                                </div>
                            </div>    
                        @endif
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Valor total del producto</label>
                                <input type="number" value="{{ $item->total_value }}" class="form-control" required readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-success btn-block"> Realizar compra</button>                
                            </div>
                            <div class="col">
                                <a id="cancelar" href="{{ route('home') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                            </div>
                        </div>     
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection