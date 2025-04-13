@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row">
    <div class="form-group my-3">
        <h1>Editar puesto</h1>
    </div>
    <div class="col"></div>
</div>

<form method="post" action="{{ url("/catalogos/puestos/editar/{$puesto->id_puesto}") }}">
    @csrf
    <div class="row my-2">
        <div class="form-group">
            <label for="nombre_puesto">Nombre:</label>
            <input type="text" maxlength="50" name="nombre_puesto" id="nombre_puesto" 
                   value="{{ old('nombre_puesto', $puesto->nombre_puesto) }}"
                   class="form-control" required autofocus>
        </div>
    </div>
    <div class="form-group my-2">
        <label for="sueldo">Sueldo:</label>
        <input type="number" name="sueldo" id="sueldo" 
               value="{{ old('sueldo', $puesto->sueldo) }}"
               class="form-control" required>
    </div>
    <div class="row my-2">
        <div class="col"></div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </div>
</form>
@endsection