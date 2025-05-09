@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

    <div class="row">
        <div class="form-group my-3">
            <h1>Editar Venta</h1>
        </div>
    </div>

    <form method="post" action="{{ url("/catalogos/ventas/editar/{$venta->id_venta}") }}">
    @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="fk_id_cita">Cita:</label>
                    <select name="fk_id_cita" id="fk_id_cita" class="form-control" required>
                        <option value="">Seleccione una cita</option>
                        @foreach($citas as $cita)
                            <option value="{{ $cita->id_Cita }}"
                                {{ old('fk_id_cita', $venta->fk_id_cita) == $cita->id_Cita ? 'selected' : '' }}>
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
                    <input type="date" name="fechaVenta" id="fechaVenta" class="form-control" value="{{ old('fechaVenta', $venta->fechaVenta) }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group my-2">
                    <label for="horaVenta">Hora de Venta:</label>
                    <input type="time" name="horaVenta" id="horaVenta" class="form-control" value="{{ old('horaVenta', $venta->horaVenta) }}" required>
                </div>
            </div>
        </div>

        <div class="card mb-4">
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
                        @foreach($venta->detallesServicio as $detalle)
                            <tr>
                                <td>{{ $detalle->servicio->nombreServicio }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>${{ number_format($detalle->servicio->costoServicio, 2) }}</td>
                                <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger eliminar-servicio">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <input type="hidden" name="servicios[{{ $detalle->servicio->id_servicio }}][id]" value="{{ $detalle->servicio->id_servicio }}">
                                    <input type="hidden" name="servicios[{{ $detalle->servicio->id_servicio }}][cantidad]" value="{{ $detalle->cantidad }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td id="totalOrden" class="fw-bold">${{ number_format($venta->total, 2) }}</td>
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
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
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
            
            let serviciosAgregados = @json($venta->detallesServicio->pluck('servicio.id_servicio')->toArray());
            let total = parseFloat({{ $venta->total }});

            agregarServicio.addEventListener('click', function() {
                const servicioId = servicioSelect.value;
                const servicioTexto = servicioSelect.options[servicioSelect.selectedIndex].text.split(' - ')[0];
                const precio = parseFloat(servicioSelect.options[servicioSelect.selectedIndex].dataset.precio);
                const cantidad = parseInt(cantidadServicio.value);

                if (!servicioId || isNaN(cantidad) || cantidad < 1) {
                    alert('Por favor seleccione un servicio y una cantidad válida');
                    return;
                }

                if (serviciosAgregados.includes(parseInt(servicioId))) {
                    alert('Este servicio ya fue agregado a la orden');
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

                serviciosAgregados.push(parseInt(servicioId));
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

                    const servicioId = parseInt(row.querySelector('input[type="hidden"]').value);
                    serviciosAgregados = serviciosAgregados.filter(id => id !== servicioId);

                    row.remove();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const citaSelect = document.getElementById('fk_id_cita');
            const serviciosTable = document.getElementById('serviciosTable').getElementsByTagName('tbody')[0];
            const totalOrden = document.getElementById('totalOrden');

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
                        let total = 0;

                        servicios.forEach(servicio => {
                            const row = serviciosTable.insertRow();
                            row.innerHTML = `
                                <td>${servicio.nombre}</td>
                                <td>${servicio.cantidad}</td>
                                <td>$${servicio.precio_unitario.toFixed(2)}</td>
                                <td>$${servicio.subtotal.toFixed(2)}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger eliminar-servicio">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <input type="hidden" name="servicios[${servicio.id}][id]" value="${servicio.id}">
                                    <input type="hidden" name="servicios[${servicio.id}][cantidad]" value="${servicio.cantidad}">
                                </td>
                            `;
                            total += servicio.subtotal;
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