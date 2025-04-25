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
        <h1>Citas</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/citas/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Vehículo</th>
            <th>Cliente</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($citas as $cita)
        <tr>
            <td>{{ $cita->id_Cita }}</td>
            <td>{{ \Carbon\Carbon::parse($cita->fechaCita)->format('d/m/Y') }}</td>
            <td>{{ $cita->horaCita }}</td>
            <td>{{ $cita->marcaVehiculo }} {{ $cita->modeloVehiculo }}</td>
            <td>{{ $cita->cliente->nombre ?? 'Cliente no encontrado' }}</td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ url('/catalogos/citas/editar/'.$cita->id_Cita) }}" 
                       class="btn btn-primary">Editar</a>
                    <a href="{{ url('/catalogos/citas/cancelar/'.$cita->id_Cita) }}" 
                       class="btn btn-danger"
                       onclick="return confirm('¿Cancelar esta cita?')">Cancelar</a>
                       <a href="{{ route('orden_venta.create', $cita->id_Cita) }}" 
                       class="btn btn-primary">Orden de Venta</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection