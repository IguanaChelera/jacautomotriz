@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Agregar Venta</h1>
    </div>
</div>

<form method="post" action="{{ url('catalogos/ventas/agregar') }}">
    @csrf
    <div class="row">
        <div class="coal-md-6">
            <div class="form-group my-2">
                <label for="fk_id_cita">Cita:</label>
                <select name="fk_id_cita" id="fk_id_cita" class="form-control" required>
                    <option value="">Seleccione una cita</option>
                    @foreach($citas as $cita)
                        <option value="{{ $cita->id_Cita }}">
                            {{ $cita->fechaCita }} - {{ $cita->horaCita }} - {{ $cita->marcaVehiculo }} {{ $cita->modeloVehiculo }}
                            @if($cita->ordenVenta)
                                (Orden Venta: #{{ $cita->ordenVenta->id_orden_venta }})
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group my-2">
                <label for="fk_id_servicio">Servicio:</label>
                <select name="fk_id_servicio" id="fk_id_servicio" class="form-control" required>
                    <option value="">Seleccione un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id_servicio }}" data-costo="{{ $servicio->costoServicio }}">
                            {{ $servicio->nombreServicio }} - ${{ number_format($servicio->costoServicio, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group my-2">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" required>
            </div>

            <div class="form-group my-2">
                <label for="fechaVenta">Fecha de Venta:</label>
                <input type="date" name="fechaVenta" id="fechaVenta" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="horaVenta">Hora de Venta:</label>
                <input type="time" name="horaVenta" id="horaVenta" class="form-control" value="{{ date('H:i') }}" required>
            </div>

            <div class="form-group my-2">
                <label for="subtotal">Subtotal:</label>
                <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
            </div>

            <div class="form-group my-2">
                <label for="total">Total:</label>
                <input type="text" name="total" id="total" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col text-end">
            <button type="submit" class="btn btn-primary">Guardar Venta</button>
        </div>
    </div>
</form>

<script>
    const citaSelect = document.getElementById('fk_id_cita');
    const servicioSelect = document.getElementById('fk_id_servicio');
    const cantidadInput = document.getElementById('cantidad');
    const subtotalInput = document.getElementById('subtotal');
    const totalInput = document.getElementById('total');

    function calcularTotal() {
        const costoServicio = parseFloat(servicioSelect.options[servicioSelect.selectedIndex].getAttribute('data-costo')) || 0;
        const cantidad = parseInt(cantidadInput.value) || 0;
        const subtotal = costoServicio * cantidad;
        const total = subtotal;  // Por ahora, el total es igual al subtotal (sin impuestos)

        subtotalInput.value = subtotal.toFixed(2);
        totalInput.value = total.toFixed(2);
    }

    servicioSelect.addEventListener('change', calcularTotal);
    cantidadInput.addEventListener('input', calcularTotal);

    calcularTotal();
</script>
@endsection