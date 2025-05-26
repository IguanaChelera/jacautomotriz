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
        <h1>Servicios</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-agregar" href="{{ url('/catalogos/servicios/agregar') }}">Agregar</a>
    </div>
</div>

{{-- Filtro de estado --}}
<form method="GET" action="{{ url('/catalogos/servicios') }}" class="mb-3">
    <div class="row g-2 align-items-center">
        <div class="col-auto">
            <label for="estado" class="col-form-label">Mostrar:</label>
        </div>
        <div class="col-auto">
            <select name="estado" id="estado" class="form-select" onchange="this.form.submit()">
                <option value="" {{ request('estado') === null || request('estado') === '' ? 'selected' : '' }}>Todos</option>
                <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activos</option>
                <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivos</option>
            </select>
        </div>
    </div>
</form>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Servicio</th>
            <th>Costo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id_servicio }}</td>
                <td>{{ $servicio->nombreServicio }}</td>
                <td>${{ number_format($servicio->costoServicio, 2) }}</td>
                <td>
                    @if($servicio->estado)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/catalogos/servicios/editar/'.$servicio->id_servicio) }}" 
                       class="btn btn-editar">Editar</a>
                    
                    @php
                    $accion = $servicio->estado ? 'Cancelar' : 'Activar';
                    $clase = $servicio->estado ? 'btn-baja' : 'btn-alta';
                    @endphp
                    <a href="{{ url('/catalogos/servicios/cambiar-estado/'.$servicio->id_servicio) }}" 
                    class="btn {{ $clase }}"
                    onclick="return confirm('¿{{ $accion }} este servicio?')">
                    {{ $accion }}
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection