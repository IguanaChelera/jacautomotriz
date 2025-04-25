@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($venta) ? 'Editar Venta' : 'Agregar Venta' }}</h2>

    <form action="{{ isset($venta) ? route('venta.update', $venta->id_venta) : route('venta.store') }}" method="POST">
        @csrf
        @if(isset($venta))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" class="form-control" step="0.01" value="{{ old('total', $venta->total ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="fechaVenta" class="form-label">Fecha</label>
            <input type="date" name="fechaVenta" class="form-control" value="{{ old('fechaVenta', $venta->fechaVenta ?? date('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="horaVenta" class="form-label">Hora</label>
            <input type="time" name="horaVenta" class="form-control" value="{{ old('horaVenta', $venta->horaVenta ?? date('H:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="fk_id_cita" class="form-label">ID Cita</label>
            <input type="number" name="fk_id_cita" class="form-control" value="{{ old('fk_id_cita', $venta->fk_id_cita ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($venta) ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('venta.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
