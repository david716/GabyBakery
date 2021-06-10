@extends('Admin.admin')

<div class="container-fluid">
    @section('content')
        <div class="card">
            <div class="card-header text-center"> Nueva Factura </div>
            <div class="card-body">
                <form action="{{ route('invoices.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label p-3" data-width="auto">Usuario</label>
                        <select class="selectpicker" name="user_id" data-live-search="true">
                            @foreach($users as $item)
                                <option data-tokens="ketchup mustard" value="{{ $item->id }}">  {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Fecha de Compra</label>
                        <input type="date" name="purchase_date" class="form-control" id="exampleFormControlInput1" placeholder="Fecha de Compra">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Hora de Compra</label>
                        <input type="time" name="hour" class="form-control" id="exampleFormControlInput1" placeholder="Hora">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Valor</label>
                        <input type="number" name="value" class="form-control" id="exampleFormControlInput1" placeholder="Valor">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"> Guardar Factura </button>      
                </form>
            </div>
        </div>
    @endsection
</div>