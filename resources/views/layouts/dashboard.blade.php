<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 50px;
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 60px; /* Ancho colapsado */
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: flex;
            align-items: center;
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        }
        .sidebar a i {
            margin-right: 10px;
            width: 20px; /* Ancho fijo para los iconos */
        }
        .sidebar.collapsed a span {
            display: none; /* Oculta el texto cuando la barra está colapsada */
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .content.collapsed {
            margin-left: 60px; /* Ajusta el margen cuando la barra está colapsada */
        }
        .toggle-sidebar-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Botón para colapsar/expandir la barra lateral -->
    <button class="toggle-sidebar-btn" onclick="toggleSidebar()">☰</button>

    <!-- Barra lateral -->
    <div class="sidebar" id="sidebar">
        <a href="{{ route('inventario') }}">
            <i class="fas fa-box"></i>
            <span>Inventario</span>
        </a>
        <a href="{{ route('orden.compra') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Orden de Compra</span>
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Sesión</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Contenido principal -->
    <div class="content" id="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para colapsar/expandir la barra lateral
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        }
    </script>
</body>
</html>