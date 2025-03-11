@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
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
            <th scope="col">ID</th>
            <th scope="col">FECHA</th>
            <th scope="col">HORA</th>
            <th scope="col">MARCA DEL VEHICULO</th>
            <th scope="col">MODELO DEL VEHICULO</th>
            <th scope="col">FK CLIENTE</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($citas as $cita)
        <tr>
            <td class="text-center">{{ $cita->id_Cita }}</td>
            <td class="text-center">{{ $cita->fechaCita }}</td>
            <td class="text-center">{{ $cita->horaCita }}</td>
            <td class="text-center">{{ $cita->marcaVehiculo }}</td>
            <td class="text-center">{{ $cita->modeloVehiculo }}</td>
            <td class="text-center">{{ $cita->fk_id_cliente }}</td>
            <td class="text-center">
                <a href="{{ url('/catalogos/citas/editar/' . $cita->id_Cita) }}" class="btn btn-primary">Editar</a>
                <a href="{{ url('/catalogos/citas/eliminar/' . $cita->id_Cita) }}" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection