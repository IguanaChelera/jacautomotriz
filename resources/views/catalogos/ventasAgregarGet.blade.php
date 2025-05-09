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
                <label for="fechaVenta">Fecha de Venta:</label>
                <input type="date" name="fechaVenta" id="fechaVenta" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group my-2">
                <label for="horaVenta">Hora de Venta:</label>
                <input type="time" name="horaVenta" id="horaVenta" class="form-control" value="{{ date('H:i') }}" required>
            </div>
        </div>
    </div>

    <div class="card my-4">
        <div class="card-header bg-light">
            <h5>Servicios</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="serviciosTable">
                <thead class="table-light">
                    <tr>
                        <th width="40%">Servicio</th>
                        <th width="15%">Cantidad</th>
                        <th width="20%">Precio Unitario</th>
                        <th width="20%">Subtotal</th>
                        <th width="5%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows will be added here -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total:</td>
                        <td id="totalOrden" class="fw-bold">$0.00</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="row mt-3">
                <div class="col-md-5">
                    <select id="servicioSelect" class="form-select">
                        <option value="">Seleccione un servicio</option>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id_servicio }}" data-precio="{{ $servicio->costoServicio }}">
                                {{ $servicio->nombreServicio }} - ${{ number_format($servicio->costoServicio, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" id="cantidadServicio" class="form-control" min="1" value="1">
                </div>
                <div class="col-md-2">
                    <button type="button" id="agregarServicio" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar
                    </button>
                </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const servicioSelect = document.getElementById('servicioSelect');
    const cantidadServicio = document.getElementById('cantidadServicio');
    const agregarServicio = document.getElementById('agregarServicio');
    const serviciosTable = document.getElementById('serviciosTable').getElementsByTagName('tbody')[0];
    const totalOrden = document.getElementById('totalOrden');
    const citaSelect = document.getElementById('fk_id_cita');

    let serviciosAgregados = [];
    let total = 0;

    agregarServicio.addEventListener('click', function() {
        const servicioId = servicioSelect.value;
        const servicioTexto = servicioSelect.options[servicioSelect.selectedIndex].text.split(' - ')[0];
        const precio = parseFloat(servicioSelect.options[servicioSelect.selectedIndex].dataset.precio);
        const cantidad = parseInt(cantidadServicio.value);

        if (!servicioId || isNaN(cantidad) || cantidad < 1) {
            alert('Por favor seleccione un servicio y una cantidad válida');
            return;
        }

        if (serviciosAgregados.includes(servicioId)) {
            alert('Este servicio ya fue agregado a la venta');
            return;
        }

        const subtotal = precio * cantidad;

        const row = serviciosTable.insertRow();
        row.innerHTML = `
            <td>${servicioTexto}</td>
            <td>${cantidad}</td>
            <td>$${precio.toFixed(2)}</td>
            <td>$${subtotal.toFixed(2)}</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger eliminar-servicio">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <input type="hidden" name="servicios[${servicioId}][id]" value="${servicioId}">
                <input type="hidden" name="servicios[${servicioId}][cantidad]" value="${cantidad}">
            </td>
        `;

        serviciosAgregados.push(servicioId);
        total += subtotal;
        totalOrden.textContent = `$${total.toFixed(2)}`;

        servicioSelect.value = '';
        cantidadServicio.value = 1;
    });

    serviciosTable.addEventListener('click', function(e) {
        if (e.target.classList.contains('eliminar-servicio') || e.target.closest('.eliminar-servicio')) {
            const row = e.target.closest('tr');
            const subtotal = parseFloat(row.cells[3].textContent.replace('$', ''));

            total -= subtotal;
            totalOrden.textContent = `$${total.toFixed(2)}`;

            const servicioId = row.querySelector('input[type="hidden"]').value;
            serviciosAgregados = serviciosAgregados.filter(id => id !== servicioId);

            row.remove();
        }
    });

    citaSelect.addEventListener('change', function() {
        const citaId = this.value;

        if (!citaId) {
            serviciosTable.innerHTML = '';
            totalOrden.textContent = '$0.00';
            return;
        }

        fetch(`/catalogos/citas/${citaId}/servicios`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudieron cargar los servicios.');
                }
                return response.json();
            })
            .then(servicios => {
                serviciosTable.innerHTML = '';
                serviciosAgregados = [];
                total = 0;

                servicios.forEach(servicio => {
                    const precioUnitario = parseFloat(servicio.precio_unitario) || 0; // Asegura que sea un número
                    const subtotal = parseFloat(servicio.subtotal) || 0; // Asegura que sea un número

                    const row = serviciosTable.insertRow();
                    row.innerHTML = `
                        <td>${servicio.nombre}</td>
                        <td>${servicio.cantidad}</td>
                        <td>$${precioUnitario.toFixed(2)}</td>
                        <td>$${subtotal.toFixed(2)}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger eliminar-servicio">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <input type="hidden" name="servicios[${servicio.id}][id]" value="${servicio.id}">
                            <input type="hidden" name="servicios[${servicio.id}][cantidad]" value="${servicio.cantidad}">
                        </td>
                    `;
                    serviciosAgregados.push(servicio.id);
                    total += subtotal;
                });

                totalOrden.textContent = `$${total.toFixed(2)}`;
            })
            .catch(error => {
                alert(error.message);
            });
    });
});
</script>
@endsection