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
                <input type="text" name="nombre" id="nombre" class="form-control" required autofocus pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
            </div>
            
            <div class="form-group my-2">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
            </div>
            
            <div class="form-group my-2">
                <label for="numeroSeguroSocial">Número Seguro Social:</label>
                <input type="text" name="numeroSeguroSocial" id="numeroSeguroSocial" class="form-control" required pattern="[0-9]+" title="Solo números">
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

            <div class="form-group my-2">
                <label for="sueldo">Sueldo:</label>
                <input type="number" name="sueldo" id="sueldo" class="form-control" required min="0" step="0.01" pattern="[0-9]+([.][0-9]+)?" title="Solo números">
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