<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Servicio;
use App\Models\Cliente;
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

    public function servicioMayorSolicitado()
    {
        $servicio = Detalle_servicio_venta::select('fk_id_servicio', DB::raw('COUNT(*) as total'))
            ->groupBy('fk_id_servicio')
            ->orderByDesc('total')
            ->with('servicio')
            ->first();

        return view("reportes.servicioMayorSolicitado", [
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Reportes" => url("/reportes"),
                "Servicio Mayor Solicitado" => url("/reportes/servicio-mayor-solicitado")
            ],
            "servicio" => $servicio
        ]);
    }

    public function clientesFrecuentes()
    {
        $clientes = Cliente::withCount(['citas' => function ($query) {
            $query->select(DB::raw('COUNT(*)'));
        }])
        ->orderByDesc('citas_count')
        ->take(10)
        ->get();

        return view("reportes.clientesFrecuentes", [
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Reportes" => url("/reportes"),
                "Clientes Frecuentes" => url("/reportes/clientes-frecuentes")
            ],
            "clientes" => $clientes
        ]);
    }

    public function serviciosRealizadosPorMes(Request $request)
    {
        $mesSeleccionado = $request->input('mes');
        $anioSeleccionado = $request->input('anio');

        $query = Detalle_servicio_venta::join('venta', 'detalle_servicio_venta.fk_id_venta', '=', 'venta.id_venta')
            ->join('servicio', 'detalle_servicio_venta.fk_id_servicio', '=', 'servicio.id_servicio')
            ->select(
                DB::raw('MONTH(venta.fechaVenta) as mes'),
                DB::raw('YEAR(venta.fechaVenta) as anio'),
                DB::raw('COUNT(detalle_servicio_venta.id_servicio_venta) as total'),
                'servicio.nombreServicio',
                DB::raw('COUNT(servicio.id_servicio) as cantidad')
            )
            ->groupBy(DB::raw('MONTH(venta.fechaVenta)'), DB::raw('YEAR(venta.fechaVenta)'), 'servicio.nombreServicio', 'servicio.id_servicio')
            ->orderBy(DB::raw('MONTH(venta.fechaVenta)'));

        if ($mesSeleccionado) {
            $query->where(DB::raw('MONTH(venta.fechaVenta)'), $mesSeleccionado);
        }

        if ($anioSeleccionado) {
            $query->where(DB::raw('YEAR(venta.fechaVenta)'), $anioSeleccionado);
        }

        $serviciosPorMes = $query->get()
            ->groupBy('mes')
            ->map(function ($group) {
                return [
                    'total' => $group->sum('cantidad'),
                    'servicios' => $group->map(function ($item) {
                        return $item->nombreServicio . " (" . $item->cantidad . ")";
                    })->implode('<br>')
                ];
            });

        return view("reportes.serviciosRealizadosPorMes", [
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Reportes" => url("/reportes"),
                "Servicios Realizados Por Mes" => url("/reportes/servicios-realizados-por-mes")
            ],
            "serviciosPorMes" => $serviciosPorMes,
            "mesSeleccionado" => $mesSeleccionado,
            "anioSeleccionado" => $anioSeleccionado
        ]);
    }
}