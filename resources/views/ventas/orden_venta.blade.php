@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container">
    <!-- Datos de la Cita -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5>Datos de la Cita</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Cliente:</strong> {{ $cita->cliente->nombre }}</p>
                    <p><strong>Teléfono:</strong> {{ $cita->cliente->telefono }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Vehículo:</strong> {{ $cita->marcaVehiculo }} {{ $cita->modeloVehiculo }}</p>
                    <p><strong>Fecha:</strong> {{ date('d/m/Y', strtotime($cita->fechaCita)) }} a las {{ $cita->horaCita }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicios Realizados -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5>Servicios Realizados</h5>
        </div>
        <div class="card-body">
            <form id="ordenForm" method="POST" action="{{ route('ordenes.store') }}">
                @csrf
                <input type="hidden" name="fk_id_cita" value="{{ $cita->id_Cita }}">

                <table class="table" id="serviciosTable">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Costo Unitario</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="servicios[0][id_servicio]" class="form-control servicio-select" required>
                                    <option value="">Seleccionar servicio</option>
                                    @foreach($servicios as $servicio)
                                        <option value="{{ $servicio->id_servicio }}" 
                                            data-precio="{{ $servicio->costoServicio }}">
                                            {{ $servicio->nombreServicio }} (${{ number_format($servicio->costoServicio, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="servicios[0][precio]" 
                                       class="form-control precio" readonly>
                            </td>
                            <td>
                                <input type="number" name="servicios[0][cantidad]" 
                                       class="form-control cantidad" value="1" min="1" required>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="servicios[0][total]" 
                                       class="form-control total" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-editar-servicio ms-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total General:</strong></td>
                            <td>
                                <input type="number" step="0.01" name="total_general" 
                                       id="totalGeneral" class="form-control" readonly>
                            </td>
                            <td>
                                <button type="button" id="btnAgregarServicio" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Agregar
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/catalogos/citas') }}" class="btn btn-danger">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Orden
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Servicio -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-hidden="true">
    <!-- ... (mantener tu modal de edición actual) ... -->
</div>

<!-- Modal Recibo -->
<div class="modal fade" id="reciboModal" tabindex="-1" aria-hidden="true">
    <!-- ... (mantener tu modal de recibo actual) ... -->
</div>

<!-- Div oculto para datos de servicios -->
<div id="servicios-data" data-servicios='@json($servicios->map(function($s) {
    return [
        "id" => $s->id_servicio,
        "nombre" => $s->nombreServicio,
        "precio" => $s->costoServicio,
        "precio_formateado" => number_format($s->costoServicio, 2)
    ];
}))'></div>

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Obtener datos de servicios
    const serviciosData = JSON.parse(document.getElementById('servicios-data').dataset.servicios);
    let contadorFilas = 1;
    let servicioEditando = null;

    // Función para generar opciones de select
    function generarOpcionesServicios() {
        let options = '<option value="">Seleccionar servicio</option>';
        serviciosData.forEach(servicio => {
            options += `<option value="${servicio.id}" data-precio="${servicio.precio}">
                           ${servicio.nombre} ($${servicio.precio_formateado})
                        </option>`;
        });
        return options;
    }

    // Función para calcular y actualizar totales - CORREGIDA
    function actualizarTotales() {
        let totalGeneral = 0;
        
        $('tbody tr').each(function() {
            const precio = parseFloat($(this).find('.precio').val()) || 0;
            const cantidad = parseInt($(this).find('.cantidad').val()) || 0;
            const total = precio * cantidad;
            
            $(this).find('.total').val(total.toFixed(2));
            totalGeneral += total;
        });
        
        $('#totalGeneral').val(totalGeneral.toFixed(2));
    }

    // Evento al seleccionar un servicio
    $(document).on('change', '.servicio-select', function() {
        const selectedOption = $(this).find('option:selected');
        const precio = parseFloat(selectedOption.data('precio')) || 0;
        const fila = $(this).closest('tr');
        
        fila.find('.precio').val(precio.toFixed(2));
        fila.find('.cantidad').trigger('change');
    });

    // Evento al cambiar la cantidad
    $(document).on('change', '.cantidad', function() {
        const fila = $(this).closest('tr');
        const precio = parseFloat(fila.find('.precio').val()) || 0;
        const cantidad = parseInt($(this).val()) || 0;
        fila.find('.total').val((precio * cantidad).toFixed(2));
        actualizarTotales();
    });

    // Agregar nueva fila de servicio
    $('#btnAgregarServicio').click(function() {
        const nuevaFila = `
        <tr>
            <td>
                <select name="servicios[${contadorFilas}][id_servicio]" class="form-control servicio-select" required>
                    ${generarOpcionesServicios()}
                </select>
            </td>
            <td>
                <input type="number" step="0.01" name="servicios[${contadorFilas}][precio]" 
                       class="form-control precio" readonly>
            </td>
            <td>
                <input type="number" name="servicios[${contadorFilas}][cantidad]" 
                       class="form-control cantidad" value="1" min="1" required>
            </td>
            <td>
                <input type="number" step="0.01" name="servicios[${contadorFilas}][total]" 
                       class="form-control total" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-eliminar">
                    <i class="fas fa-trash"></i>
                </button>
                <button type="button" class="btn btn-warning btn-editar-servicio ms-1">
                    <i class="fas fa-edit"></i>
                </button>
            </td>
        </tr>`;
        $('#serviciosTable tbody').append(nuevaFila);
        contadorFilas++;
    });

    // Eliminar fila
    $(document).on('click', '.btn-eliminar', function() {
        if ($('#serviciosTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            actualizarTotales();
        } else {
            alert('Debe haber al menos un servicio');
        }
    });

    // Editar servicio
    $(document).on('click', '.btn-editar-servicio', function() {
        const fila = $(this).closest('tr');
        const servicioNombre = fila.find('.servicio-select option:selected').text().split('($')[0].trim();
        const precio = fila.find('.precio').val();
        
        servicioEditando = fila;
        
        $('#editarNombre').val(servicioNombre);
        $('#editarPrecio').val(precio);
        $('#editarModal').modal('show');
    });

    // Guardar cambios en edición
    $('#btnGuardarCambios').click(function() {
        const nuevoPrecio = parseFloat($('#editarPrecio').val());
        
        if (servicioEditando && !isNaN(nuevoPrecio)) {
            servicioEditando.find('.precio').val(nuevoPrecio.toFixed(2));
            servicioEditando.find('.cantidad').trigger('change');
            $('#editarModal').modal('hide');
        } else {
            alert('Por favor ingrese un precio válido');
        }
    });

    // Validar formulario antes de enviar
    $('#ordenForm').submit(function(e) {
        let valid = true;
        
        // Validar que todos los servicios tengan selección
        $('.servicio-select').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                valid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!valid) {
            e.preventDefault();
            alert('Por favor complete todos los servicios');
        }
    });
});
</script>
@endsection
@endsection