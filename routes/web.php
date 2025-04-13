<?php

use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () 
{
    return view('home', ["breadcrumbs" => []]);
});

Route::get("/catalogos/clientes", [CatalogosController::class, "clientesGet"]);
Route::get("/catalogos/citas", [CatalogosController::class, "citasGet"]);

Route::get("/catalogos/servicios", [CatalogosController::class, "serviciosGet"]);

//Empelados
Route::get("/catalogos/empleados", [CatalogosController::class, "empleadosGet"]);
Route::get('/catalogos/empleados/agregar', [App\Http\Controllers\CatalogosController::class, 'empleadosAgregarGet']);
Route::post('/catalogos/empleados/agregar', [App\Http\Controllers\CatalogosController::class, 'empleadosAgregarPost']);


//Puestos
Route::get("/catalogos/puestos", [CatalogosController::class, 'puestosGet']);
Route::get("/catalogos/puestos/agregar", [CatalogosController::class, 'puestosAgregarGet']);
Route::post("/catalogos/puestos/agregar", [CatalogosController::class, 'puestosAgregarPost']);
// Rutas existentes
Route::get("/catalogos/puestos", [CatalogosController::class, 'puestosGet']);
Route::get("/catalogos/puestos/agregar", [CatalogosController::class, 'puestosAgregarGet']);
Route::post("/catalogos/puestos/agregar", [CatalogosController::class, 'puestosAgregarPost']);
Route::get("/catalogos/puestos/editar/{id}", [CatalogosController::class, 'puestosEditarGet']);
Route::post("/catalogos/puestos/editar/{id}", [CatalogosController::class, 'puestosEditarPost']);
Route::get("/catalogos/puestos/eliminar/{id}", [CatalogosController::class, 'puestosEliminarGet']);

Route::get("/catalogos/ventas", [CatalogosController::class, "ventasGet"]);

Route::get("/reportes", [ReportesController::class, "indexGet"]);


