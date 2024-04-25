<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #EFF3F6;
        }
        .product-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .product-image img {
            max-width: 100%;
            border-radius: 5px;
        }
        .product-info {
            margin-top: 20px;
        }
        .product-name {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }
        .product-description {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .product-categories {
            font-size: 18px;
            color: #666;
            margin-bottom: 15px;
        }
        .product-stock {
            font-size: 18px;
            color: #666;
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
            margin-bottom: 20px;
        }

        .btn-primary:hover {
            background-color: #76b947;
            transform: scale(1.05);
        }
        .size-selection {
            margin-top: 20px;
            margin-bottom: 15px;
        }
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .quantity-btn {
            padding: 10px;
            font-size: 16px;
            color: #333;
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .quantity-input {
            width: 50px;
            text-align: center;
            padding: 5px;
            font-size: 16px;
            margin: 0 10px;
        }

        .star {
            font-size: 30px;
            color: gray;
            cursor: pointer;
            transition: transform 0.2s, color 0.2s;
        }

        .star.selected, .star.hovered {
            color: gold;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<div class="product-container">
    <div class="product-image">
        <img src="{{ $product->photo_url }}" alt="{{ $product->product_name }}">
    </div>
    <div class="product-info">
        <div class="product-name">{{ $product->product_name }}</div>
        <div class="product-price">${{ number_format($product->price, 2) }}</div>
        <div class="product-description">{{ $product->description }}</div>
        <div class="product-stock">
            <p>Stock S: {{ $product->stock_s }}</p>
            <p>Stock M: {{ $product->stock_m }}</p>
            <p>Stock L: {{ $product->stock_l }}</p>
            <p>Stock XL: {{ $product->stock_xl }}</p>
        </div>

        <div class="product-categories">
            Categories:
            @foreach ($product->categories as $category)
                {{ $category->name }}@if (!$loop->last), @endif
            @endforeach
        </div>
        <!-- Size selection -->
        <div class="size-selection">
        <label for="sizeForCart">Select Size:</label>
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" id="hiddenQuantityInput" value="1"> <!-- Ensure this is updated -->
            <select name="size" id="sizeForCart" class="form-control" onchange="updateMaxQuantity()">
                <option value="S" data-stock="{{ $product->stock_s }}">S</option>
                <option value="M" data-stock="{{ $product->stock_m }}">M</option>
                <option value="L" data-stock="{{ $product->stock_l }}">L</option>
                <option value="XL" data-stock="{{ $product->stock_xl }}">XL</option>
                <input type="hidden" id="stock_S" value="{{ $product->stock_s }}">
                <input type="hidden" id="stock_M" value="{{ $product->stock_m }}">
                <input type="hidden" id="stock_L" value="{{ $product->stock_l }}">
                <input type="hidden" id="stock_XL" value="{{ $product->stock_xl }}">
            </select>

            <button type="submit" class="btn-primary">Add to Cart</button>

        </form>
    </div>

    </div>
    <div class="quantity-selector">
        <button class="quantity-btn" data-change="-1" onclick="changeQuantity(-1)">-</button>
        <input type="text" class="quantity-input" value="1" min="1" pattern="\d*" title="Only numbers are allowed" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
        <button class="quantity-btn" data-change="1" onclick="changeQuantity(1)">+</button>
    </div>

    <div class="average-rating">
        @for ($i = 1; $i <= 5; $i++)
            <span class="star {{ $i <= $product->rating ? 'selected' : '' }}">&#9733;</span>  <!-- Unicode star -->
        @endfor
    </div>

    <div class="rating-dropdown">
        <label for="userRating">Rate this product:</label>
        <select id="userRating" name="user_rating">
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ isset($userRating) && $i == $userRating ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <button class="btn-primary" id="submitRating">Submit Rating</button>
    </div>

    </div>
    <a href="/" class="btn-primary">Back to The Home Page</a>
</div>

<script>
function updateMaxQuantity() {
    const selectedSize = document.getElementById('sizeForCart').selectedOptions[0];
    const maxStock = selectedSize.getAttribute('data-stock');
    document.querySelector('.quantity-input').max = maxStock;
}

document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.querySelector('.quantity-input');
    const hiddenQuantityInput = document.getElementById('hiddenQuantityInput');
    const selectSize = document.getElementById('sizeForCart');
    const addToCartButton = document.querySelector('.btn-primary[type="submit"]');
    const buyNowButton = document.querySelector('form[action="{{ route('order.buy') }}"] button[type="submit"]');
    const isLoggedIn = @json(auth()->check()); // Get the user's authentication status
    const submitRatingButton = document.getElementById('submitRating');
    const userRatingSelect = document.getElementById('userRating');

    function updateButtonStatus() {
        const selectedSize = selectSize.value;
        const stock = parseInt(document.getElementById('stock_' + selectedSize).value);
        if (stock === 0 || !isLoggedIn) {
            addToCartButton.disabled = true;
            addToCartButton.style.opacity = 0.5;
            addToCartButton.style.cursor = 'not-allowed';
        } else {
            addToCartButton.disabled = false;
            addToCartButton.style.opacity = 1;
            addToCartButton.style.cursor = 'pointer';
        }
    }
    selectSize.addEventListener('change', updateButtonStatus);

    // Function to update the hidden input for quantity on every change
    function updateHiddenQuantity() {
        hiddenQuantityInput.value = quantityInput.value; // Synchronize the quantity input with the hidden input
    }

    // Event listener for manual changes to the quantity input field
    quantityInput.addEventListener('input', function() {
        let value = parseInt(this.value);
        let max = parseInt(this.max);
        if (value > max) {
            this.value = max;  // Limit the value to the max stock available
        } else if (value < 1) {
            this.value = 1;  // Prevent numbers less than 1
        }
        updateHiddenQuantity();  // Update the hidden input whenever the user changes the value
    });

    // Adding functionality to + and - buttons
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            let change = parseInt(this.getAttribute('data-change'));
            let currentQuantity = parseInt(quantityInput.value);
            let newQuantity = currentQuantity + change;
            if (newQuantity > 0 && newQuantity <= parseInt(quantityInput.max)) {
                quantityInput.value = newQuantity;
            } else if (newQuantity <= 0) {
                quantityInput.value = 1;
            } else {
                quantityInput.value = parseInt(quantityInput.max); // Set to max if overflown
            }
            updateHiddenQuantity(); // Update the hidden input after the button click
        });
    });
    selectSize.addEventListener('change', updateButtonStatus);

        // Function to update star display based on the rating
        submitRatingButton.addEventListener('click', function() {
        const selectedRating = userRatingSelect.value;  // Get the selected rating
        const productId = document.querySelector('input[name="product_id"]').value;  // Product ID

        // Ensure a rating is selected
        if (!selectedRating) {
            console.error('No rating selected');  // Log error if no rating is selected
            return;
        }

        // Submit the rating via AJAX
        fetch('/submit-rating', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content  // CSRF token
            },
            body: JSON.stringify({
                product_id: productId,
                user_rating: selectedRating  // Send the selected rating
            })
        })
        .then(response => {
            if (response.ok) {
                return response.json();  // Parse the JSON response
            } else {
                throw new Error('Failed to submit rating');  // Handle HTTP errors
            }
        })
        .then(data => {
            if (data.success) {
                console.log('Rating submitted successfully');  // Log success
            } else {
                console.error('Rating submission failed');  // Log error
            }
        })
        .catch(error => console.error('Error:', error));  // Catch any other errors
    });

    updateHiddenQuantity(); // Initial sync when the page loads
    updateMaxQuantity();
    updateButtonStatus();
});
</script>

</body>
</html>
