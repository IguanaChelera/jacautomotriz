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
Route::get("/catalogos/clientes/eliminar/{id}", [CatalogosController::class, 'clientesEliminarGet']);
Route::get("/catalogos/citas/cliente/{id}", [CatalogosController::class, 'citasPorCliente']);

//Citas
// Rutas para Citas
Route::prefix('catalogos')->group(function () {
    Route::get("/citas", [CitaController::class, 'citasGet'])->name('catalogos.citas');
    Route::get("/citas/agregar", [CitaController::class, 'citasAgregarGet'])->name('catalogos.citas.agregar');
    Route::post("/citas/agregar", [CitaController::class, 'citasAgregarPost'])->name('catalogos.citas.agregar.post');
    Route::get("/citas/editar/{id}", [CitaController::class, 'citasEditarGet'])->name('catalogos.citas.editar');
    Route::post("/citas/editar/{id}", [CitaController::class, 'citasEditarPost'])->name('catalogos.citas.editar.post');
    Route::get("/citas/cancelar/{id}", [CitaController::class, 'citasCancelarGet'])->name('catalogos.citas.cancelar');
});


//Ordenes de venta
// Rutas para Órdenes de Venta
Route::prefix('orden-venta')->group(function () {
     Route::get("/create/{cita}", [OrdenVentaController::class, 'create'])->name('orden_venta.create');
     Route::post("/store", [OrdenVentaController::class, 'store'])->name('orden_venta.store');
     Route::get("/{id}", [OrdenVentaController::class, 'show'])->name('orden_venta.show');
     Route::get("/{id}/edit", [OrdenVentaController::class, 'edit'])->name('orden_venta.edit');
     Route::get("/{id}/pdf", [OrdenVentaController::class, 'generatePdf'])->name('orden_venta.pdf');
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

//Ventas
// Rutas para Ventas
Route::get("/catalogos/ventas", [CatalogosController::class, "ventasGet"]);

Route::get("/reportes", [ReportesController::class, "indexGet"]);


