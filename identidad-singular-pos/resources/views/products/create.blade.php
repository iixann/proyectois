<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto - Vinería</title>
</head>
<body>

    <h1>Cargar Nuevo Producto 🍷</h1>

    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <strong>¡Atención!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block;"><strong>Código de Barras (EAN)</strong></label>
            <input type="text" name="barcode" value="{{ old('barcode') }}" 
                   placeholder="Pasá el escáner por la botella..." 
                   autofocus 
                   style="width: 300px; padding: 5px;">
            <small style="color: gray; display: block;">El cursor ya está aquí, solo pasá el escáner.</small>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block;"><strong>Nombre del Producto</strong></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Ej: Malbec Reserva" style="width: 300px; padding: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block;"><strong>Precio de Venta</strong></label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00" style="width: 300px; padding: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block;"><strong>Stock Inicial</strong></label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}" style="width: 300px; padding: 5px;">
        </div>

        <button type="submit" style="background-color: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            Guardar Producto
        </button>
    </form>

    <p><a href="{{ route('products.index') }}">⬅️ Volver al listado</a></p>

</body>
</html>