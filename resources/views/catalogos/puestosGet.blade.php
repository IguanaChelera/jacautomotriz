@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row my-4">
    <div class="col">
        <h1>Puestos</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/puestos/agregar') }}">Agregar</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE DEL PUESTO</th>
            <th scope="col">SUELDO</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($puestos as $puesto)
        <tr>
            <td class="text-center">{{ $puesto->id_puesto }}</td>
            <td class="text-center">{{ $puesto->nombre_puesto }}</td>
            <td class="text-center">{{ $puesto->sueldo }}</td>
            <td class="text-center">
                <a href="{{ url("/catalogos/puestos/editar/{$puesto->id_puesto}") }}" class="btn btn-primary">Editar</a>
                <a href={{ url("/catalogos/puestos/eliminar/{$puesto->id_puesto}") }}"  class="btn btn-danger"
                onclick="return confirm('¿Estás seguro de que quieres eliminar este puesto?')">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection