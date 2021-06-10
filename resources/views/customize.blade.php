@extends('layouts.app')

@section('content')
    
<div class="container-fluid">
        <div class="card-group">
            <div class="card">
                <div class="card-body padding_0">
                    <canvas id="renderCanvas" touch-action="none"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-body padding_0">
                    <form id="formulario" action="{{ route('product_custom') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id"  id="user_id" value="{{auth()->user()->id}}" readonly>
                        <input type="hidden" name="product_id" value="0">
                        <input type="hidden" name="purchase_date" id="purchase_date">
                        <input type="hidden" name="purchase_hour" id="purchase_hour">
                        <input type="hidden" name="delivery_date" id="delivery_date">
                        <input type="hidden" name="delivery_hour" id="delivery_hour">
                        <input type="hidden" name="estado_id" id="estado_id">
                        <input type="hidden" name="total_value" value="1">
                        <input type="hidden" name="id_coverage" id="id_coverage">
                        <input type="hidden" name="id_doug_1_2" id="id_doug_1_2" class="1_libra">
                        <input type="hidden" name="id_doug_3_4" id="id_doug_3_4" class="1_libra">
                        <input type="hidden" name="id_filler" id="id_filler"     class="1_libra">
                        <input type="hidden" name="id_doug" id="id_doug" class="m_libra" disabled>
                        <input type="hidden" name="id_filler_1" id="id_filler_1" class="m_libra" disabled>
                        <input type="hidden" name="id_filler_2" id="id_filler_2" class="m_libra" disabled>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label data-width="auto">Producto</label>
                                        <div class="form-group">
                                            <select class="form-control" name="product_shape" id="opt_forma" data-live-search="true">
                                                @foreach($product_shapes as $item)
                                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   <div class="col">
                                        <label style="white-space: nowrap;">Tamaño</label>
                                        <div class="form-group">
                                            <select class="form-control" name="weight" id="tamano" data-live-search="true">
                                                @foreach($weigth as $item)
                                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div id="f_b" class="col">
                                        <label style="white-space: nowrap;">Forma de blonda</label>
                                        <div class="form-group" id = "d_opt_forma_base">
                                            <div class="form-group">
                                                <select class="form-control" name="blonda" id="opt_forma_base" data-live-search="true">
                                                    @foreach($blonda_shapes as $item)
                                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style="white-space: nowrap;">Color blonda</label>
                                        <div class="form-group">
                                            <select class="form-control"  name="blonda_color" id="opt_color_base" data-live-search="true">
                                                @foreach($colors as $item)
                                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label style="white-space: nowrap;">Borde</label>
                                        <div class="form-group">
                                            <select  class="form-control" name="edge" id="borde">
                                                <option value="">Sin borde</option>
                                                <option value="1">Tipo 1</option>
                                                <option value="2">Tipo 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label style="white-space: nowrap;">Topper Vela</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="candle" id="numero" maxlength="2" placeholder="Ingrese un numero">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="sabor_borde" class="col" style="display: none;">
                                        <label style="white-space: nowrap;">Sabor Borde</label>
                                        <div class="form-group">
                                            <select  class="form-control" name="edge_flavor" id="borde_sabor" data-live-search="true" disabled>
                                                @foreach($edge as $item)
                                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->flavor }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="color_velas" class="col" style="display: none;">
                                        <label style="white-space: nowrap;">color velas</label>
                                        <div class="form-group">
                                            <select class="form-control" name="candle_color" id="velas_color" data-live-search="true" disabled>
                                                @foreach($colors as $item)
                                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="mensajes_predeterminado" class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="comment">Mensaje predeterminado</label>
                                            <select  class="form-control" name="message" id="men_pred">
                                                <option value="">Elija un mensaje</option>
                                                <option value="Feliz_Cumpleaño">Feliz Cumpleaño</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="color_mensaje" class="row" style="display: none;">
                                    <div class="col">
                                        <div class="form-group">
                                            <label style="white-space: nowrap;">color mensaje</label>
                                            <select class="form-control" name="message_color" id="mensaje_color" data-live-search="true" disabled>
                                                @foreach($colors as $item)
                                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="mensaje" class="row" style="display:none;">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="comment">Mensaje</label>
                                            <textarea class="form-control" name="message" id="mensaje_caja" style="resize: none;" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card no_border_fondo">
                            <div class="card-header text-center">Sabores</div>
                            <div class="card-body text-center lis_sabor">
                                <div id="sabor">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header">
                                              <a class="card-link" data-toggle="collapse" href="#cubierta_">
                                                Cubierta
                                              </a>
                                            </div>
                                            <div id="cubierta_" class="collapse" data-parent="#accordion">
                                              <div class="card-body" style="background-color: #eaeaea;">
                                                    <div id="cubierta_1">
                                                        <div class="row">
                                                        @foreach($coverage_1 as $item)
                                                            <div class="col">
                                                                <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                <input type="hidden" class="id_coverage" value="{{ $item->id }}">
                                                                <i class="fas fa-circle cubierta sabor {{ $item->flavor }}"><br></i>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                        <div class="row">
                                                        @foreach($coverage_2 as $item)
                                                            <div class="col">
                                                                <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                <input type="hidden" class="id_coverage" value="{{ $item->id }}">
                                                                <i class="fas fa-circle cubierta sabor {{ $item->flavor }}"><br></i>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                          <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#masa1_2">
                                                Masa 1 y 2
                                            </a>
                                          </div>
                                          <div id="masa1_2" class="collapse" data-parent="#accordion">
                                            <div class="card-body" style="background-color: #eaeaea;">
                                                <div id="masa_1_2">
                                                    <div class="row">
                                                    @foreach($doug_1 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_doug_1_2" value="{{ $item->id }}">
                                                            <i class="fas fa-circle masa_1_2 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="row">
                                                    @foreach($doug_2 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_doug_1_2" value="{{ $item->id }}">
                                                            <i class="fas fa-circle masa_1_2 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#masa3_4">
                                                    Masa 3 y 4
                                                </a>
                                            </div>
                                            <div id="masa3_4" class="collapse" data-parent="#accordion">
                                                <div class="card-body"  style="background-color: #eaeaea;">
                                                    <div id="masa_3_4" >
                                                        <div class="row">
                                                        @foreach($doug_1 as $item)
                                                            <div class="col">
                                                                <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                <input type="hidden" class="id_doug_3_4" value="{{ $item->id }}">
                                                                <i class="fas fa-circle masa_3_4 sabor {{ $item->flavor }}"><br></i>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                        <div class="row">
                                                        @foreach($doug_2 as $item)
                                                            <div class="col">
                                                                <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                <input type="hidden" class="id_doug_3_4" value="{{ $item->id }}">
                                                                <i class="fas fa-circle masa_3_4 sabor {{ $item->flavor }}"><br></i>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        <div class="card">
                                          <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse" href="#relleno_">
                                                Relleno
                                            </a>
                                          </div>
                                          <div id="relleno_" class="collapse" data-parent="#accordion">
                                            <div class="card-body"  style="background-color: #eaeaea;">
                                                <div id="relleno">
                                                    <div class="row">
                                                    @foreach($filler_1 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="row">
                                                    @foreach($filler_2 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="row">
                                                    @foreach($filler_3 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sabor_2" style="display: none;">
                                    <div id="accordion2">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#cubierta">
                                                    Cubierta
                                                </a>
                                            </div>
                                            <div id="cubierta" class="collapse" data-parent="#accordion2">
                                                <div class="card-body">
                                                    <div id="cubierta_2">
                                                        <div class="row">
                                                            @foreach($coverage_1 as $item)
                                                                <div class="col">
                                                                    <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                    <input type="hidden" class="id_coverage" value="{{ $item->id }}">
                                                                    <i class="fas fa-circle cubierta sabor {{ $item->flavor }}"><br></i>
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                            <div class="row">
                                                            @foreach($coverage_2 as $item)
                                                                <div class="col">
                                                                    <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                    <input type="hidden" class="id_coverage" value="{{ $item->id }}">
                                                                    <i class="fas fa-circle cubierta sabor {{ $item->flavor }}"><br></i>
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#masa_">
                                                    Masa
                                                </a>
                                            </div>
                                            <div id="masa_" class="collapse" data-parent="#accordion2">
                                                <div class="card-body">
                                                    <div class="masa">
                                                        <div class="row">
                                                        @foreach($doug_1 as $item)
                                                            <div class="col">
                                                                <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                <input type="hidden" class="id_doug" value="{{ $item->id }}">
                                                                <i class="fas fa-circle masa_m sabor {{ $item->flavor }}"><br></i>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                        <div class="row">
                                                        @foreach($doug_2 as $item)
                                                            <div class="col">
                                                                <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                                <input type="hidden" class="id_doug" value="{{ $item->id }}">
                                                                <i class="fas fa-circle masa_m sabor {{ $item->flavor }}"><br></i>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                          <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse" href="#relleno1">
                                                Relleno 1
                                            </a>
                                          </div>
                                          <div id="relleno1" class="collapse" data-parent="#accordion2">
                                            <div class="card-body">
                                                <div id="relleno_1">
                                                    <div class="row">
                                                    @foreach($filler_1 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler_1" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno_1 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="row">
                                                    @foreach($filler_2 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler_1" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno_1 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="row">
                                                    @foreach($filler_3 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler_1" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno_1 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="card">
                                          <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse" href="#relleno2">
                                                Relleno 2
                                            </a>
                                          </div>
                                          <div id="relleno2" class="collapse" data-parent="#accordion2">
                                            <div class="card-body">
                                                <div id="relleno_2">
                                                <div class="row">
                                                    @foreach($filler_1 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler_2" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno_2 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="row">
                                                    @foreach($filler_2 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler_2" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno_2 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="row">
                                                    @foreach($filler_3 as $item)
                                                        <div class="col">
                                                            <input type="radio"  class ="{{ $item->flavor }}" value="{{ $item->flavor }}"  style="display:none;" >
                                                            <input type="hidden" class="id_filler_2" value="{{ $item->id }}">
                                                            <i class="fas fa-circle relleno_2 sabor {{ $item->flavor }}"><br></i>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header text-center">Informacion adicional</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Imagen</label>
                                        <input type="file" name="images" class="form-control-file" id="exampleFormControlInput1" accept="image/*">
                                        @error('file')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label data-width="auto" class="form-label">Descripcion</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Opcional"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label style="white-space: nowrap;">Valor Total</label>
                                        <input type="text" class="form-control" name="total_value" id="value" placeholder="Valor Total" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card no_border_fondo">
                            <div class="card-body">
                               <input id="Realizar_Compra" type="submit" class="btn btn-success btn-lg btn-block" value="Realizar Compra" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
          </div>
    </div>
    
@endsection

@section('scripts')
    <script src="{{ asset('js/personalizar/canvas.js') }}" defer></script>
    <script src="{{ asset('js/personalizar/modelos.js') }}" defer></script>
    <script src="{{ asset('js/personalizar/sabores.js') }}" defer></script>
    <script src="{{ asset('js/personalizar/scripts.js') }}" defer></script>
@endsection