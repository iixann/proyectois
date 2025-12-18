<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario - Vinería</title>
    <style>
        .stock-critico { background-color: #ffcccc; color: #cc0000; font-weight: bold; }
        .badge-baja { color: white; background: red; padding: 2px 5px; border-radius: 4px; font-size: 0.8em; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .btn-repo { background: #ff9800; color: white; padding: 10px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

    <h1>Lista de Reposición Urgente</h1>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('products.create') }}" style="background: #28a745; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">+ Nuevo Producto</a>
        
        <a href="/products/low-stock" class="btn-repo">⚠️ Ver Productos a Reponer</a>
    </div>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Código (EAN)</th>
                <th>Nombre del Vino</th>
                <th>Precio</th>
                <th>Stock Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="{{ $product->stock <= 6 ? 'stock-critico' : '' }}">
                    <td>{{ $product->barcode ?? 'S/C' }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        {{ $product->stock }}
                        @if($product->stock <= 6)
                            <span class="badge-baja">REPONER</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">Editar</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>