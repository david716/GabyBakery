@extends('Admin.admin')
@section('style')
<style>
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){
        width: 100%;
    }
</style>
@endsection
<div class="container-fluid">
    @section('content')
        <input type="hidden" id="id_role" value="{{ $role->id }}">
        <div class="card">
            <div class="card-header text-center"> Nuevo Rol </div>
            <div class="card-body">
                <form action="{{ route('role.update', $role->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label  class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $role->name }}" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <input type="text" name="type" class="form-control" placeholder="tipo" value="web" readonly>
                    </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Permisos</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="selectpicker" id="permissions" name="permissions[]" data-live-search="true" multiple>
                                    @foreach($permissions as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block"> Guardar</button>                
                        </div>
                        <div class="col">
                            <a href="{{ route('role.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>     
                </form>
            </div>
        </div>
    @endsection
</div>