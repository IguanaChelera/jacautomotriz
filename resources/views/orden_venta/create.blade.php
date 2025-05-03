@extends('components.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Crear Orden de Venta</h4>
        </div>
        
        <div class="card-body">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5>Datos de la Cita</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> {{ $cita->cliente->nombre }}</p>
                            <p><strong>Teléfono:</strong> {{ $cita->cliente->telefono }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha:</strong> {{ $cita->fechaCita }}</p>
                            <p><strong>Hora:</strong> {{ $cita->horaCita }}</p>
                            <p><strong>Vehículo:</strong> {{ $cita->marcaVehiculo }} {{ $cita->modeloVehiculo }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('orden_venta.store') }}" method="POST" id="ordenVentaForm">
                @csrf
                <input type="hidden" name="id_cita" value="{{ $cita->id_Cita }}">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="id_empleado" class="form-label">Empleado Responsable</label>
                        <select name="id_empleado" id="id_empleado" class="form-select" required>
                            <option value="">Seleccione un empleado</option>
                            @foreach($empleados as $empleado)
                                <option value="{{ $empleado->id_Empleado }}">
                                    {{ $empleado->nombre }} {{ $empleado->apellidos }}
                                </option>
                            @endforeach
                        </select>
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
                
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/catalogos/citas') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Orden
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tu código JavaScript existente para manejar los servicios
    const servicioSelect = document.getElementById('servicioSelect');
    const cantidadServicio = document.getElementById('cantidadServicio');
    const agregarServicio = document.getElementById('agregarServicio');
    const serviciosTable = document.getElementById('serviciosTable').getElementsByTagName('tbody')[0];
    const totalOrden = document.getElementById('totalOrden');
    const ordenVentaForm = document.getElementById('ordenVentaForm');
    
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
});
</script>
@endsection
@endsection