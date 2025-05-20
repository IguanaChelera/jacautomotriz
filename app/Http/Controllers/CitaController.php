<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CitaController extends Controller
{
    public function citasGet(): View
    {
        $citas = Cita::with('cliente')->get();
        
        return view('catalogos.citasGet', [
            'citas' => $citas,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Citas' => url('/catalogos/citas')
            ]
        ]);
    }

    public function citasAgregarGet(): View
    {
        $clientes = Cliente::all();
        
        return view('catalogos.citasAgregarGet', [
            'clientes' => $clientes,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Citas' => url('/catalogos/citas'),
                'Agregar' => url('/catalogos/citas/agregar')
            ]
        ]);
    }

    public function citasAgregarPost(Request $request)
    {
        $request->validate([
            'fechaCita' => 'required|date',
            'horaCita' => 'required',
            'marcaVehiculo' => 'required|string|max:50',
            'modeloVehiculo' => 'required|string|max:50',
            'fk_id_cliente' => 'required|exists:cliente,id_cliente'
        ]);

        Cita::create($request->all());

        return redirect('/catalogos/citas')->with('success', 'Cita agregada correctamente');
    }

    public function citasEditarGet($id): View
    {
        $cita = Cita::findOrFail($id);
        $clientes = Cliente::all();
        
        return view('catalogos.citasEditarGet', [
            'cita' => $cita,
            'clientes' => $clientes,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Citas' => url('/catalogos/citas'),
                'Editar' => url("/catalogos/citas/editar/$id")
            ]
        ]);
    }

    public function citasEditarPost(Request $request, $id)
    {
        $request->validate([
            'fechaCita' => 'required|date',
            'horaCita' => 'required',
            'marcaVehiculo' => 'required|string|max:50',
            'modeloVehiculo' => 'required|string|max:50',
            'fk_id_cliente' => 'required|exists:cliente,id_cliente'
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect('/catalogos/citas')->with('success', 'Cita actualizada correctamente');
    }

    public function citasCancelarGet($id)
    {
        $cita = Cita::findOrFail($id);
        if ($cita->fk_id_orden_venta) {
            return redirect('/catalogos/citas')->with('error', 'No se puede cancelar una cita que tiene una orden de venta asociada.');
        }
        $cita->delete();

        return redirect('/catalogos/citas')->with('success', 'Cita cancelada correctamente');
    }

    public function realizarCita($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->realizada = true;
        $cita->save();

        return redirect('/catalogos/citas')->with('success', 'Cita marcada como realizada.');
    }

    public function generarOrdenVentaGet($id)
    {
        // Placeholder para la funcionalidad futura
        return redirect('/catalogos/citas')->with('info', 'Función de orden de venta en desarrollo');
    }
}