@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Editar Empleado</h1>
    </div>
</div>

<form method="post" action="{{ url("/catalogos/empleados/editar/{$empleado->id_Empleado}") }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" 
                       value="{{ old('nombre', $empleado->nombre) }}" class="form-control" required autofocus>
            </div>
            
            <div class="form-group my-2">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" 
                       value="{{ old('apellidos', $empleado->apellidos) }}" class="form-control" required>
            </div>
            
            <div class="form-group my-2">
                <label for="numeroSeguroSocial">Número Seguro Social:</label>
                <input type="text" name="numeroSeguroSocial" id="numeroSeguroSocial" 
                       value="{{ old('numeroSeguroSocial', $empleado->numeroSeguroSocial) }}" class="form-control" required>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="fk_id_puesto">Puesto:</label>
                <select name="fk_id_puesto" id="fk_id_puesto" class="form-control" required>
                    @foreach($puestos as $puesto)
                        <option value="{{ $puesto->id_puesto }}" 
                            {{ old('fk_id_puesto', $empleado->fk_id_puesto) == $puesto->id_puesto ? 'selected' : '' }}>
                            {{ $puesto->nombre_puesto }} - ${{ number_format($puesto->sueldo, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group my-2">
                <label for="experiencia">Experiencia (años):</label>
                <input type="number" name="experiencia" id="experiencia" min="0"
                       value="{{ old('experiencia', $empleado->experiencia) }}" class="form-control" required>
            </div>
            
            <div class="form-group my-2">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="1" {{ old('estado', $empleado->estado) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $empleado->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="row my-3">
        <div class="col text-end">
            <button type="submit" class="btn btn-agregar">Guardar cambios</button>
        </div>
    </div>
</form>
@endsection