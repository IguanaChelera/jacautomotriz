<nav class="navbar navbar-expand-lg navbar-gradient shadow-sm px-4 py-2">
    <a class="navbar-brand d-flex align-items-center fw-bold fs-5" href="{{ url('/') }}">
        <img src="{{ asset('assets/JAC-Logo.png') }}" alt="Logo Jac Automotriz" height="40" class="me-2">
        JAC Automotriz
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto d-flex align-items-center gap-2">
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/citas') }}"><i class="bi bi-calendar-check"></i> Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/clientes') }}"><i class="bi bi-people"></i> Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/empleados') }}"><i class="bi bi-person-badge"></i> Empleados</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/puestos') }}"><i class="bi bi-briefcase"></i> Puestos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/catalogos/servicios') }}"><i class="bi bi-tools"></i> Servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('ventas.index') }}"><i class="bi bi-cart-check"></i> Ventas</a></li>            <li class="nav-item"><a class="nav-link" href="{{ url('/reportes') }}"><i class="bi bi-bar-chart"></i> Reportes</a></li>
            <li class="nav-item"><a class="nav-link text-warning" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right"></i> Salir</a></li>
        </ul>
    </div>
</nav>
