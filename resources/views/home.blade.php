@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h1>Bienvenido a Jac Automotriz</h1>
    <p>Gestiona tus clientes, citas, empleados y más desde aquí.</p>
</div>
@endsection