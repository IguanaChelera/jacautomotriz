<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar lista de ventas
    public function index()
    {
        $ventas = Venta::all();
        return view('venta.index', compact('ventas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('venta.form');
    }

    // Guardar nueva venta
    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'fechaVenta' => 'required|date',
            'horaVenta' => 'required',
            'fk_id_cita' => 'required|integer',
        ]);

        Venta::create($request->all());

        return redirect()->route('venta.index')->with('success', 'Venta creada exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('venta.form', compact('venta'));
    }

    // Actualizar una venta existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'total' => 'required|numeric',
            'fechaVenta' => 'required|date',
            'horaVenta' => 'required',
            'fk_id_cita' => 'required|integer',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('venta.index')->with('success', 'Venta actualizada correctamente.');
    }

    // Eliminar una venta
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('venta.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
