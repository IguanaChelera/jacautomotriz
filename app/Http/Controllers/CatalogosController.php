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
use Illuminate\Support\Facades\DB;  // Para las transacciones

class CatalogosController extends Controller
{
    public function home(): View {
        return view('home', ["breadcrumbs" => []]);
    }
    
    //Clientes
    public function clientesGet(): View
    {
        $clientes = Cliente::all();
        
        return view('catalogos.clientesGet', [
            'clientes' => $clientes,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Clientes' => url('/catalogos/clientes')
            ]
        ]);
    }

    public function clientesAgregarGet(): View
    {
        return view('catalogos.clientesAgregarGet', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Clientes' => url('/catalogos/clientes'),
                'Agregar' => url('/catalogos/clientes/agregar')
            ]
        ]);
    }

    public function clientesAgregarPost(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:200'
        ]);

        Cliente::create($request->all());

        return redirect('/catalogos/clientes')->with('success', 'Cliente agregado correctamente');
    }

    public function clientesEditarGet($id): View
    {
        $cliente = Cliente::findOrFail($id);
        
        return view('catalogos.clientesEditarGet', [
            'cliente' => $cliente,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Clientes' => url('/catalogos/clientes'),
                'Editar' => url("/catalogos/clientes/editar/$id")
            ]
        ]);
    }

    public function clientesEditarPost(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:200'
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect('/catalogos/clientes')->with('success', 'Cliente actualizado correctamente');
    }

    public function clientesEliminarGet($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect('/catalogos/clientes')->with('success', 'Cliente eliminado correctamente');
    }
    //Clientes

    //Citas
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

    //Empleados
    public function empleadosGet(): View
    {
        $empleados = Empleado::with('puesto')->get(); 
        
        return view('catalogos.empleadosGet', [
            'empleados' => $empleados,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Empleados' => url('/catalogos/empleados')
            ]
        ]);
    }

    public function empleadosAgregarGet(): View
    {
        $puestos = Puesto::all();
        
        return view('catalogos.empleadosAgregarGet', [
            'puestos' => $puestos,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Empleados' => url('/catalogos/empleados'),
                'Agregar' => url('/catalogos/empleados/agregar')
            ]
        ]);
    }
    
    public function empleadosAgregarPost(Request $request)
    {
        $validated = $request->validate([
            'fk_id_puesto' => 'required|exists:puesto,id_puesto',  // Cambiado a required
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'numeroSeguroSocial' => 'required|string|max:20',
            'experiencia' => 'required|integer|min:0',
            'estado' => 'required|boolean'
        ]);
    
        $empleado = new Empleado([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'numeroSeguroSocial' => $request->input('numeroSeguroSocial'),
            'experiencia' => $request->input('experiencia'),
            'estado' => $request->input('estado'),
            'fk_id_puesto' => $request->input('fk_id_puesto')  // Cambiado a fk_id_puesto
        ]);
        $empleado->save();
    
        return redirect('/catalogos/empleados')->with('success', 'Empleado agregado correctamente');
    }
    
    public function empleadosEditarGet($id): View
    {
        $empleado = Empleado::findOrFail($id);
        $puestos = Puesto::all();
        
        return view('catalogos.empleadosEditarGet', [
            'empleado' => $empleado,
            'puestos' => $puestos,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Empleados' => url('/catalogos/empleados'),
                'Editar' => url("/catalogos/empleados/editar/$id")
            ]
        ]);
    }
    
    public function empleadosEditarPost(Request $request, $id)
    {
        $validated = $request->validate([
            'fk_id_puesto' => 'required|exists:puesto,id_puesto',  // Cambiado a required
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'numeroSeguroSocial' => 'required|string|max:20',
            'experiencia' => 'required|integer|min:0',
            'estado' => 'required|boolean'
        ]);
    
        $empleado = Empleado::findOrFail($id);
        $empleado->update([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'numeroSeguroSocial' => $request->input('numeroSeguroSocial'),
            'experiencia' => $request->input('experiencia'),
            'estado' => $request->input('estado'),
            'fk_id_puesto' => $request->input('fk_id_puesto')  // Cambiado a fk_id_puesto
        ]);
    
        return redirect('/catalogos/empleados')->with('success', 'Empleado actualizado correctamente');
    }

    public function empleadosEliminarGet($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect('/catalogos/empleados')->with('success', 'Empleado eliminado correctamente');
    }
    //Empleados

    //Puestos
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
    //Puestos
    
    public function ventasGet(Request $request): View {
        $ventas = Venta::all();
        return view ('catalogos.ventasGet', [
            "ventas" => $ventas,
            "breadcrumbs"  => [
                "Inicio" => url('/'),
                "Ventas" => url('/catalogos/ventas')
            ]
        ]);
    }


    public function ventasAgregarGet(): View
    {
    $servicios = Servicio::all();
    $citas = Cita::all();  // Obtener todas las citas

    return view('catalogos.ventasAgregarGet', [
        'servicios' => $servicios,
        'citas' => $citas, // Pasar las citas a la vista
        'breadcrumbs' => [
            'Inicio' => url('/'),
            'Ventas' => url('/catalogos/ventas'),
            'Agregar' => url('/catalogos/ventas/agregar')
        ]
    ]);
    }

    public function ventasAgregarPost(Request $request)
    {
    $validated = $request->validate([
        'fk_id_cita' => 'required|exists:cita,id_Cita',  // Validar la cita
        'fk_id_servicio' => 'required|exists:servicio,id_servicio',
        'cantidad' => 'required|integer|min:1',
        'fechaVenta' => 'required|date',
        'horaVenta' => 'required|date_format:H:i',
        'subtotal' => 'required|numeric|min:0',
        'total' => 'required|numeric|min:0',
    ]);

    try {
        DB::beginTransaction();

        $venta = new Venta();
        $venta->total = $request->total;
        $venta->fechaVenta = $request->fechaVenta;
        $venta->horaVenta = $request->horaVenta;
        $venta->fk_id_cita = $request->fk_id_cita;  // Asignar el ID de la cita
        $venta->save();

        // Crear el detalle de la venta
        DB::table('detalle_servicio_venta')->insert([
            'fk_id_servicio' => $request->fk_id_servicio,
            'fk_id_venta' => $venta->id_venta,
            'cantidad' => $request->cantidad,
            'fk_costoServicio' => Servicio::find($request->fk_id_servicio)->costoServicio,
            'subtotal' => $request->subtotal,
        ]);

        DB::commit();

        return redirect('/catalogos/ventas')->with('success', 'Venta agregada correctamente');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Error al agregar la venta: ' . $e->getMessage());
    }
    }
    public function ventasEditarGet($id): View
    {
        $venta = Venta::findOrFail($id);
        $ventaDetalle = DB::table('detalle_servicio_venta')->where('fk_id_venta', $id)->first();
        $servicios = Servicio::all();
        $citas = Cita::all();

        return view('catalogos.ventasEditarGet', [
            'venta' => $venta,
            'ventaDetalle' => $ventaDetalle,
            'servicios' => $servicios,
            'citas' => $citas,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Ventas' => url('/catalogos/ventas'),
                'Editar' => url('/catalogos/ventas/editar/' . $id)
            ]
        ]);
    }

    public function ventasEditarPost(Request $request, $id)
    {
        $validated = $request->validate([
            'fk_id_cita' => 'required|exists:cita,id_Cita',
            'fk_id_servicio' => 'required|exists:servicio,id_servicio',
            'cantidad' => 'required|integer|min:1',
            'fechaVenta' => 'required|date',
            'horaVenta' => 'required|date_format:H:i',
            'subtotal' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $venta = Venta::findOrFail($id);
            $venta->total = $request->total;
            $venta->fechaVenta = $request->fechaVenta;
            $venta->horaVenta = $request->horaVenta;
            $venta->fk_id_cita = $request->fk_id_cita;
            $venta->save();

            DB::table('detalle_servicio_venta')
                ->where('fk_id_venta', $id)
                ->update([
                    'fk_id_servicio' => $request->fk_id_servicio,
                    'cantidad' => $request->cantidad,
                    'fk_costoServicio' => Servicio::find($request->fk_id_servicio)->costoServicio,
                    'subtotal' => $request->subtotal,
                ]);

            DB::commit();

            return redirect('/catalogos/ventas')->with('success', 'Venta actualizada correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al actualizar la venta: ' . $e->getMessage());
        }
    }

    public function ventasEliminarGet($id)
    {
    try {
        DB::beginTransaction();

        $venta = Venta::findOrFail($id);

        // Eliminar el detalle de la venta primero (si es necesario)
        DB::table('detalle_servicio_venta')->where('fk_id_venta', $id)->delete();

        $venta->delete();

        DB::commit();

        return redirect('/catalogos/ventas')->with('success', 'Venta eliminada correctamente');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Error al eliminar la venta: ' . $e->getMessage());
    }
    }



    public function citasPorCliente($id): View
    {
        $cliente = Cliente::findOrFail($id);
        $citas = $cliente->citas;

        return view('catalogos.citasPorCliente', [
            'cliente' => $cliente,
            'citas' => $citas,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Clientes' => url('/catalogos/clientes'),
                'Citas' => url("/catalogos/citas/cliente/$id")
            ]
        ]);
    }
}

