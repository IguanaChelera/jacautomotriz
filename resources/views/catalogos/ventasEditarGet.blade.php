@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row">
    <div class="form-group my-3">
        <h1>Editar Venta</h1>
    </div>
</div>

<form method="post" action="{{ url('/catalogos/ventas/editar/' . $venta->id_venta) }}">
    @csrf
    @method('PUT') <div class="row">
        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="fk_id_cita">Cita:</label>
                <select name="fk_id_cita" id="fk_id_cita" class="form-control" required>
                    <option value="">Seleccione una cita</option>
                    @foreach($citas as $cita)
                        <option value="{{ $cita->id_Cita }}" {{ $venta->fk_id_cita == $cita->id_Cita ? 'selected' : '' }}>
                            {{ $cita->fechaCita }} - {{ $cita->horaCita }} - {{ $cita->marcaVehiculo }} {{ $cita->modeloVehiculo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group my-2">
                <label for="fk_id_servicio">Servicio:</label>
                <select name="fk_id_servicio" id="fk_id_servicio" class="form-control" required>
                    <option value="">Seleccione un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id_servicio }}" data-costo="{{ $servicio->costoServicio }}"
                            {{ $ventaDetalle->fk_id_servicio == $servicio->id_servicio ? 'selected' : '' }}>
                            {{ $servicio->nombreServicio }} - ${{ number_format($servicio->costoServicio, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group my-2">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $ventaDetalle->cantidad }}" min="1" required>
            </div>

            <div class="form-group my-2">
                <label for="fechaVenta">Fecha de Venta:</label>
                <input type="date" name="fechaVenta" id="fechaVenta" class="form-control" value="{{ $venta->fechaVenta }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="horaVenta">Hora de Venta:</label>
                <input type="time" name="horaVenta" id="horaVenta" class="form-control" value="{{ $venta->horaVenta }}" required>
            </div>

            <div class="form-group my-2">
                <label for="subtotal">Subtotal:</label>
                <input type="text" name="subtotal" id="subtotal" class="form-control" value="{{ $ventaDetalle->subtotal }}" readonly>
            </div>

            <div class="form-group my-2">
                <label for="total">Total:</label>
                <input type="text" name="total" id="total" class="form-control" value="{{ $venta->total }}" readonly>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col text-end">
            <button type="submit" class="btn btn-primary">Actualizar Venta</button>
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
        const total = subtotal;

        subtotalInput.value = subtotal.toFixed(2);
        totalInput.value = total.toFixed(2);
    }

    servicioSelect.addEventListener('change', calcularTotal);
    cantidadInput.addEventListener('input', calcularTotal);

    calcularTotal();
</script>
@endsection 