@extends('Admin.admin')

<div class="container-fluid">
    @section('content')
        @foreach ($info as $item)
        <div class="card">
            <div class="card-header text-center"> Informacion de Factura </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Nombre del Producto</label>
                        <input type="text" value="{{ $item->product_name }}" class="form-control"  disabled>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Nombre Usuario</label>
                        <input type="text" value="{{ $item->user }}" class="form-control"  disabled>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Valor</label>
                        <input type="number" value="{{ $item->value }}" class="form-control"  disabled>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Fecha de Pedido</label>
                        <input type="text" value="{{ $item->purchase_date }}" class="form-control"  disabled>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Hora de Pedido</label>
                        <input type="text" value="{{ $item->purchase_hour }}" class="form-control"  disabled>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Fecha de Entrega</label>
                        <input type="text" value="{{ $item->delivery_date }}" class="form-control"  disabled>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Hora de Entrega</label>
                        <input type="text" value="{{ $item->delivery_hour }}" class="form-control"  disabled>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <br>
        <div class="row">
        @if($item->product_type_id != 3)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center"> Imagen del Producto </div>
                    <div class="card-body" style="padding: 0;">
                        <img src="{{ asset($item->images) }}" width="100%" height="205px">
                    </div>
                </div>
            </div>
        @endif
            <div class="col">
                <div class="card">
                    <div class="card-header text-center"> Informacion del Producto </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Tamaño</label>
                                <input type="text" value="{{ $item->weight }}" class="form-control"  disabled>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Forma</label>
                                @if($item->product_type_id != 3)
                                    <input type="text" value="{{ $item->product_shape }}" class="form-control"  disabled>
                                @else
                                    <input type="text" value="{{ $item->product_shape }}" class="form-control"  disabled>
                                @endif

                            </div>
                            @if($item->product_type_id != 3)
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Rebanadas</label>
                                    <input type="text" value="{{ $item->slice }}" class="form-control"  disabled>
                                </div>
                            @endif
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Blonda</label>
                                <input type="text" value="{{ $item->blonda }}" class="form-control"  disabled>
                            </div>
                            @if($item->product_type_id == 3)
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Color Blonda</label>
                                    <input type="text" value="{{ $item->blonda_color }}" class="form-control"  disabled>
                                </div>
                            @endif
                        </div>
                        <br>
                        @if($item->product_type_id == 1)
                            @if($item->weight_id == 1)
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Cubierta</label>
                                        <input type="text" value="{{ $item->coverage }}" class="form-control" id="coverage_1_i" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa 1</label>
                                        <input type="text" value="{{ $item->dough_1_2 }}" class="form-control" id="doug_1_2_i" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa 2</label>
                                        <input type="text" value="{{ $item->dough_3_4 }}" class="form-control" id="dough_3_4_i" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno</label>
                                        <input type="text" value="{{ $item->filler }}" class="form-control" id="filler_i" disabled>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Cubierta</label>
                                        <input type="text" value="{{ $item->coverage }}" class="form-control" id="coverage_2_i" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa</label>
                                        <input type="text" value="{{ $item->dough }}" class="form-control" id="doug_i"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno 1</label>
                                        <input type="text" value="{{ $item->filler_1 }}" class="form-control" id="filler_1_i" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno 2</label>
                                        <input type="text" value="{{ $item->filler_2 }}" class="form-control" id="filler_2_i" disabled>
                                    </div>
                                </div>
                            @endif
                        @elseif ($item->product_type_id == 2)
                            @if($item->weight_id == 1)
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Cubierta</label>
                                        <input type="text" value="{{ $item->coverage }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa 1</label>
                                        <input type="text" value="{{ $item->dough_1_2 }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa 2</label>
                                        <input type="text" value="{{ $item->dough_3_4 }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno</label>
                                        <input type="text" value="{{ $item->filler }}" class="form-control"  disabled>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Cubierta</label>
                                        <input type="text" value="{{ $item->coverage }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa</label>
                                        <input type="text" value="{{ $item->dough }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno 1</label>
                                        <input type="text" value="{{ $item->filler_1 }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno 2</label>
                                        <input type="text" value="{{ $item->filler_2 }}" class="form-control"  disabled>
                                    </div>
                                </div>
                            @endif
                            @elseif ($item->product_type_id == 3)
                            @if($item->weight_id == 1)
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Cubierta</label>
                                        <input type="text" value="{{ $item->coverage }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa 1</label>
                                        <input type="text" value="{{ $item->dough_1_2 }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa 2</label>
                                        <input type="text" value="{{ $item->dough_3_4 }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno</label>
                                        <input type="text" value="{{ $item->filler }}" class="form-control"  disabled>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Cubierta</label>
                                        <input type="text" value="{{ $item->coverage }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Masa</label>
                                        <input type="text" value="{{ $item->dough }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno 1</label>
                                        <input type="text" value="{{ $item->filler_1 }}" class="form-control"  disabled>
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Relleno 2</label>
                                        <input type="text" value="{{ $item->filler_2 }}" class="form-control"  disabled>
                                    </div>
                                </div>
                            @endif
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Borde</label>
                                    <input type="text" value="{{ $item->edge }}" class="form-control validation"  disabled>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Sabor Borde</label>
                                    <input type="text" value="{{ $item->egde_flavor }}" class="form-control validation"  disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Topper</label>
                                    <input type="text" value="{{ $item->topper }}" class="form-control validation"  disabled>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Valor Topper</label>
                                    <input type="text" value="{{ $item->topper_value }}" class="form-control validation"  disabled>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Color Topper</label>
                                    <input type="text" value="{{ $item->topper_color }}" class="form-control validation"  disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Mesaje</label>
                                    <input type="text" value="{{ $item->message }}" class="form-control validation"  disabled>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Color Mesaje</label>
                                    <input type="text" value="{{ $item->message_color }}" class="form-control validation"  disabled>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>    
            </div>
        </div>
        @if($item->product_type_id == 3)
            @if(!is_null($item->images) || !is_null($item->description))
                <br>
                <div class="card">
                    <div class="card-header text-center"> Informacion Adicional </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header text-center"> Imagen </div>
                                <div class="card-body" style="padding: 0;">
                                    <img src="{{ asset($item->images) }}" width="100%" height="205px">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header text-center"> Observaciones </div>
                                <div class="card-body" style="padding: 0;">
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="8" disabled>{{ $item->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <br>
        <div class="row">
            <div class="col">
                <a  href="{{ route('invoices.index') }}" type="button" class="btn btn-success btn-block"> Volver </a>
            </div>
        </div>
        @endforeach
    @endsection
</div>