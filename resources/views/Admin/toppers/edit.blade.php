@extends('Admin.admin')

<div class="container-fluid">
    @section('content')
        <div class="card">
            <div class="card-header text-center"> Editar Peso </div>
            <div class="card-body">
                <form action="{{ route('toppers.update', $topper->id) }}" method="post">
                    <input id="topper_id" type="hidden" value="{{ $topper->id }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label  class="form-label">Nombre</label>
                        <input type="text" name="name" value="{{ $topper->name }}" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Precio</label>
                        <input type="number" name="value" value="{{ $topper->value }}" class="form-control" placeholder="precio" >
                    </div>
                    <div class="mb-3">
                        <label data-width="auto">Estado</label>
                        <div class="form-group">
                            <select  class="form-control" name="estado" id="estado_topper" data-live-search="true" required>
                                @foreach($estados as $item)
                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block"> Guardar</button>                
                        </div>
                        <div class="col">
                            <a href="{{ route('toppers.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>     
                </form>
            </div>
        </div>
    @endsection
</div>