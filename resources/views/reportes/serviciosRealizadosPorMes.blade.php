@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="container my-5">
    <h1 class="mb-4 text-center">Servicios Realizados Por Mes</h1>

    <form method="GET" action="{{ url('/reportes/servicios-realizados-por-mes') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="mes" class="form-label">Mes</label>
                <select name="mes" id="mes" class="form-select">
                    <option value="">Todos</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $mesSeleccionado == $i ? 'selected' : '' }}>
                            {{ mb_strtoupper(\Carbon\Carbon::createFromFormat('!m', $i)->locale('es')->translatedFormat('F')) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <label for="anio" class="form-label">Año</label>
                <select name="anio" id="anio" class="form-select">
                    <option value="">Todos</option>
                    @for($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ $anioSeleccionado == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Total de Servicios</th>
                <th>Servicios Realizados</th>
            </tr>
        </thead>
        <tbody>
            @forelse($serviciosPorMes as $mes => $data)
                <tr>
                    <td>{{ mb_strtoupper(\Carbon\Carbon::createFromFormat('!m', $mes)->locale('es')->translatedFormat('F')) }}</td>
                    <td>{{ $data['total'] }}</td>
                    <td>{!! $data['servicios'] !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay datos disponibles para los filtros seleccionados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
