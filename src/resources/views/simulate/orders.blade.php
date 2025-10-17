<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
</head>
<body>
<h1>My Orders</h1>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if($orders->isEmpty())
    <p>You have no orders.</p>
@else
    <ul>
        @foreach($orders as $order)
            <li>
                Order #{{ $order->id }} - Total: {{ $order->total ?? '0.00' }} - Status: {{ $order->status ?? 'N/A' }}
                <ul>
                    @foreach($order->items as $item)
                        <li>{{ $item->product->name ?? 'Product' }} x {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endif

<a href="{{ route('simulate.products') }}">Back to Products</a>
</body>
</html>
