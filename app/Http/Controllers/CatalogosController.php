<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Venta;

class CatalogosController extends Controller
{
    public function home(): View {
        return view('home', ["breadcrumbs" => []]);
    }

    public function clientesGet(Request $request): View 
    {
        $clientes = Cliente::all();
        return view('catalogos.clientesGet', [
            "clientes" => $clientes,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Clientes" => url("/catalogos/clientes")
            ]
        ]);
    }
    public function citasGet(Request $request): View 
    {
        $citas = Cita::all();
        return view('catalogos.citasGet', [
            "citas" => $citas,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Citas" => url("/catalogos/citas")
            ]
        ]);
    }

    public function serviciosGet(Request $request): View 
    {
        $servicios = Servicio::all();
        return view('catalogos.serviciosGet', [
            "servicios" => $servicios,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Servicios" => url("/catalogos/servicios")
            ]
        ]);
    }
    
    public function empleadosGet(Request $request): View 
    {
        $empleados = Empleado::all();
        return view('catalogos.empleadosGet', [
            "empleados" => $empleados,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Empleados" => url("/catalogos/empleados")
            ]
        ]);
    }

    public function puestosGet(Request $request): View {
        $puestos = Puesto::all();
        return view ('catalogos.puestosGet', [
            "puestos" => $puestos,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Puestos" => url("/catalogos/puestos")
            ]
        ]);
    }

    public function ventasGet(Request $request): View {
        $ventas = Venta::all();
        return view ('catalogos.ventasGet', [
            "ventas" => $ventas,
            "breadcrumbs"  => [
                "Inicio" => url("/"),
                "Ventas" => url("/catalogos/ventas")
            ]
        ]);
    }
}
