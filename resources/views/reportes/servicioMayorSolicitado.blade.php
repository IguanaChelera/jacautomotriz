@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container my-5">
    <h1 class="mb-4 text-center">Servicio Mayor Solicitado</h1>
    @if($servicio)
        <p class="text-center">El servicio más solicitado es <strong>{{ $servicio->servicio->nombreServicio }}</strong> con un total de <strong>{{ $servicio->total }}</strong> solicitudes.</p>
    @else
        <p class="text-center">No hay datos disponibles.</p>
    @endif
</div>
@endsection
