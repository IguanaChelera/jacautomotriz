@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row my-4">
    <div class="col">
        <h1>Clientes</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/clientes/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">TELEFONO</th>
            <th scope="col">CORREO</th>
            <th scope="col">DIRECCION</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td class="text-center">{{ $cliente->id_cliente }}</td>
            <td class="text-center">{{ $cliente->nombre }}</td>
            <td class="text-center">{{ $cliente->telefono }}</td>
            <td class="text-center">{{ $cliente->correo }}</td>
            <td class="text-center">{{ $cliente->direccion }}</td>
            <td class="text-center">
                <a href="{{ url('/catalogos/clientes/editar/' . $cliente->id_cliente) }}" class="btn btn-primary">Editar</a>
                <a href="{{ url('/catalogos/clientes/eliminar/' . $cliente->id_cliente) }}" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection