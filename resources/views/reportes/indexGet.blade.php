@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container my-5">
    <h1 class="mb-4 text-center">Reportes</h1>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="{{ url('/reportes/servicio-mayor-solicitado') }}" class="btn btn-outline-primary btn-lg w-100">Servicio Mayor Solicitado</a>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="{{ url('/reportes/clientes-frecuentes') }}" class="btn btn-outline-primary btn-lg w-100">Clientes Frecuentes</a>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="{{ url('/reportes/servicios-realizados-por-mes') }}" class="btn btn-outline-primary btn-lg w-100">Servicios Realizados Por Mes</a>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="{{ url('/reportes/reporte-ventas') }}" class="btn btn-outline-primary btn-lg w-100">Reporte Ventas</a>
        </div>
    </div>
</div>
@endsection