<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinería POS - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/inventario.css') }}">
</head>
<body>
    <div class="container">
        <nav style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee; margin-bottom: 20px;">
            <span style="font-weight: bold; color: #722f37;">Vinería Sistema</span>
    
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background: none; border: none; color: #666; cursor: pointer; text-decoration: underline;">
                    Cerrar Sesión
                </button>
            </form>
        </nav>
        @yield('content')
    </div>
</body>
</html>