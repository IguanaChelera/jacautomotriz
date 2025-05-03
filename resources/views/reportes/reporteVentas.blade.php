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
                            <th>Total Venta</th>
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
                                <td>${{ number_format($ventaDetalle->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection