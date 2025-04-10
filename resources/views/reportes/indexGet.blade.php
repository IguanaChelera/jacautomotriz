@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container my-5">
    <h1 class="mb-4 text-center">Reportes</h1>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="#" class="btn btn-outline-primary btn-lg w-100">Servicio Mayor Solicitado</a>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="#" class="btn btn-outline-primary btn-lg w-100">Clientes Frecuentes</a>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="#" class="btn btn-outline-primary btn-lg w-100">Servicios Realizados Por Mes</a>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <a href="#" class="btn btn-outline-primary btn-lg w-100">Servicios Realizados</a>
        </div>
    </div>
</div>
@endsection

