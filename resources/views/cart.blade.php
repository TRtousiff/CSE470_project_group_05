<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            background-color: #EFF3F6;
            color: #333;
        }
        h1 {
            color: #0047AB;
            text-align: center;
            margin-bottom: 20px;
        }
        .cart-item {
            background: #008080;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: flex-start;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
            margin-right: 20px;
        }
        .cart-item p {
            margin: 0;
            padding-right: 20px;
        }
        .details {
            flex-grow: 1;
        }
        .cart-item .quantity, .cart-item .price, .cart-item .total, .cart-item .size {
            font-size: 20px;
            color: #F8F8FF;
            align-items: center;
            margin-bottom: 10px;
            margin-left: 50px;
        }

        .product-name {
            font-size: 28px;
            color: #F8F8FF;
            align-self: center;
            font-family: "IM Fell DW Pica SC", serif;
            font-weight: 400;
            font-style: normal;
        }

        a {
            color: #0047AB;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        .home-link {
            background-color: #0047AB;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .home-link:hover {
            background-color: #76b947;
            transform: scale(1.05);
            text-decoration: none;
        }

        .edit-btn, .delete-btn {
            padding: 8px 16px;
            margin: 5px;
            background-color: #76b947;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .delete-btn {
            background-color: #d9534f;
        }

        .delete-btn:hover {
            background-color: #c9302c;
        }

        .btn-primary {
            background-color: #0047AB;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            text-decoration: none;
            display: inline-block; /* Ensure it's properly aligned */
            margin-top: 20px; /* Space from the cart list */
        }

        .btn-primary:hover {
            background-color: #76b947;
            transform: scale(1.05);
        }

        .footer-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .total-cart-cost {
            font-size: 20px;
            color: #333; /* Adjust color as needed */
        }

    </style>
</head>
<body>
@auth
    <a href="/" class="home-link">Back to The Home Page</a>
    <h1>Your Cart</h1>

    @php $totalCost = 0; @endphp
    @forelse($cartItems as $item)
        @php
        $totalCost += $item->quantity * $item->product->price;
        @endphp
        <input type="hidden" id="stock_{{ strtolower($item->size) }}" value="{{ $item->product['stock_' . strtolower($item->size)] }}">
        <div class="cart-item">
            <img src="{{ $item->product->photo_url }}" alt="{{ $item->product->product_name }}">
            <p class="product-name">{{ $item->product->product_name }}</p>
            <div class="details">
                <p class="size">Size: {{ $item->size }}</p>
                <p class="quantity">Quantity: {{ $item->quantity }}</p>
                <p class="price">Price: ${{ number_format($item->product->price, 2) }}</p>
                <p class="total">Total: ${{ number_format($item->quantity * $item->product->price, 2) }}</p>
            </div>
            <div>
                <button onclick="if(confirm('Are you sure you want to delete this item?')) window.location='{{ route('delete.cart.item', ['id' => $item->id]) }}'" class="delete-btn">Delete Product</button>
            </div>
        </div>
    @empty
        <p>Your cart is empty.</p>
    @endforelse
    @php
        $queryString = http_build_query(['cart' => json_encode($cartItems->toArray())]);
    @endphp
    @if($totalCost > 0)
        <div class="footer-actions">
            <p class="total-cart-cost">Total Cart Cost: ${{ number_format($totalCost, 2) }}</p>
            <form action="{{ route('shipment.info') }}" method="GET">
                @foreach ($cartItems as $item)
                    <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
                @endforeach
                <button type="submit" class="btn-primary">Place Order</button>
            </form>

        </div>
    @endif
    @else
    <h1>Cart</h1>
    <p>You need to <a href="{{ route('login') }}">login</a> to see the items in your cart.</p>
    @endauth

<script>
function validateStock() {
    var issues = [];
    @foreach($cartItems as $item)
        var stock = parseInt(document.getElementById('stock_' + '{{ strtolower($item->size) }}').value);
        if ({{ $item->quantity }} > stock) {
            issues.push('{{ $item->product->product_name }} size {{ $item->size }} only has ' + stock + ' in stock but you have requested ' + {{ $item->quantity }});
        }
    @endforeach

    if (issues.length > 0) {
        alert("Cannot place order:\n" + issues.join("\n"));
        return false;
    }
    return true;
}
</script>

</body>
</html>
