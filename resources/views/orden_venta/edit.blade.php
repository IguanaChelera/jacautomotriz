@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Orden de Venta #{{ $ordenVenta->id_orden_venta }}</h1>

    <form action="{{ route('orden_venta.update', $ordenVenta->id_orden_venta) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Cliente --}}
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control" value="{{ $ordenVenta->cliente->nombre }}" disabled>
        </div>

        {{-- Vehículo --}}
        <div class="mb-3">
            <label for="vehiculo" class="form-label">Vehículo</label>
            <input type="text" name="vehiculo" id="vehiculo" class="form-control" value="{{ $ordenVenta->cita->vehiculo->marca_modelo }}" disabled>
        </div>

        {{-- Fecha y hora --}}
        <div class="mb-3">
            <label for="fecha_cita" class="form-label">Fecha de la Cita</label>
            <input type="date" name="fecha_cita" class="form-control" value="{{ $ordenVenta->cita->fecha }}" disabled>
        </div>
        <div class="mb-3">
            <label for="hora_cita" class="form-label">Hora de la Cita</label>
            <input type="time" name="hora_cita" class="form-control" value="{{ $ordenVenta->cita->hora }}" disabled>
        </div>

        {{-- Servicios (ejemplo simple) --}}
        <div class="mb-3">
            <label for="servicio" class="form-label">Servicio</label>
            <input type="text" name="servicio" id="servicio" class="form-control" value="{{ $ordenVenta->detalleServicios[0]->servicio->nombre }}">
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $ordenVenta->detalleServicios[0]->cantidad }}">
        </div>
        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="text" name="precio_unitario" id="precio_unitario" class="form-control" value="{{ $ordenVenta->detalleServicios[0]->precio_unitario }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('orden_venta.show', $ordenVenta->id_orden_venta) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
