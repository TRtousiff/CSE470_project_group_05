<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} | My E-Commerce Site</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            padding-top: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #EFF3F6;
        }
        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #B0C4DE;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            z-index: 1000;
        }
        .logo {
            cursor: pointer;
        }
        .logo img {
            height: 50px;
        }
        
        .logo a:hover {
            transform: scale(1.1); /* Increase the size of the logo slightly on hover */
        }
        button, .search-form button {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border: none;
            background-color: #f0f0f0; /* Example styling */
        }
        .search-form {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            margin-left: 150px; /* Moves the search bar slightly to the left */
        }
        .search-form input, .search-form button {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 15px;
        }
        .search-form input{
            width: calc(50% - 30px);
        }
        .search-form button img {
            height: 20px; /* Example size, adjust as needed */
        }
        .home-button {
            background-color: #f0f0f0;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .product-listing {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .product {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            background: #fff;
            width: 200px;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }
        .product img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }
        .product h3, .product p {
            margin: 5px 0;
            text-align: center;
        }
        .product a {
            padding: 5px 10px;
            background-color: #c7e0e7;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .product a:hover {
            background-color: #a3bec9;
        }

        .home-button {
            background-color: #008080; /* Blue background */
            color: white; /* White text */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s; /* Smooth transition for hover effects */
        }

        .home-button:hover {
            background-color: #76b947; /* Darker blue variant for hover */
            transform: scale(1.05); /* Slightly larger on hover */
        }

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
</head>
<body>

<div class="top-bar">
    <div class="logo" onclick="window.location.href='/'">
        <img src="https://i.postimg.cc/HLTrHxJ9/Logo-Modified.png" alt="E-Commerce Site Logo">
    </div>
    <form class="search-form" onsubmit="event.preventDefault(); filterProducts()">
        <input type="text" placeholder="Search in E-Shop" id="searchInput">
        <button type="submit"><img src="https://i.postimg.cc/Jhr5kFsh/Search-Icon-Modified.png" alt="Search"></button>
    </form>
    <button class="home-button" onclick="window.location.href='/'">Back to The Home Page</button>
</div>

<div class="product-listing">
    @foreach ($category->products as $product)
    <div class="product" data-name="{{ strtolower($product->product_name) }}">
        <img src="{{$product->photo_url }}" alt="{{ $product->product_name }}">
        <h3>{{ $product->product_name }}</h3>
        <p>${{ number_format($product->price, 2) }}</p>
        <a href="{{ route('product.show', $product->id) }}">View Details</a>
    </div>
    @endforeach
</div>

<script>
function filterProducts() {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let products = document.querySelectorAll('.product');
    products.forEach(function(product) {
        let name = product.getAttribute('data-name');
        if (name.includes(input) || input === '') {
            product.style.display = 'flex';
        } else {
            product.style.display = 'none';
        }
    });
}
</script>

</body>
</html>
