@extends('Admin.admin')
<div class="container-fluid">
    @section('content')
        <div class="card">
            <div class="card-header text-center"> Nuevo Permiso </div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label  class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <input type="text" name="type" class="form-control" placeholder="tipo" value="web" readonly>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block"> Guardar</button>                
                        </div>
                        <div class="col">
                            <a href="{{ route('permission.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>     
                </form>
            </div>
        </div>
    @endsection
</div>