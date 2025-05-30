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
        <h1>Clientes</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/clientes/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id_cliente }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->correo ?? 'N/A' }}</td>
            <td>{{ $cliente->direccion ?? 'N/A' }}</td>
            <td>
                <a href="{{ url('/catalogos/clientes/editar/'.$cliente->id_cliente) }}" 
                   class="btn btn-editar">Editar</a>
                @php
                $accion = $cliente->activo ? 'Dar de Baja' : 'Dar de Alta';
                $clase = $cliente->activo ? 'btn-baja' : 'btn-alta';
                @endphp

                <a href="{{ url('/catalogos/clientes/alternar-estado/'.$cliente->id_cliente) }}" 
                class="btn {{ $clase }}"
                onclick="return confirm('¿{{ $accion }} este cliente?')">
                    {{ $accion }}
                </a>
                <a href="{{ url('/catalogos/citas/cliente/'.$cliente->id_cliente) }}" 
                   class="btn btn-info">Ver Citas</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection