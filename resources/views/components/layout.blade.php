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
    <link rel="stylesheet" href="{{ URL::asset('bootstrap-5.3.3-dist/css/bootstrap-icons.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- html2pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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
    <script src="{{ secure_asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables JS -->
    <script src="{{ secure_asset('DataTables/datatables.min.js') }}"></script>
    @yield('scripts')

</body>
</html>
