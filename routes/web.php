<?php

use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\OrdenVentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () 
{
    return view('home', ["breadcrumbs" => []]);
});

//Clientes
// Rutas para Clientes
Route::get("/catalogos/clientes", [CatalogosController::class, 'clientesGet']);
Route::get("/catalogos/clientes/agregar", [CatalogosController::class, 'clientesAgregarGet']);
Route::post("/catalogos/clientes/agregar", [CatalogosController::class, 'clientesAgregarPost']);
Route::get("/catalogos/clientes/editar/{id}", [CatalogosController::class, 'clientesEditarGet']);
Route::post("/catalogos/clientes/editar/{id}", [CatalogosController::class, 'clientesEditarPost']);
Route::get('/catalogos/clientes/alternar-estado/{id}', [CatalogosController::class, 'alternarEstado']);
Route::get("/catalogos/citas/cliente/{id}", [CatalogosController::class, 'citasPorCliente']);

//Citas
// Rutas para Citas
Route::get("/catalogos/citas", [CitaController::class, 'citasGet']);
Route::get("/catalogos/citas/agregar", [CitaController::class, 'citasAgregarGet']);
Route::post("/catalogos/citas/agregar", [CitaController::class, 'citasAgregarPost']);
Route::get("/catalogos/citas/editar/{id}", [CitaController::class, 'citasEditarGet']);
Route::post("/catalogos/citas/editar/{id}", [CitaController::class, 'citasEditarPost']);
Route::get("/catalogos/citas/cancelar/{id}", [CitaController::class, 'citasCancelarGet']);
Route::get("/catalogos/citas/generar-orden/{id}", [CitaController::class, 'generarOrdenVentaGet']);
Route::get('/catalogos/citas/{id}/servicios', [CatalogosController::class, 'obtenerServiciosPorCita']);

//Ordenes de venta
// Rutas para Órdenes de Venta
Route::prefix('catalogos/citas')->group(function() {
     Route::get('/generar-orden/{id}', [OrdenVentaController::class, 'createFromCita'])
          ->name('ordenes.create.from.cita');
     Route::post('/ordenes-venta', [OrdenVentaController::class, 'store'])
          ->name('ordenes.store');
 });

//Servicios
// Rutas para Servicios
Route::get("/catalogos/servicios", [ServicioController::class, 'serviciosGet']);
Route::get("/catalogos/servicios/agregar", [ServicioController::class, 'serviciosAgregarGet']);
Route::post("/catalogos/servicios/agregar", [ServicioController::class, 'serviciosAgregarPost']);
Route::get("/catalogos/servicios/editar/{id}", [ServicioController::class, 'serviciosEditarGet']);
Route::post("/catalogos/servicios/editar/{id}", [ServicioController::class, 'serviciosEditarPost']);
Route::get("/catalogos/servicios/cambiar-estado/{id}", [ServicioController::class, 'serviciosCambiarEstado']);

//Empelados
// Rutas para Empleados
Route::get("/catalogos/empleados", [CatalogosController::class, 'empleadosGet']);
Route::get("/catalogos/empleados/agregar", [CatalogosController::class, 'empleadosAgregarGet']);
Route::post("/catalogos/empleados/agregar", [CatalogosController::class, 'empleadosAgregarPost']);
Route::get("/catalogos/empleados/editar/{id}", [CatalogosController::class, 'empleadosEditarGet']);
Route::post("/catalogos/empleados/editar/{id}", [CatalogosController::class, 'empleadosEditarPost']);
Route::get("/catalogos/empleados/eliminar/{id}", [CatalogosController::class, 'empleadosEliminarGet']);


//Puestos
// Rutas para Puestos
Route::get("/catalogos/puestos", [CatalogosController::class, 'puestosGet']);
Route::get("/catalogos/puestos/agregar", [CatalogosController::class, 'puestosAgregarGet']);
Route::post("/catalogos/puestos/agregar", [CatalogosController::class, 'puestosAgregarPost']);
Route::get("/catalogos/puestos/editar/{id}", [CatalogosController::class, 'puestosEditarGet']);
Route::post("/catalogos/puestos/editar/{id}", [CatalogosController::class, 'puestosEditarPost']);
Route::get("/catalogos/puestos/eliminar/{id}", [CatalogosController::class, 'puestosEliminarGet']);

Route::get("/reportes", [ReportesController::class, "indexGet"]);

// Rutas para generar recibo de orden de venta
Route::prefix('orden-venta')->group(function () {
     Route::get("/{id}/edit", [OrdenVentaController::class, 'edit'])->name('orden_venta.edit');
     Route::get("/create/{cita}", [OrdenVentaController::class, 'create'])->name('orden_venta.create');
     Route::post("/store", [OrdenVentaController::class, 'store'])->name('orden_venta.store');
     Route::get("/{id}", [OrdenVentaController::class, 'show'])->name('orden_venta.show');
     Route::get("/{id}/pdf", [OrdenVentaController::class, 'generatePdf'])->name('orden_venta.pdf');
     Route::get("/{id}/edit", [OrdenVentaController::class, 'edit'])->name('orden_venta.edit');
     Route::post("/{id}", [OrdenVentaController::class, 'update'])->name('orden_venta.update');

 });

// Rutas para ventas
Route::get('/catalogos/ventas', [CatalogosController::class, 'ventasGet'])->name('ventas.index');
Route::get("/catalogos/ventas/agregar", [CatalogosController::class, 'ventasAgregarGet'])->name('ventas.agregar');
Route::post("/catalogos/ventas/agregar", [CatalogosController::class, 'ventasAgregarPost']);
Route::get("/catalogos/ventas/editar/{id}", [CatalogosController::class, 'ventasEditarGet']);

Route::get("/catalogos/ventas/eliminar/{id}", [CatalogosController::class, 'ventasEliminarGet']);
Route::post('/catalogos/ventas/editar/{id}', [CatalogosController::class, 'ventasEditarPost'])->name('ventas.update');
//Reporte ventas
Route::get('reportes/reporte-ventas', [ReportesController::class, 'reporteVentas'])->name('reporteVentas');
Route::get('reportes/reporte-ventas-diarias', [ReportesController::class, 'reporteVentasDiarias'])->name('reporteVentasDiarias');
// Reportes
Route::get("/reportes/servicio-mayor-solicitado", [ReportesController::class, "servicioMayorSolicitado"]);
Route::get("/reportes/clientes-frecuentes", [ReportesController::class, "clientesFrecuentes"]);
Route::get("/reportes/servicios-realizados-por-mes", [ReportesController::class, "serviciosRealizadosPorMes"]);


