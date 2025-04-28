<?php

use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ServicioController;
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

Route::get("/catalogos/citas", [CatalogosController::class, "citasGet"]);

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

// Rutas para ventas
Route::get("/catalogos/ventas", [CatalogosController::class, 'ventasGet']);
Route::get("/catalogos/ventas/agregar", [CatalogosController::class, 'ventasAgregarGet'])->name('ventas.agregar');
Route::post("/catalogos/ventas/agregar", [CatalogosController::class, 'ventasAgregarPost']);
Route::get("/catalogos/ventas/editar/{id}", [CatalogosController::class, 'ventasEditarGet']);
Route::post('/catalogos/ventas/editar/{id}', [CatalogosController::class, 'ventasEditarPost']);
Route::get("/catalogos/ventas/eliminar/{id}", [CatalogosController::class, 'ventasEliminarGet']);

//Reporte Servicios
Route::get('reportes/servicios-realizados', [ReportesController::class, 'serviciosRealizadosGet']);


