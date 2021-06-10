@extends('Admin.admin')

<div class="container-fluid">
    @section('content')
        <div class="card">
            <div class="card-header text-center"> Nueva Masa </div>
            <div class="card-body">
                <form action="{{ route('doughs.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label  class="form-label">Sabor</label>
                        <input type="text" name="flavor" class="form-control" placeholder="Sabor de la masa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <input type="text" name="type" class="form-control" placeholder="Tipo de masa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio 1 Libra</label>
                        <input type="number" name="Libra_1" class="form-control" placeholder="Precio" required >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio 3/4 Libra</label>
                        <input type="number" name="Libra_3_4" class="form-control" placeholder="Precio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio 1/2 Libra</label>
                        <input type="number" name="Libra_1_2" class="form-control" placeholder="Precio"required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio 1/4 Libra</label>
                        <input type="number" name="Libra_1_4" class="form-control" placeholder="Precio" required>
                    </div>
                    <div class="mb-3">
                        <label data-width="auto">Estado</label>
                        <div class="form-group">
                            <select  class="form-control" name="estado" data-live-search="true" required>
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
                            <a href="{{ route('doughs.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>     
                </form>
            </div>
        </div>
    @endsection
</div>