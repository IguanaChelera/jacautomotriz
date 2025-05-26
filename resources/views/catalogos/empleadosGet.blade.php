@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row my-4">
    <div class="col">
        <h1>Empleados</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-agregar" href="{{ url('/catalogos/empleados/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">APELLIDOS</th>
        <th scope="col">PUESTO</th>
        <th scope="col">SUELDO</th>
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
                <td class="text-center">{{ $empleado->puesto->nombre_puesto }}</td>
                <td class="text-center">${{ number_format($empleado->puesto->sueldo, 2) }}</td>
                <td class="text-center">{{ $empleado->numeroSeguroSocial }}</td>
                <td class="text-center">{{ $empleado->experiencia }} años</td>
                <td class="text-center">{{ $empleado->estado ? 'Activo' : 'Inactivo'}}</td>
                <td class="text-center">
                    <a href="{{ url('/catalogos/empleados/editar/'.$empleado->id_Empleado) }}" 
                       class="btn btn-editar">Editar</a>
                    @php
                    $accion = $empleado->estado == 1 ? 'Dar de Baja' : 'Dar de Alta';
                    $clase = $empleado->estado == 1 ? 'btn-baja' : 'btn-alta';
                    @endphp

                    <a href="{{ url('/catalogos/empleados/alternar-estado/'.$empleado->id_Empleado) }}" 
                       class="btn {{ $clase }}"
                       onclick="return confirm('¿{{ $accion }} este empleado?')">
                        {{ $accion }}
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection