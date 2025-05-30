@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Agregar Cita</h1>
    </div>
</div>

<form method="post" action="{{ url('/catalogos/citas/agregar') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="fechaCita">Fecha:</label>
                <input type="date" name="fechaCita" id="fechaCita" class="form-control" required>
            </div>
            
            <div class="form-group my-2">
                <label for="horaCita">Hora:</label>
                <input type="time" name="horaCita" id="horaCita" class="form-control" required>
            </div>
            
            <div class="form-group my-2">
                <label for="fk_id_cliente">Cliente:</label>
                <select name="fk_id_cliente" id="fk_id_cliente" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="marcaVehiculo">Marca del Vehículo:</label>
                <input type="text" name="marcaVehiculo" id="marcaVehiculo" class="form-control" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
            </div>
            
            <div class="form-group my-2">
                <label for="modeloVehiculo">Modelo del Vehículo:</label>
                <input type="text" name="modeloVehiculo" id="modeloVehiculo" class="form-control" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\-]+" title="Solo letras, números y guiones">
            </div>
        </div>
    </div>
    
    <div class="row my-3">
        <div class="col text-end">
            <button type="submit" class="btn btn-agregar">Guardar</button>
        </div>
    </div>
</form>
@endsection