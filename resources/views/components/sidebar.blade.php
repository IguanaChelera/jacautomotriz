<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top px-3">
    <!-- Logo + Nombre -->
    <a class="navbar-brand d-flex align-items-center">
        <img src="{{ asset('assets/JAC-Logo.png') }}" alt="Logo Jac Automotriz" height="40" class="me-2">
        JAC Automotriz
    </a>

    <!-- Botón hamburguesa (para móviles) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú de navegación -->
    <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/citas') }}">Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/clientes') }}">Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/empleados') }}">Empleados</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/puestos') }}">Puestos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/servicios') }}">Servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/ventas') }}">Ventas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/reportes') }}">Reportes</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Salir</a></li>
        </ul>
    </div>
</nav>
