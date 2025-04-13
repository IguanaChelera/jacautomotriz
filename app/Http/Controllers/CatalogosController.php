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
        public function empleadosAgregarGet()
    {
        $puestos = Puesto::all();
        $breadcrumbs = [
            ["nombre" => "Inicio", "url" => "/"],
            ["nombre" => "Catálogos", "url" => "/catalogos"],
            ["nombre" => "Agregar Empleado", "url" => "/catalogos/empleados/agregar"],
        ];

        return view('catalogos.empleadosAgregarGet', compact('puestos', 'breadcrumbs'));
    }

    public function empleadosAgregarPost(Request $request)
    {
        $empleado = new Empleado();
        $empleado->nombre = $request->input('nombre');
        $empleado->fecha_ingreso = $request->input('fecha_ingreso');
        $empleado->id_puesto = $request->input('puesto');
        $empleado->activo = $request->input('activo');
        $empleado->save();

        return redirect('/catalogos/empleados/agregar')->with('success', 'Empleado registrado correctamente');
    }

    public function puestosGet(): View
    {
        $puestos = Puesto::all();
        return view('catalogos.puestosGet', [
            'puestos' => $puestos, 
            'breadcrumbs' => [
                'Inicio' => url('/'), 
                'Puestos' => url('/catalogos/puestos')
            ]
        ]);
    }

    public function puestosAgregarGet(): View
    {
        return view('catalogos.puestosAgregarGet', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Puestos' => url('/catalogos/puestos'),
                'Agregar' => url('/catalogos/puestos/agregar')
            ]
        ]);
    }

    public function puestosAgregarPost(Request $request)
    {
        $puesto = new Puesto([
            'nombre_puesto' => ucwords(strtolower($request->input('nombre_puesto'))), 
            'sueldo' => $request->input('sueldo')
        ]);
        $puesto->save();
    
        return redirect('/catalogos/puestos');
    }

    public function puestosEditarGet($id): View
    {
        $puesto = Puesto::findOrFail($id);
        
        return view('catalogos.puestosEditarGet', [
            'puesto' => $puesto,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Puestos' => url('/catalogos/puestos'),
                'Editar' => url("/catalogos/puestos/editar/$id")
            ]
        ]);
    }

    public function puestosEditarPost(Request $request, $id)
    {
        $request->validate([
            'nombre_puesto' => 'required|max:50',
            'sueldo' => 'required|numeric'
        ]);
    
        $puesto = Puesto::findOrFail($id);
        $puesto->update($request->only(['nombre_puesto', 'sueldo']));
    
        return redirect('/catalogos/puestos')->with('success', 'Puesto actualizado correctamente');
    }

    public function puestosEliminarGet($id)
    {
        $puesto = Puesto::findOrFail($id);
        $puesto->delete();

        return redirect('/catalogos/puestos')->with('success', 'Puesto eliminado correctamente');
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
