@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Editar Cliente</h1>
    </div>
</div>

<form method="post" action="{{ url("/catalogos/clientes/editar/{$cliente->id_cliente}") }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" 
                       value="{{ old('nombre', $cliente->nombre) }}" class="form-control" required autofocus pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
            </div>
            
            <div class="form-group my-2">
                <label for="telefono">Teléfono:</label>
                <input type="tel" name="telefono" id="telefono" 
                       value="{{ old('telefono', $cliente->telefono) }}" class="form-control" required pattern="[0-9]{10,}" minlength="10" maxlength="20" title="Solo números, mínimo 10 dígitos">
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" 
                       value="{{ old('correo', $cliente->correo) }}" class="form-control" pattern="[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+" title="Por favor, ingresa un correo electrónico válido que contenga un '@'">
            </div>
            
            <div class="form-group my-2">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" 
                       value="{{ old('direccion', $cliente->direccion) }}" class="form-control">
            </div>
        </div>
    </div>
    
    <div class="row my-3">
        <div class="col text-end">
            <button type="submit" class="btn btn-editar">Guardar cambios</button>
        </div>
    </div>
</form>
@endsection