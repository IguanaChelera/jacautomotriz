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
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="fk_id_servicio">Servicio:</label>
                    <select name="fk_id_servicio" id="fk_id_servicio" class="form-control" required onchange="colocarCosto()">
                        <option value="" disabled selected>Selecciona un servicio</option>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id_servicio }}" data-costo="{{ $servicio->costoServicio }}">
                                {{ $servicio->nombreServicio }} 
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-2">
                    <label for="costoServicio">Costo Servicio:</label>
                    <input type="number" step="0.01" name="costoServicio" id="costoServicio" class="form-control" readonly required>
                </div>

                <div class="form-group my-2">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="fechaVenta">Fecha:</label>
                    <input type="date" name="fechaVenta" id="fechaVenta" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group my-2">
                    <label for="horaVenta">Hora:</label>
                    <input type="time" name="horaVenta" id="horaVenta" class="form-control" value="{{ date('H:i') }}" required>
                </div>

                <div class="form-group my-2">
                    <label for="subtotal">Subtotal:</label>
                    <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" readonly required>
                </div>

                <div class="form-group my-2">
                    <label for="total">Total:</label>
                    <input type="number" step="0.01" name="total" id="total" class="form-control" readonly required>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col text-end">
                <button type="submit" class="btn btn-primary">Guardar Venta</button>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            const cantidadInput = document.getElementById('cantidad');
            const costoServicioInput = document.getElementById('costoServicio');
            const subtotalInput = document.getElementById('subtotal');
            const totalInput = document.getElementById('total');
            const servicioSelect = document.getElementById('fk_id_servicio');

            function calcularTotal() {
                const cantidad = parseFloat(cantidadInput.value) || 0;
                const costoServicio = parseFloat(costoServicioInput.value) || 0;
                const subtotal = cantidad * costoServicio;
                subtotalInput.value = subtotal.toFixed(2);
                totalInput.value = subtotal.toFixed(2); // El total es igual al subtotal
            }

            function colocarCosto() {
                const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
                const costo = selectedOption ? selectedOption.getAttribute('data-costo') : 0;
                
                if (costo) {
                    costoServicioInput.value = parseFloat(costo).toFixed(2);
                } else {
                    costoServicioInput.value = '';
                }

                calcularTotal(); // Recalcular automáticamente
            }

            // Event Listeners
            cantidadInput.addEventListener('input', calcularTotal);
        </script>
    @endpush
@endsection