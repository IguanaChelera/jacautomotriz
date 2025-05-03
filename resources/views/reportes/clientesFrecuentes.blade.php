@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container my-5">
    <h1 class="mb-4 text-center">Clientes Frecuentes</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Total Citas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->citas_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
