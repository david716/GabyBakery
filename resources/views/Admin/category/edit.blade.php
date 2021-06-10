@extends('Admin.admin')

<div class="container-fluid">
    @section('content')
        <div class="card">
            <div class="card-header text-center"> Editar Categoria </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    <input id="category_id" type="hidden" value="{{ $category->id }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Categoria</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="exampleFormControlInput1" placeholder="Categoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $category->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label data-width="auto">Estado</label>
                        <div class="form-group">
                            <select  class="form-control" name="estado" id="estado_category" data-live-search="true" required>
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
                            <a href="{{ route('category.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    @endsection
</div>