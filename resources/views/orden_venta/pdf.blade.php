<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orden de Venta #{{ $ordenVenta->id_orden_venta }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .info { margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .text-end { text-align: right; }
        .total { font-weight: bold; font-size: 16px; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Taller Mecánico</div>
        <div>Orden de Venta #{{ $ordenVenta->id_orden_venta }}</div>
        <div>Fecha: {{ date('d/m/Y', strtotime($ordenVenta->fecha)) }}</div>
    </div>
    
    <div class="info">
        <p><strong>Cliente:</strong> {{ $ordenVenta->cita->cliente->nombre }}</p>
        <p><strong>Teléfono:</strong> {{ $ordenVenta->cita->cliente->telefono }}</p>
        <p><strong>Vehículo:</strong> {{ $ordenVenta->cita->marcaVehiculo }} {{ $ordenVenta->cita->modeloVehiculo }}</p>
        <p><strong>Empleado:</strong> {{ $ordenVenta->empleado->nombre }} {{ $ordenVenta->empleado->apellidos }}</p>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordenVenta->servicios as $servicio)
                <tr>
                    <td>{{ $servicio->nombreServicio }}</td>
                    <td>{{ $servicio->pivot->cantidad }}</td>
                    <td>${{ number_format($servicio->pivot->precio_unitario, 2) }}</td>
                    <td>${{ number_format($servicio->pivot->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end total">Total:</td>
                <td class="total">${{ number_format($ordenVenta->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
    
    <div class="footer">
        <p>Gracias por su preferencia</p>
        <p>Taller Mecánico - Tel: 555-123-4567</p>
    </div>
</body>
</html>