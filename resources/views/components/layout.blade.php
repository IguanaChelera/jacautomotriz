<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'JAC Automotriz')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/JAC-Logo.png') }}" type="image/png">

    <!-- Bootstrap 5.3.3 -->
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap-icons.css') }}">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    
    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar Superior -->
    @include('components.sidebar') <!-- Tu barra de navegación actual -->
    
    <!-- Contenido Principal -->
    <main class="flex-grow-1" style="padding-top: 80px;">
        <div class="container-fluid px-4">
            <!-- Encabezado de página -->
            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <h2 class="mb-0">@yield('page-title')</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                        @yield('breadcrumbs')
                    </ol>
                </nav>
            </div>
            
            <!-- Mensajes Flash -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- Contenido específico de cada página -->
            @yield('content')
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>JAC Automotriz</h5>
                    <p class="mb-0">Servicio profesional de mecánica automotriz</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} Todos los derechos reservados
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery 3.6.0 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
            crossorigin="anonymous"></script>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- DataTables JS -->
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    
    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script src="{{ asset('assets/main.js') }}"></script>
    
    @yield('scripts')
</body>
</html>