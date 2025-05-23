@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Agregar Empleado</h1>
    </div>
</div>

<form method="post" action="{{ url('/catalogos/empleados/agregar') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required autofocus>
            </div>
            
            <div class="form-group my-2">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" required>
            </div>
            
            <div class="form-group my-2">
                <label for="numeroSeguroSocial">Número Seguro Social:</label>
                <input type="text" name="numeroSeguroSocial" id="numeroSeguroSocial" class="form-control" required>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="fk_id_puesto">Puesto:</label>
                <select name="fk_id_puesto" id="fk_id_puesto" class="form-control" required>
                    @foreach($puestos as $puesto)
                        <option value="{{ $puesto->id_puesto }}">
                            {{ $puesto->nombre_puesto }} - ${{ number_format($puesto->sueldo, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group my-2">
                <label for="experiencia">Experiencia (años):</label>
                <input type="number" name="experiencia" id="experiencia" min="0" class="form-control" required>
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
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection