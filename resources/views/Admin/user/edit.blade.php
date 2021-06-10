@extends('Admin.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center"> Editar Usuario </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $user->id }}" id="id_user">
                    <div class="mb-3">
                        <label class="form-label">Nombre y Apellido</label>
                        <input type="text" name="name" maxlength="20" minlength="5" value="{{ $user->name }}" class="form-control" required placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" minlength="5" value="{{ $user->email }}" class="form-control" required placeholder="email" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Direccíon</label>
                        <input type="text" name="adress" minlength="5" value="{{ $user->adress }}" class="form-control" required placeholder="dirrección">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefno </label>
                        <input type="tel" name="phone" minlength="10" maxlength="10"  value="{{ $user->phone }}" class="form-control" required placeholder="telefono">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" minlength="8" class="form-control" placeholder="contraseña" >
                    </div>
                    <div class="mb-3">
                        <label data-width="auto">Rol</label>
                            <div class="form-group">
                                <select class="form-control" name="role" data-live-search="true" id="role">
                                    @foreach($role as $item)
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
                            <a href="{{ route('user.index') }}" type="button" class="btn btn-warning btn-block"> Cancelar</a>                
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    </div>
@endsection
