<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Venta - Vinería</title>
</head>
<body>
    <h1>Registrar Venta de Vino 🍷</h1>

    <a href="{{ route('products.index') }}">⬅️ Volver al listado</a>
    <br><br>

    @if(session('error'))
        <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div>
            <label>Seleccionar Vino:</label>
            <select name="product_id" required>
                <option value="">-- Seleccione un producto --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} (Stock: {{ $product->stock }}) - ${{ $product->price }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label>Cantidad a vender:</label>
            <input type="number" name="quantity" value="1" min="1" required>
        </div>

        <br>

        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px; cursor: pointer;">
            Finalizar Venta
        </button>
    </form>
</body>
</html>