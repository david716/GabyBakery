@extends('Admin.admin')

<div class="container-fluid">
@section('content')
  <div class="row justify-content-end">
    <div class="col">
      <a href="{{ route('extras.create') }}" class="btn btn-default btn-flat btn-outline-success">
        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Agregar
      </a>
    </div>
    <div class="col">
        <h2>Lista de Extras</h2>
    </div>
    <div class="col">
      <input class="form-control" id="buscar" type="text" placeholder="Search..">
    </div>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-light">
        <tr>
            <th scope="col">Peso</th>
            <th scope="col">Blonda</th>
            <th scope="col">Caja</th>
            <th scope="col">Sticker</th>
            <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody  id="myTable">
        @foreach($extras as $item)
        <tr>
            <td>{{ $item->weigth }}</td>
            <td>{{ $item->blonda	 }}</td>
            <td>{{ $item->box }}</td>
            <td>{{ $item->sticker }}</td>
            <td>
                <div class="d-flex flex-row bd-highlight">
                    <a  href="{{ route('extras.edit', $item->id) }}"  class="btn btn btn-default btn-flat btn-outline-success">
                        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
                   <!-- <form action="{{ route('extras.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger ml-1 py-2 formEliminar">
                            <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>-->
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
              'La lista ha sido eliminada.',
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