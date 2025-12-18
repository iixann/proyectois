<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket #{{ $sale->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/ticket.css') }}">
</head>
<body>
    <div class="text-center header">
        <h2>VINERÍA POS 🍷</h2>
        <p>Ticket de Venta #{{ $sale->id }}</p>
        <p>Fecha: {{ $sale->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <table class="item-table">
        <thead>
            <tr>
                <th align="left">Producto</th>
                <th align="right">Cant.</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td align="right">{{ $item->quantity }}</td>
                <td align="right">${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <div style="display: flex; justify-content: space-between;">
            <span>TOTAL:</span>
            <span>${{ number_format($sale->total, 2) }}</span>
        </div>
    </div>

    <div class="text-center footer">
        <p>¡Gracias por su compra!</p>
        <button onclick="window.print()" class="no-print" style="margin-top: 20px; padding: 10px; cursor: pointer;">
            🖨️ IMPRIMIR TICKET
        </button>
        <br><br>
        <a href="{{ route('products.index') }}" class="no-print">Volver al sistema</a>
    </div>
</body>
</html>