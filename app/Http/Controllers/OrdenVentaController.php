<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\OrdenVenta;
use App\Models\OrdenVentaItem;
use Illuminate\Http\Request;

class OrdenVentaController extends Controller
{
    public function createFromCita($idCita)
    {
        $cita = Cita::with('cliente')->findOrFail($idCita);
        $servicios = Servicio::where('estado', 1)->get();
    
        return view('ventas.orden_venta', [
            'cita' => $cita,
            'servicios' => $servicios,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Citas' => url('/catalogos/citas'),
                'Generar Orden' => url()->current()
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fk_id_cita' => 'required|exists:cita,id_Cita',
            'servicios' => 'required|array|min:1',
            'servicios.*.id_servicio' => 'required|exists:servicio,id_servicio',
            'servicios.*.cantidad' => 'required|integer|min:1',
            'servicios.*.precio' => 'required|numeric|min:0',
            'servicios.*.total' => 'required|numeric|min:0',
            'total_general' => 'required|numeric|min:0'
        ]);
        
        // Crear la orden
        $orden = OrdenVenta::create([
            'fecha' => now(),
            'total' => $validated['total_general'],
            'fk_id_cita' => $validated['fk_id_cita'],
            'fk_id_cliente' => Cita::find($validated['fk_id_cita'])->fk_id_cliente,
            'estado' => 1 // 1 = Activa, 0 = Inactiva
        ]);
        
        // Crear items
        foreach ($validated['servicios'] as $servicio) {
            OrdenVentaItem::create([
                'cantidad' => $servicio['cantidad'],
                'precio_unitario' => $servicio['precio'],
                'subtotal' => $servicio['total'],
                'fk_id_orden' => $orden->id_orden,
                'fk_id_servicio' => $servicio['id_servicio']
            ]);
        }
        
        // Actualizar estado de la cita
        Cita::where('id_Cita', $validated['fk_id_cita'])
            ->update(['estado' => 'completada']);
        
        return redirect('/catalogos/citas')
               ->with('success', 'Orden de venta generada correctamente');
    }
}