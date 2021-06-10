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
                                <input type="text" value="{{ $item->product_name }}" class="form-control" id="exampleFormControlInput1" placeholder="nombre del producto" required readonly>
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
                                <input type="text" value="{{ $item->category }}"  class="form-control" id="exampleFormControlInput1" placeholder="Categoria" required readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Porciones</label>
                                <input type="hidden" name="slice_id" class="form-control" id="slice_id" placeholder="Porciones" required readonly>
                                <input type="text" class="form-control" id="slice" placeholder="Porciones" required readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <label data-width="auto">Topper</label>
                                <div class="form-group">
                                    <select class="form-control" name="topper" id="topper" data-live-search="true">
                                            <option value=""> Sin Topper </option>
                                        @foreach($topper as $item)
                                            <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col vela">
                                <label for="exampleFormControlTextarea1" class="form-label">Numero</label>
                                <input type="number" name="vela" value="{{ $item->topper }}"  class="form-control" id="vela" placeholder="Vela" required>
                            </div>
                            <div class="col color">
                            <label data-width="auto">Color</label>
                                <div class="form-group">
                                    <select class="form-control" name="color" id="color" data-live-search="true">
                                        @foreach($color as $item)
                                            <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                            <label data-width="auto">Peso</label>
                                <div class="form-group">
                                    <select class="form-control" name="weight" id="weight" data-live-search="true">
                                        @foreach($weigth as $item)
                                            <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>    
                        <div id="1_libra">
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Cubierta</label>
                                    <div class="form-group">
                                        <select id="coverage_1" class="form-control" name="coverage" data-live-search="true">
                                            @foreach($coverage as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>                               
                                </div>
                                <div class="col">
                                    <label data-width="auto">Masa 1 y 2</label>
                                    <div class="form-group">
                                        <select id="dough_1_2" class="form-control" name="dough_1_2" data-live-search="true">
                                            @foreach($doug as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Masa 3 y 4</label>
                                    <div class="form-group">
                                        <select id="dough_3_4" class="form-control" name="dough_3_4" data-live-search="true">
                                            @foreach($doug as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label data-width="auto">Relleno</label>
                                    <div class="form-group">
                                        <select id="filler" class="form-control" name="filler" data-live-search="true">
                                            @foreach($filler as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div id="menor_1_libra" >
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Cubierta</label>
                                    <div class="form-group">
                                        <select class="form-control" id="coverage_2" name="coverage" data-live-search="true">
                                            @foreach($coverage as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label data-width="auto">Masa</label>
                                    <div class="form-group">
                                        <select class="form-control" id="dough" name="dough" data-live-search="true">
                                            @foreach($doug as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label data-width="auto">Relleno 1</label>
                                    <div class="form-group">
                                        <select class="form-control" id="filler_1" name="filler_1" data-live-search="true">
                                            @foreach($filler as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label data-width="auto">Relleno 2</label>
                                    <div class="form-group">
                                        <select class="form-control" id="filler_2" name="filler_2" data-live-search="true">
                                            @foreach($filler as $item)
                                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Valor total del producto</label>
                                <input type="number" id="total_value" name="total_value" class="form-control" required readonly>
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