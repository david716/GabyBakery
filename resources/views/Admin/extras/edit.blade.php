@extends('Admin.admin')

<div class="container-fluid">
    @section('content')
        <input type="hidden" id="extras_id" value="{{ $extras->id }}">
        <div class="card">
            <div class="card-header text-center"> Editar Extras </div>
            <div class="card-body">
                <form action="{{ route('extras.update', $extras->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label data-width="auto">Peso</label>
                        <div class="form-group">
                            <select  class="form-control" name="weigth" id="weight_extras" data-live-search="true" required>
                                <option value="">Elija una opcion</option>
                                @foreach($weigths as $item)
                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Blonda</label>
                        <input type="number" name="blonda" value="{{ $extras->blonda }}" class="form-control" placeholder="precio" required>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Caja</label>
                        <input type="number" name="box" value="{{ $extras->box }}" class="form-control" placeholder="precio" required>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Sticker</label>
                        <input type="number" name="sticker" value="{{ $extras->sticker }}" class="form-control" placeholder="precio" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block"> Guardar</button>                
                        </div>
                        <div class="col">
                            <a href="{{ route('extras.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>     
                </form>
            </div>
        </div>
    @endsection
</div>