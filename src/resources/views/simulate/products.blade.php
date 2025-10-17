<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
<h1>Products</h1>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<ul>
    @foreach($products as $product)
        <li>
            <strong>{{ $product->name }}</strong> - {{ $product->price ?? '0.00' }}
            <form method="POST" action="{{ route('simulate.cart.add') }}" style="display:inline;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                <button type="submit">Add to Cart</button>
            </form>
        </li>
    @endforeach
</ul>

<a href="{{ route('simulate.checkout') }}">Go to Checkout</a><br>
<a href="{{ route('simulate.orders') }}">My Orders</a>
</body>
</html>
