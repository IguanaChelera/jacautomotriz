<?php

use App\Http\Controllers\CatalogosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () 
{
    return view('home', ["breadcrumbs" => []]);
});

Route::get("/catalogos/clientes", [CatalogosController::class, "clientesGet"]);
Route::get("/catalogos/citas", [CatalogosController::class, "citasGet"]);
Route::get("/catalogos/servicios", [CatalogosController::class, "serviciosGet"]);
Route::get("/catalogos/empleados", [CatalogosController::class, "empleadosGet"]);
Route::get("/catalogos/puestos", [CatalogosController::class, "puestosGet"]);
Route::get("/catalogos/ventas", [CatalogosController::class, "ventasGet"]);

