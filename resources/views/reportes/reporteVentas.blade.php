@extends("components.layout")
@section("content")
    @component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="form-group my-3">
            <h1>Reporte Ventas</h1> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Formulario para filtros de fecha -->
            <form method="GET" action="{{ route('reporteVentas') }}" class="form-inline mb-3 p-3 bg-light rounded shadow-sm d-flex justify-content-start align-items-center">
                <label for="fecha_inicio" class="mr-2 font-weight-bold">Fecha Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control form-control-sm mr-4" style="width: 150px;" value="{{ request('fecha_inicio') }}">
                
                <label for="fecha_fin" class="mr-2 font-weight-bold">Fecha Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control form-control-sm mr-3" style="width: 150px;" value="{{ request('fecha_fin') }}">
                
                <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Servicio Venta</th>
                            <th>Fecha</th>
                            <th>Servicio</th>
                            <th>ID Venta</th>
                            <th>Costo Servicio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reporteVentas as $ventaDetalle)
                            <tr>
                                <td>{{ $ventaDetalle->id_servicio_venta }}</td>
                                <td>{{ $ventaDetalle->fecha }}</td>
                                <td>{{ $ventaDetalle->servicio }}</td>
                                <td>{{ $ventaDetalle->id_venta }}</td>
                                <td>${{ number_format($ventaDetalle->costoServicio, 2) }}</td>
                                <td>{{ $ventaDetalle->cantidad }}</td>
                                <td>${{ number_format($ventaDetalle->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection