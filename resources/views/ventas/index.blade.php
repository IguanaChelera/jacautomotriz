@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Ventas</h1>

    {{-- Botón para agregar venta --}}
    <a href="{{ route('venta.create') }}" class="btn btn-success mb-3">Agregar Venta</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cita</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id_venta }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->fechaVenta }}</td>
                    <td>{{ $venta->horaVenta }}</td>
                    <td>{{ $venta->fk_id_cita }}</td>
                    <td>
                        {{-- Botón Editar --}}
                        <a href="{{ route('venta.edit', $venta->id_venta) }}" class="btn btn-primary btn-sm">Editar</a>

                        {{-- Botón Eliminar --}}
                        <form action="{{ route('venta.destroy', $venta->id_venta) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta venta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
