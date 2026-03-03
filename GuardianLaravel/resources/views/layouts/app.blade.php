<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Guardian Zero')</title>

    <!-- Bootstrap (opcional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

    {{-- Navbar --}}
    @include('layouts.navigation')

    <div class="container mt-4">

        {{-- Contenido --}}
        @yield('content')

    </div>

</body>
</html>