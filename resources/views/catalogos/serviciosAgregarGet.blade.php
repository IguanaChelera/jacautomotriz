@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Agregar Servicio</h1>
    </div>
</div>

<form method="post" action="{{ url('/catalogos/servicios/agregar') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="nombreServicio">Nombre del Servicio:</label>
                <input type="text" name="nombreServicio" id="nombreServicio" class="form-control" required autofocus>
            </div>
            
            <div class="form-group my-2">
                <label for="costoServicio">Costo:</label>
                <input type="number" step="0.01" name="costoServicio" id="costoServicio" class="form-control" required>
            </div>
            
            <div class="form-group my-2">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="1" selected>Activo</option>
                    <option value="0">Inactivo</option>
                </select>
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