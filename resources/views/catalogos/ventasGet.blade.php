    @extends("components.layout")
    @section("content")
        @component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
        @endcomponent
        <div class="row my-4">
            <div class="col">
                <h1>Ventas</h1>
            </div>
            <div class="col-auto titlebar-commands">
                <a class="btn btn-primary" href="{{ url('/catalogos/ventas/agregar') }}">Agregar</a>
            </div>
        </div>

        <table class="table" id="maintable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">HORA</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">ID CITA</th> {{-- Nueva columna --}}
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                <tr>
                    <td class="text-center">{{ $venta->id_venta }}</td>
                    <td class="text-center">{{ $venta->fechaVenta }}</td>
                    <td class="text-center">{{ $venta->horaVenta }}</td>
                    <td class="text-center">{{ $venta->total }}</td>
                    <td class="text-center">{{ $venta->cita->id_Cita }}</td> {{-- Mostrar el ID de Cita --}}
                    <td class="text-center">
                        <a href="{{ url('/catalogos/ventas/editar/' . $venta->id_venta) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ url('/catalogos/ventas/eliminar/' . $venta->id_venta) }}" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endsection