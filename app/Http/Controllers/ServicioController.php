<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicioController extends Controller
{
    public function serviciosGet(): View
    {
        $servicios = Servicio::all();
        
        return view('catalogos.serviciosGet', [
            'servicios' => $servicios,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Servicios' => url('/catalogos/servicios')
            ]
        ]);
    }

    public function serviciosAgregarGet(): View
    {
        return view('catalogos.serviciosAgregarGet', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Servicios' => url('/catalogos/servicios'),
                'Agregar' => url('/catalogos/servicios/agregar')
            ]
        ]);
    }

    public function serviciosAgregarPost(Request $request)
    {
        $request->validate([
            'nombreServicio' => 'required|string|max:100',
            'costoServicio' => 'required|numeric|min:0',
            'estado' => 'required|boolean'
        ]);

        Servicio::create([
            'nombreServicio' => $request->nombreServicio,
            'costoServicio' => $request->costoServicio,
            'estado' => $request->estado ?? 1
        ]);

        return redirect('/catalogos/servicios')->with('success', 'Servicio agregado correctamente');
    }

    public function serviciosEditarGet($id): View
    {
        $servicio = Servicio::findOrFail($id);
        
        return view('catalogos.serviciosEditarGet', [
            'servicio' => $servicio,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Servicios' => url('/catalogos/servicios'),
                'Editar' => url("/catalogos/servicios/editar/$id")
            ]
        ]);
    }

    public function serviciosEditarPost(Request $request, $id)
    {
        $request->validate([
            'nombreServicio' => 'required|string|max:100',
            'costoServicio' => 'required|numeric|min:0',
            'estado' => 'required|boolean'
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());

        return redirect('/catalogos/servicios')->with('success', 'Servicio actualizado correctamente');
    }

    public function serviciosCambiarEstado($id)
    {
        $servicio = Servicio::findOrFail($id);
        $nuevoEstado = $servicio->estado ? 0 : 1;
        $servicio->update(['estado' => $nuevoEstado]);
    
        $accion = $nuevoEstado ? 'reactivado' : 'cancelado';
        return redirect('/catalogos/servicios')->with('success', "Servicio $accion correctamente");
    }
    
}

