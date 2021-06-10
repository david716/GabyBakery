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
  <div class="row justify-content-end">
    <div class="col">
      <a href="{{ route('user.create') }}"  class="btn btn-default btn-flat btn-outline-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Agregar
      </a>
    </div>
    <div class="col">
        <h2>Lista de Usuarios</h2>
    </div>
    <div class="col">
      <input class="form-control" id="buscar" type="text" placeholder="Search..">
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" maxlength="20" minlength="5" class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" minlength="5" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Direccíon</label>
                                <input type="text" name="adress" minlength="5" class="form-control" placeholder="Dirrección" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telefono</label>
                                <input type="tel" name="phone"  minlength="10" maxlength="10" class="form-control" placeholder="Telefono" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" minlength="8" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label d-block p-3">role</label>
                                <select class="selectpicker" name="role" data-live-search="true">
                                    @foreach($role as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                              <div class="col">
                                <button type="submit" class="btn btn-success btn-block"> Guardar </button> 
                              </div>
                              <div class="col">
                                <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"> Cancelar </button>
                              </div>
                            </div>               
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Rol</th>
            <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody  id="myTable">
      @foreach($user as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->rol }}</td>
            <td>
                <div class="d-flex flex-row bd-highlight">
                    <a href="{{ route('user.edit', $item->id) }}"  class="btn btn btn-default btn-flat btn-outline-success">
                        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
                    @if(is_null($item->invoice))
                      <form action="{{ route('user.destroy', $item->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-outline-danger ml-1 py-2 formEliminar">
                              <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                          </button>
                      </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
</div>
@section('scripts')
  <script>
    $(document).ready(function(){
      $("#buscar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

  @if(session('eliminar') == 'ok')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script defer>
        Swal.fire(
              'Eliminado!',
              'El usuario ha sido eliminado.',
              'success'
            ) 
    </script>
  @endif

  <script defer>
    document.addEventListener('DOMContentLoaded', function(){
      $('.formEliminar').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Estas seguro?',
            text : "No podrás revertir esto!",
            icon : 'warning',
            showCancelButton  : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Si, bórralo!'
          }).then((result) => {
            if (result.isConfirmed) {
              $(this).parents('form').submit();
            }
          });   
      });
    });
  </script>
@endsection