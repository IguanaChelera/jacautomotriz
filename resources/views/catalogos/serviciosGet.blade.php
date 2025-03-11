@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row my-4">
    <div class="col">
        <h1>Servicios</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/servicios/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">ESTADO</th>
            <th scope="col">COSTO</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($servicios as $servicio)
        <tr>
            <td class="text-center">{{ $servicio->id_servicio }}</td>
            <td class="text-center">{{ $servicio->nombreServicio }}</td>
            <td class="text-center">{{ $servicio->estado }}</td>
            <td class="text-center">{{ $servicio->costoServicio }}</td>
            <td class="text-center">
                <a href="{{ url('/catalogos/servicios/editar/' . $servicio->id_servicio) }}" class="btn btn-primary">Editar</a>
                <a href="{{ url('/catalogos/servicios/eliminar/' . $servicio->id_servicio) }}" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection