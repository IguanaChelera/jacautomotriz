<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\OrdenVenta;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdenVentaController extends Controller
{
    public function create($id_cita)
    {
        $cita = Cita::with('cliente')->findOrFail($id_cita);
        $servicios = Servicio::where('estado', 1)->get();
        $empleados = Empleado::where('estado', 1)->get();
        
        return view('orden_venta.create', compact('cita', 'servicios', 'empleados'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_cita' => 'required|exists:cita,id_Cita',
            'id_empleado' => 'required|exists:empleado,id_Empleado',
            'servicios' => 'required|array',
            'servicios.*.id' => 'required|exists:servicio,id_servicio',
            'servicios.*.cantidad' => 'required|integer|min:1'
        ]);
        
        $ordenVenta = OrdenVenta::create([
            'fecha' => now(),
            'total' => 0, 
            'fk_id_cita' => $request->id_cita,
            'fk_id_empleado' => $request->id_empleado
        ]);
        
        $total = 0;
        
        foreach ($request->servicios as $servicio) {
            $servicioModel = Servicio::find($servicio['id']);
            $subtotal = $servicioModel->costoServicio * $servicio['cantidad'];
            
            $ordenVenta->servicios()->attach($servicio['id'], [
                'cantidad' => $servicio['cantidad'],
                'precio_unitario' => $servicioModel->costoServicio,
                'subtotal' => $subtotal
            ]);
            
            $total += $subtotal;
        }
        
        $ordenVenta->update(['total' => $total]);
        
        return redirect()->route('orden_venta.show', $ordenVenta->id_orden_venta)
            ->with('success', 'Orden de venta creada exitosamente');
    }
    
    public function show($id)
    {
        $ordenVenta = OrdenVenta::with(['cita.cliente', 'empleado', 'servicios'])->findOrFail($id);
        
        return view('orden_venta.show', compact('ordenVenta'));
    }
    
    public function edit($id)
    {
        $ordenVenta = OrdenVenta::with(['cita', 'detalleServicios.servicio'])->findOrFail($id);
        $servicios = Servicio::where('estado', 1)->get();
        $empleados = Empleado::where('estado', 1)->get();
        
        return view('orden_venta.edit', compact('ordenVenta', 'servicios', 'empleados'));
    }
    
    public function update(Request $request, $id)
    {
    }
    
    public function generatePdf($id)
    {
        $ordenVenta = OrdenVenta::with(['cita.cliente', 'empleado', 'servicios'])->findOrFail($id);
        
        $pdf = PDF::loadView('orden_venta.pdf', compact('ordenVenta'));
        
        return $pdf->download('orden_venta_'.$id.'.pdf');
    }
}