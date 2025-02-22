<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Name')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        .navbar a.active {
            font-weight: bold;
            border-bottom: 2px solid #fff;
        }
        .auth-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body style="background-color: lavender">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid justify-content-center">
            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Iniciar Sesión</a>
            <a href="{{ route('registro') }}" class="{{ request()->routeIs('registro') ? 'active' : '' }}">Registro</a>
        </div>
    </nav>

    <!-- Contenedor del formulario -->
    <div class="auth-container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>