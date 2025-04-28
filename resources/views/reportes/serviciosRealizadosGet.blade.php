@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Servicios Realizados</h1>
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
                        <th>Subtotal</th>
                        <th>Total Venta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviciosRealizados as $servicio)
                        <tr>
                            <td>{{ $servicio->id_servicio_venta }}</td>
                            <td>{{ $servicio->fecha }}</td>
                            <td>{{ $servicio->servicio }}</td>
                            <td>{{ $servicio->id_venta }}</td>
                            <td>${{ number_format($servicio->costoServicio, 2) }}</td>
                            <td>${{ number_format($servicio->subtotal, 2) }}</td>
                            <td>${{ number_format($servicio->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection