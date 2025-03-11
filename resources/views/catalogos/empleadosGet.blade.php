@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row my-4">
    <div class="col">
        <h1>Empleados</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/empleados/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDOS</th>
            <th scope="col">NUMERO DE SEGURO SOCIAL</th>
            <th scope="col">EXPERIENCIA</th>
            <th scope="col">ESTADO</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td class="text-center">{{ $empleado->id_Empleado }}</td>
            <td class="text-center">{{ $empleado->nombre }}</td>
            <td class="text-center">{{ $empleado->apellidos }}</td>
            <td class="text-center">{{ $empleado->numeroSeguroSocial }}</td>
            <td class="text-center">{{ $empleado->experiencia }}</td>
            <td class="text-center">{{ $empleado->estado }}</td>
            <td class="text-center">
                <a href="{{ url('/catalogos/empleados/editar/' . $empleado->id_Empleado) }}" class="btn btn-primary">Editar</a>
                <a href="{{ url('/catalogos/empleados/eliminar/' . $empleado->id_Empleado) }}" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection