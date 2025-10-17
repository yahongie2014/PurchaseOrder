<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
<h1>Checkout</h1>

@if($products->isEmpty())
    <p>Your cart is empty.</p>
    <a href="{{ route('simulate.products') }}">Back to Products</a>
@else
    <form method="POST" action="{{ route('simulate.checkout.process') }}">
        @csrf
        <ul>
            @php $total = 0; @endphp
            @foreach($products as $product)
                @php
                    $qty = $cart[$product->id] ?? 0;
                    $lineTotal = ($product->price ?? 0) * $qty;
                    $total += $lineTotal;
                @endphp
                <li>{{ $product->name }} - Qty: {{ $qty }} - Price: {{ $product->price }} -
                    Subtotal: {{ $lineTotal }}</li>
            @endforeach
        </ul>
        <strong>Total: {{ $total }}</strong><br><br>
        <button type="submit">Place Order</button>
    </form>
    <a href="{{ route('simulate.products') }}">Back to Products</a>
@endif
</body>
</html>
