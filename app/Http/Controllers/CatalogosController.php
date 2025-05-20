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
use App\Models\OrdenVenta;

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

    public function alternarEstado($id_cliente)
    {
        // Busca el cliente por su ID
        $cliente = Cliente::findOrFail($id_cliente);

        // Alterna el estado entre 1 (activo) y 0 (inactivo)
        $cliente->activo = !$cliente->activo;

        // Guarda los cambios en la base de datos
        $cliente->save();

        // Genera un mensaje de éxito
        $accion = $cliente->activo ? 'activado' : 'desactivado';
        return redirect('/catalogos/clientes')->with('success', "Cliente $accion correctamente.");
    }

    public function index()
    {
        // Muestra todos los clientes (activos e inactivos)
        $clientes = Cliente::all();
        return view('catalogos.clientes', compact('clientes'));
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

    public function cambiarEstado($id)
    {
        $puesto = Puesto::findOrFail($id);
        $nuevoEstado = request('estado');
        $estadosValidos = ['activo', 'inactivo', 'pendiente', 'eliminado'];
        if (in_array($nuevoEstado, $estadosValidos)) {
            $puesto->estado = $nuevoEstado;
            $puesto->save();
            return redirect()->back()->with('success', 'Estado del puesto actualizado correctamente.');
        }
        return redirect()->back()->with('error', 'Estado no válido.');
    }
    //Puestos
    
 
    //Ventas
    public function ventasGet(Request $request): View {
            $ventas = Venta::with('cita')->get(); 
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
            'citas' => $citas, 
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
                'fk_id_cita' => 'required|exists:cita,id_Cita',
                'fechaVenta' => 'required|date',
                'horaVenta' => 'required|date_format:H:i',
                'servicios' => 'required|array', // Validar que se envíen servicios
                'servicios.*.id' => 'required|exists:servicio,id_servicio',
                'servicios.*.cantidad' => 'required|integer|min:1',
            ]);
        
            try {
                DB::beginTransaction();
        
                // Crear la venta
                $venta = new Venta();
                $venta->fk_id_cita = $request->fk_id_cita;
                $venta->fechaVenta = $request->fechaVenta;
                $venta->horaVenta = $request->horaVenta;
                $venta->total = array_reduce($request->servicios, function ($carry, $servicio) {
                    $precio = Servicio::find($servicio['id'])->costoServicio;
                    return $carry + ($precio * $servicio['cantidad']);
                }, 0);
                $venta->save();
        
                // Insertar los detalles de la venta
                foreach ($request->servicios as $servicio) {
                    DB::table('detalle_servicio_venta')->insert([
                        'fk_id_venta' => $venta->id_venta,
                        'fk_id_servicio' => $servicio['id'],
                        'cantidad' => $servicio['cantidad'],
                        'fk_costoServicio' => Servicio::find($servicio['id'])->costoServicio,
                        'subtotal' => Servicio::find($servicio['id'])->costoServicio * $servicio['cantidad'],
                    ]);
                }
        
                DB::commit();
        
                return redirect('/catalogos/ventas')->with('success', 'Venta agregada correctamente');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Error al agregar la venta: ' . $e->getMessage());
            }
        }
        public function ventasEditarGet($id): View
        {
            $venta = Venta::with('cita', 'detallesServicio')->findOrFail($id);
            $servicios = Servicio::all();
            $citas = Cita::all();
    
            return view('catalogos.ventasEditarGet', [
                'venta' => $venta,
                'servicios' => $servicios,
                'citas' => $citas,
                'breadcrumbs' => [
                    'Inicio' => url('/'),
                    'Ventas' => url('/catalogos/ventas'),
                    'Editar' => url("/catalogos/ventas/editar/{$id}")
                ]
            ]);
        }
    
        public function ventasEditarPost(Request $request, $id)
        {
            $validated = $request->validate([
                'fk_id_cita' => 'required|exists:cita,id_Cita',
                'fechaVenta' => 'required|date',
                'horaVenta' => 'required|date_format:H:i',
                'servicios' => 'required|array',
                'servicios.*.id' => 'required|exists:servicio,id_servicio',
                'servicios.*.cantidad' => 'required|integer|min:1',
                'total' => 'required|numeric|min:0',
            ]);

            try {
                DB::beginTransaction();

                $venta = Venta::findOrFail($id);
                $venta->fk_id_cita = $request->fk_id_cita;
                $venta->fechaVenta = $request->fechaVenta;
                $venta->horaVenta = $request->horaVenta;

                // Calcula el total real usando los precios actuales de los servicios
                $total = 0;
                foreach ($request->servicios as $servicio) {
                    $precio = Servicio::find($servicio['id'])->costoServicio;
                    $total += $precio * $servicio['cantidad'];
                }
                $venta->total = $total;
                $venta->save();

                // Elimina los detalles anteriores
                DB::table('detalle_servicio_venta')->where('fk_id_venta', $id)->delete();

                // Inserta los nuevos detalles
                foreach ($request->servicios as $servicio) {
                    $precio = Servicio::find($servicio['id'])->costoServicio;
                    DB::table('detalle_servicio_venta')->insert([
                        'fk_id_venta' => $venta->id_venta,
                        'fk_id_servicio' => $servicio['id'],
                        'cantidad' => $servicio['cantidad'],
                        'fk_costoServicio' => $precio,
                        'subtotal' => $precio * $servicio['cantidad'],
                    ]);
                }

                DB::commit();

                return redirect('/catalogos/ventas')->with('success', 'Venta actualizada correctamente');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Error al actualizar la venta: ' . $e->getMessage());
            }
        }
        public function update(Request $request, $id)
        {
            $venta = Venta::findOrFail($id);

            // Asigna los nuevos valores
            $venta->fk_id_cita = $request->fk_id_cita;
            $venta->fechaVenta = $request->fechaVenta;
            $venta->horaVenta = $request->horaVenta;
            $venta->total = $request->total;

            $venta->save();

            return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');

        }

    public function ventasEliminarGet($id)
    {
    try {
        DB::beginTransaction();

        $venta = Venta::findOrFail($id);

    
        DB::table('detalle_servicio_venta' )->where('fk_id_venta', $id)->delete();

        $venta->delete();

        DB::commit();

        return redirect('/catalogos/ventas')->with('success', 'Venta eliminada correctamente');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Error al eliminar la venta: ' . $e->getMessage());
    }
    }
    //Ventas

    //Citas
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

    public function obtenerServiciosPorCita($idCita)
    {
        $ordenVenta = OrdenVenta::where('fk_id_cita', $idCita)->with('servicios')->first();

        if (!$ordenVenta) {
            return response()->json(['error' => 'No se encontraron servicios para esta cita.'], 404);
        }

        return response()->json($ordenVenta->servicios->map(function ($servicio) {
            return [
                'id' => $servicio->id_servicio,
                'nombre' => $servicio->nombreServicio,
                'precio_unitario' => (float) $servicio->pivot->precio_unitario, // Asegura que sea un número
                'cantidad' => $servicio->pivot->cantidad,
                'subtotal' => (float) $servicio->pivot->subtotal, // Asegura que sea un número
            ];
        }));
    }
}

