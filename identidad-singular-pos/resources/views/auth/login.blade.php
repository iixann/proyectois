<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso - Sistema Vinería</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="login-card">
        <h2>Vinería POS 🍷</h2>
        
        @if($errors->any())
            <div class="error-msg">
                Credenciales incorrectas. Intente de nuevo.
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Usuario (Email)</label>
                <input type="email" name="email" placeholder="admin@vineria.com" required autofocus>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">INGRESAR</button>
        </form>
    </div>

</body>
</html>