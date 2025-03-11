<nav class="sidebar nav flex-column pt-8">
    <!-- Imagen del sidebar -->
    <div class="sidebar-logo text-center mb-4">
        <img src="{{ asset('assets/JAC-Logo.png') }}" alt="Logo Jac Automotriz" class="img-fluid" style="max-width: 150px;">
    </div>

    <!-- Línea horizontal para separar la imagen de los enlaces -->
    <hr class="sidebar-divider">

    <!-- Enlaces de navegación -->
    <a href="{{ url('/catalogos/citas') }}" class="nav-link">Citas</a>
    <a href="{{ url('/catalogos/clientes') }}" class="nav-link">Clientes</a>
    <a href="{{ url('/catalogos/empleados') }}" class="nav-link">Empleados</a>
    <a href="{{ url('/catalogos/puestos') }}" class="nav-link">Puestos</a>

    <!-- Línea horizontal para agrupar secciones -->
    <hr class="sidebar-divider">

    <a href="{{ url('/catalogos/servicios') }}" class="nav-link">Servicios</a>
    <a href="{{ url('/catalogos/ventas') }}" class="nav-link">Ventas</a>

    <!-- Línea horizontal para separar secciones -->
    <hr class="sidebar-divider">

    <a href="{{ url('/reportes') }}" class="nav-link">Reportes</a>
    <a href="{{ url('/logout') }}" class="nav-link">Salir</a>
</nav>