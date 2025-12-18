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
        /* Estilos para el buscador */
        .search-container { margin: 20px 0; display: flex; gap: 10px; }
        .input-search { padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 5px; }
        .btn-search { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .btn-clear { padding: 10px; color: #666; text-decoration: none; align-self: center; }
    </style>
</head>
<body>

@extends('layouts.app')

@section('title', 'Inventario de Vinería')

@section('content')
    <div class="header-actions">
        <h1>Gestión de Inventario 🍷</h1>
        
        <div class="buttons-group">
            <a href="{{ route('products.create') }}" class="btn btn-green">+ Nuevo Producto</a>
            <a href="{{ route('products.lowStock') }}" class="btn btn-orange">⚠️ Reponer Stock</a>
        </div>
    </div>

    <form action="{{ route('products.index') }}" method="GET" class="search-container">
        <input type="text" 
               name="search" 
               placeholder="Buscar por nombre o código EAN..." 
               value="{{ request('search') }}" 
               class="input-search">
        <button type="submit" class="btn btn-blue">🔍 Buscar</button>
        
        @if(request('search'))
            <a href="{{ route('products.index') }}" class="btn-clear">Limpiar</a>
        @endif
    </form>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Código (EAN)</th>
                <th>Vino / Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="{{ $product->stock <= 6 ? 'stock-critico' : '' }}">
                    <td data-label="Código">{{ $product->barcode ?? 'Sin Código' }}</td>
                    <td data-label="Nombre">{{ $product->name }}</td>
                    <td data-label="Precio">${{ number_format($product->price, 2, ',', '.') }}</td>
                    <td data-label="Stock">
                        {{ $product->stock }}
                        @if($product->stock <= 6)
                            <span class="badge-baja">ALERTA</span>
                        @endif
                    </td>
                    <td data-label="Acciones">
                        <div style="display: flex; gap: 10px; justify-content: flex-end;">
                            <a href="{{ route('products.edit', $product->id) }}" style="color: #007bff; text-decoration: none;">Editar</a>
                            
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; padding: 0; font-family: inherit; font-size: inherit;">
                                    Borrar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        No se encontraron productos cargados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="{{ route('sales.create') }}" class="btn btn-blue" style="width: 100%; text-align: center; box-sizing: border-box;">
            🛒 Ir a Pantalla de Ventas (POS)
        </a>
    </div>
@endsection

</body>
</html>