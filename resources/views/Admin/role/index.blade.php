@extends('Admin.admin')

<div class="container-fluid">
@section('content')
  <div class="row justify-content-end">
    <div class="col">
      <a href="{{ route('role.create') }}" class="btn btn-default btn-flat btn-outline-success">
        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Agregar
      </a>
    </div>
    <div class="col">
        <h2>Lista de Roles</h2>
    </div>
    <div class="col">
      <input class="form-control" id="buscar" type="text" placeholder="Search..">
    </div>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Tipo</th>
            <th scope="col">Permisos</th>
            <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody  id="myTable">
        @foreach($role as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->guard_name }}</td>
            <td>
                @foreach ($item->permissions as $item_permissions)
                    {{ $item_permissions->name }},
                @endforeach
            </td>
            <td>
                <div class="d-flex flex-row bd-highlight">
                    <a  href="{{ route('role.edit', $item->id) }}"  class="btn btn btn-default btn-flat btn-outline-success">
                        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
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
@endsection