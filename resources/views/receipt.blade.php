<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receipt #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .total { text-align: right; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <h2>Restaurant Receipt</h2>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Table:</strong> {{ $order->table->name }}</p>
    <p><strong>Cashier:</strong> {{ $order->user->name }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->menu->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->menu->price, 0, ',', '.') }}</td>
                <td>{{ number_format($item->menu->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="total">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</p>
</body>
</html>
