<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jac Automotriz</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ URL::asset('DataTables/datatables.min.css') }}" />
    <!-- Tu CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap-icons.css') }}">
</head>
<body>
    {{-- Incluye la navbar (sigue llamándose "sidebar") --}}
    @component("components.sidebar")
    @endcomponent

    {{-- Contenido principal con espacio arriba para la navbar --}}
    <div class="container mt-5 pt-4" style="margin-top: 100px;">
        @section("content")
        @show
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ URL::asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables JS -->
    <script src="{{ URL::asset('DataTables/datatables.min.js') }}"></script>
</body>
</html>
