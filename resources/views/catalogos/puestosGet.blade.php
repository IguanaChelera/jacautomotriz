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
                @if($puesto->estado === 'activo')
                    <span class="badge bg-success">Activo</span>
                @elseif($puesto->estado === 'inactivo')
                    <span class="badge bg-secondary">Inactivo</span>
                @elseif($puesto->estado === 'pendiente')
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @elseif($puesto->estado === 'eliminado')
                    <span class="badge bg-danger">Eliminado</span>
                @endif
            </td>
            <td class="text-center">
                <a href="{{ url('/catalogos/puestos/editar/'.$puesto->id_puesto) }}" 
                   class="btn btn-primary">Editar</a>
                @php
                // Define el siguiente estado y el texto del botón según el estado actual
                switch($puesto->estado) {
                    case 'activo':
                        $accion = 'Inactivar';
                        $nuevoEstado = 'inactivo';
                        $clase = 'btn-warning';
                        break;
                    case 'inactivo':
                        $accion = 'Activar';
                        $nuevoEstado = 'activo';
                        $clase = 'btn-success';
                        break;
                    case 'pendiente':
                        $accion = 'Activar';
                        $nuevoEstado = 'activo';
                        $clase = 'btn-success';
                        break;
                    case 'eliminado':
                        $accion = 'Restaurar';
                        $nuevoEstado = 'activo';
                        $clase = 'btn-info';
                        break;
                    default:
                        $accion = '';
                        $nuevoEstado = '';
                        $clase = '';
                }
                @endphp
                @if($puesto->estado !== 'eliminado')
                <a href="{{ url('/catalogos/puestos/cambiar-estado/'.$puesto->id_puesto.'?estado='.$nuevoEstado) }}" 
                   class="btn {{ $clase }}"
                   onclick="return confirm('¿{{ $accion }} este puesto?')">
                    {{ $accion }}
                </a>
                <a href="{{ url('/catalogos/puestos/cambiar-estado/'.$puesto->id_puesto.'?estado=eliminado') }}" 
                   class="btn btn-danger"
                   onclick="return confirm('¿Eliminar este puesto?')">
                    Eliminar
                </a>
                @else
                <a href="{{ url('/catalogos/puestos/cambiar-estado/'.$puesto->id_puesto.'?estado=activo') }}" 
                   class="btn btn-info"
                   onclick="return confirm('¿Restaurar este puesto?')">
                    Restaurar
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection