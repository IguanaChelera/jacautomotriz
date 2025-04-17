@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Agregar Cliente</h1>
    </div>
</div>

<form method="post" action="{{ url('/catalogos/clientes/agregar') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required autofocus>
            </div>
            
            <div class="form-group my-2">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control" required>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control">
            </div>
            
            <div class="form-group my-2">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control">
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