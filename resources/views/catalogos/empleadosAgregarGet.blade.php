@extends("components.layout")

@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Agregar Servicio</h1>
    </div>
    <div class="col"></div>
</div>

<form method="post" action="{{ url('/catalogos/servicios/agregar') }}">
    @csrf
    <div class="row my-4">
        <div class="form-group mb-3 col-6">
            <label for="nombre">Nombre del Servicio:</label>
            <input type="text" maxlength="70" class="form-control" name="nombre" id="nombre"
                placeholder="Ingrese el nombre del servicio" required autofocus />
        </div>

        <div class="form-group mb-3 col-6">
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" class="form-control" name="precio" id="precio"
                placeholder="Ingrese el precio del servicio" required />
        </div>
    </div>

    <div class="row my-3">
        <div class="form-group mb-3 col-6">
            <label for="activo">Activo:</label>
            <select name="activo" id="activo" class="form-control" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection
