@extends("components.layout")
@section("content")
    @component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
    @endcomponent
<div class="container">
    <h1>Reporte Ventas Diarias</h1>

    <!-- Formulario para filtrar por fecha -->
    <form method="GET" action="{{ url('/reportes/reporte-ventas-diarias') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="fecha" class="form-label">Seleccionar Fecha:</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $fechaSeleccionada }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de resultados -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Servicio</th>
                <th>Costo</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reporteVentasDiarias as $venta)
                <tr>
                    <td>{{ $venta->id_venta }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>{{ $venta->servicio }}</td>
                    <td>${{ number_format($venta->costo, 2) }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay ventas para la fecha seleccionada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Mostrar el total de ventas -->
    <div class="mt-4">
        <h4>Total de Ventas: ${{ number_format($totalVentas, 2) }}</h4>
    </div>
</div>
@endsection