@extends('components.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Orden de Venta #{{ $ordenVenta->id_orden_venta }}</h4>
            <div>
                <a href="{{ route('orden_venta.pdf', $ordenVenta->id_orden_venta) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-pdf"></i> Generar PDF
                </a>
                <a href="{{ url('/catalogos/citas') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Datos del Cliente</h5>
                    <p><strong>Nombre:</strong> {{ $ordenVenta->cita->cliente->nombre }}</p>
                    <p><strong>Teléfono:</strong> {{ $ordenVenta->cita->cliente->telefono }}</p>
                    <p><strong>Correo:</strong> {{ $ordenVenta->cita->cliente->correo }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Datos del Vehículo</h5>
                    <p><strong>Marca/Modelo:</strong> {{ $ordenVenta->cita->marcaVehiculo }} {{ $ordenVenta->cita->modeloVehiculo }}</p>
                    <p><strong>Fecha Cita:</strong> {{ $ordenVenta->cita->fechaCita }}</p>
                    <p><strong>Hora Cita:</strong> {{ $ordenVenta->cita->horaCita }}</p>
                    <p><strong>Atendió:</strong> {{ $ordenVenta->empleado->nombre }} {{ $ordenVenta->empleado->apellidos }}</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Servicio</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-end">Precio Unitario</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordenVenta->servicios as $servicio)
                            <tr>
                                <td>{{ $servicio->nombreServicio }}</td>
                                <td class="text-center">{{ $servicio->pivot->cantidad }}</td>
                                <td class="text-end">${{ number_format($servicio->pivot->precio_unitario, 2) }}</td>
                                <td class="text-end">${{ number_format($servicio->pivot->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td class="text-end fw-bold">${{ number_format($ordenVenta->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection