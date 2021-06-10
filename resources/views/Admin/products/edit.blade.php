@extends('Admin.admin')
<div class="container-fluid">
    @section('content')
    <input type="hidden" id="id" value="{{ $product->id }}">
        <div class="card">
            <div class="card-header text-center">
                Nuevo Producto
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Nombre del producto</label>
                            <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="nombre del producto" required>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Imagen</label>
                            <input type="file" name="images" class="form-control-file" accept="image/*">
                            @error('file')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                    </div>
                    <br>    
                    <div class="row">
                        <div class="col">
                            <label data-width="auto">Tipo Producto</label>
                            <div class="form-group">
                                <select id="product_type" class="form-control" name="product_type" id="product_type" data-live-search="true">
                                    @foreach($type_product as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Clasificacion</label>
                            <input type="number" name="rating" value="{{ $product->rating }}" maxlength="1" min="0" max="5" class="form-control" placeholder="Calificación" required>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Porciones</label>
                            <input type="hidden" name="slice_id" id="slice_id" class="form-control" placeholder="Porciones" required readonly>
                            <input type="text" name="slice"  id="slice" class="form-control"  placeholder="Porciones" required readonly>
                        </div>
                        <div class="col">
                            <label data-width="auto">Estado</label>
                            <div class="form-group">
                                <select class="form-control" name="estado" id="estado_product" data-live-search="true">
                                    @foreach($esatdos as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label data-width="auto">Forma Producto</label>
                            <div class="form-group">
                                <select class="form-control" name="product_shape" id="product_shape" data-live-search="true">
                                    @foreach($shape_product as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label data-width="auto">Categoria</label>
                            <div class="form-group">
                                <select id="category" class="form-control" name="category" id="category" data-live-search="true">
                                    @foreach($category as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                        <div class="col">
                            <label data-width="auto">Blonda</label>
                            <div class="form-group">
                                <select class="form-control" name="blonda" id="blonda" data-live-search="true">
                                    @foreach($blonda as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="semi_perzonalizado">
                        <hr>
                        <div class="row">
                          <!--  <div class="col" style="text-align: center;">
                                <h3>Valor Extra del Producto</h3>
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Valor 1 libra</label>
                                <input type="number" name="Libra_1" value="{{ $product->Libra_1 }}" class="form-control" min="1" id="libra_1"  placeholder="precio del produco" required>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Valor 3/4 Libra</label>
                                <input type="number" name="Libra_3_4"  value="{{ $product->Libra_3_4 }}" class="form-control"  min="1" id="libra_3_4" placeholder="precio del produco" required>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Valor 1/2 Libra</label>
                                <input type="number" name="Libra_1_2" value="{{ $product->Libra_1_2 }}" class="form-control" min="1" id="libra_1_2" placeholder="precio del produco" required>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Valor 1/4 Libra</label>
                                <input type="number" name="Libra_1_4" value="{{ $product->Libra_1_4 }}" class="form-control" min="1" id="libra_1_4" placeholder="precio del produco" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div id="1_libra">
                        <div class="row">
                            <div class="col">
                                <label data-width="auto">Cubierta</label>
                                <div class="form-group">
                                    <select class="form-control " id="coverage_1" name="coverage" data-live-search="true">
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
                                    <select class="form-control coverage" id="coverage_2" name="coverage" data-live-search="true">
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
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Valor extra del producto</label>
                            <input type="number" id="value_extra" name="value_extra" class="form-control" required readonly>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Valor</label>
                            <input id="value" type="number" name="value" value="{{ $product->value }}" class="form-control" placeholder="Valor" required readonly>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Valor total del producto</label>
                            <input  type="number" id="value_total" name="total_value" class="form-control" required readonly>
                        </div>
                    </div>
                    <br>       
                    <div class="row">
                        <div class="col">
                            <label data-width="auto" class="form-label">Descripcion</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block"> Guardar</button>                
                        </div>
                        <div class="col">
                            <a href="{{ route('products.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
    </div>


