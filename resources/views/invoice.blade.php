@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center"> <h2>Informacion de Facturas</h2> </div>
        <div class="card-body">
            <center>
                <h3>Productos Estadar</h3>
            </center>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                <input class="form-control" id="buscar" type="text" placeholder="Search..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <!--<th scope="col">Id</th>-->
                        <th scope="col">Fecha de compra</th>
                        <th scope="col">Hora de comppra</th>
                        <th scope="col">Fecha de entrega</th>
                        <th scope="col">Hora de entrega</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody  id="myTable">
                    @foreach ($invoice as $item)
                        <tr>
                            <!--<td>{{ $item->id}}</td>-->
                            <td>{{ $item->purchase_date}}</td>
                            <td>{{ $item->purchase_hour}}</td>
                            <td>{{ $item->delivery_date}}</td>
                            <td>{{ $item->delivery_hour}}</td>
                            <td>{{ $item->user}}</td>
                            <td>{{ $item->product_name}}</td>
                            <td>{{ $item->estado}}</td>
                            <td>{{ $item->value}}</td>
                            <td>
                                <div class="d-flex flex-row bd-highlight">
                                    <a href="{{ route('invoice_detail', array($item->id, $item->product_type_id, 1)) }}"  class="btn btn btn-default btn-flat btn-outline-success">
                                        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <center>
            <h3>Productos Personalizado</h3>
            </center>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                <input class="form-control" id="buscar2" type="text" placeholder="Search..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <!--<th scope="col">Id</th>-->
                        <th scope="col">Fecha de compra</th>
                        <th scope="col">Hora de comppra</th>
                        <th scope="col">Fecha de entrega</th>
                        <th scope="col">Hora de entrega</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody  id="myTable2">
                    @foreach ($invoice_custom as $item)
                        <tr>
                            <!--<td>{{ $item->id}}</td>-->
                            <td>{{ $item->purchase_date}}</td>
                            <td>{{ $item->purchase_hour}}</td>
                            <td>{{ $item->delivery_date}}</td>
                            <td>{{ $item->delivery_hour}}</td>
                            <td>{{ $item->user}}</td>
                            <td>{{ $item->product_name}}</td>
                            <td>{{ $item->estado}}</td>
                            <td>{{ $item->value}}</td>
                            <td>
                                <div class="d-flex flex-row bd-highlight">
                                    <a href="{{ route('invoice_detail', array( $item->id, $item->product_type_id, 2)) }}"  class="btn btn btn-default btn-flat btn-outline-success">
                                        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
  <script>
    $(document).ready(function(){
      $("#buscar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
      $("#buscar2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable2 tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
@endsection