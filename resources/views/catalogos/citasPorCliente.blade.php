@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container my-5">
    <h1 class="mb-4 text-center">Citas de {{ $cliente->nombre }}</h1>

    @if($citas->isEmpty())
        <p class="text-center">No hay citas registradas para este cliente.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Marca del Vehículo</th>
                    <th>Modelo del Vehículo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->fechaCita }}</td>
                        <td>{{ $cita->horaCita }}</td>
                        <td>{{ $cita->marcaVehiculo }}</td>
                        <td>{{ $cita->modeloVehiculo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
