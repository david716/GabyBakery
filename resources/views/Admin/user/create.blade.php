@extends('Admin.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"> Nuevo Usuario </div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label class="form-label">Nombre y Apellido</label>
                        <input type="text" name="name" maxlength="20" minlength="5" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Direccíon</label>
                        <input type="text" name="adress" minlength="5" class="form-control" placeholder="dirrección" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" name="phone" minlength="10" maxlength="10" class="form-control" placeholder="telefono" required>
                    </div>
                    <center>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label d-block p-3">role</label>
                            <select class="selectpicker" name="role" data-live-search="true">
                                @foreach($role as $item)
                                    <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </center>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" name="password" class="form-control" placeholder="contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Guardar user
                    </button>               
                </form>
            </div>
        </div>

    </div>

@endsection
