<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Detalle_servicio_venta;
use Illuminate\Support\Facades\DB;
class ReportesController extends Controller
{
    public function indexGet(Request $request)
    {
        return view("reportes.indexGet",[
            "breadcrumbs"=>[
                "Inicio"=>url("/"),
                "Reportes"=>url("/reportes")
            ]
        ]);
    }
    public function serviciosRealizadosGet(): View
    {
        $serviciosRealizados = DB::table('detalle_servicio_venta')
            ->join('venta', 'detalle_servicio_venta.fk_id_venta', '=', 'venta.id_venta')
            ->join('servicio', 'detalle_servicio_venta.fk_id_servicio', '=', 'servicio.id_servicio')
            ->select(
                'detalle_servicio_venta.id_servicio_venta',
                'venta.fechaVenta as fecha',
                'servicio.nombreServicio as servicio',
                'venta.id_venta',
                'servicio.costoServicio',
                'detalle_servicio_venta.subtotal',
                'venta.total'
            )
            ->get();

        return view('reportes.serviciosRealizadosGet', [
            'serviciosRealizados' => $serviciosRealizados,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/reportes'), // Asumiendo que tienes una ruta para "Reportes"
                'Servicios Realizados' => url('/reportes/servicios-realizados')
            ]
        ]);
    }
}