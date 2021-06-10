@extends('Admin.admin')
<div class="container-fluid">
    @section('content')
        <div class="card">
            <div class="card-header text-center"> Nuevo Peso </div>
            <div class="card-body">
                <form action="{{ route('weigths.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label data-width="auto">Estado</label>
                        <div class="form-group">
                            <select  class="form-control" name="estado" data-live-search="true" required>
                                <option value="">Elija una opcion</option>
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
                            <a href="{{ route('weigths.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>     
                </form>
            </div>
        </div>
    @endsection
</div>