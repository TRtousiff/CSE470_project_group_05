<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-Commerce Site</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            padding-top: 80px; /* Adjust based on your top bar's height */
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #EFF3F6;
            overflow-x: hidden; /* Hide horizontal overflow */
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
        .left-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .logo img {
            height: 50px; /* Adjust based on your logo size */
        }

        .contact-info {
            font-size: 16px;
        }
        .auth-buttons {
            display: flex;
            gap: 10px;
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
            margin-right: 100px; /* Moves the search bar slightly to the left */
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
        .banner-container {
            display: flex;
            justify-content: flex-end; /* Aligns the banner to the right side of the screen */
            width: 100%; /* Ensures the container spans the full width of its parent */
            padding-top: 20px; /* Space below the top-bar */
        }
        .categories {
            flex: 1; /* Allows the categories to grow as needed */
            margin-right: 20px; /* Adds some space between categories and banners */
        }
        .categories-box {
            background-color: rgba(255, 255, 255, 0.5); /* Transparent gray */
            padding: 15px;
            margin-bottom: 20px; /* Separation between the box and whatever comes next */
            border-radius: 35px;
            width: 400px; /* Or you could try 'max-content' to fit content's width */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1); /* Adds shadow around the box */
        }
        .categories ul {
            list-style-type: none; /* Removes default list styling */
            margin: 0;
            padding: 0;
        }
        .categories ul li {
            margin: 5px 0; /* Adjust space between list items as needed */
        }
        .categories ul li a {
            color: rgb(46, 46, 46); /* Text color */
            text-decoration: none; /* Removes underline */
            font-family: 'Roboto', sans-serif; /* Specifies the font */
            display: block; /* Changes the display to block to make the entire list item clickable */
            padding: 5px 0; /* Adds some padding */
            transition: font-size 0.3s ease-in-out; /* Applies a transition effect to font-size changes */
        }
        .categories ul li a:hover {
            text-decoration: none; /* Ensures the underline doesn't reappear on hover */
            font-size: 1.1em; /* Slightly increases the font size */
        }
        .banners {
            width: 100%; /* Adjust based on the desired width of your banners */
            position: relative;
            overflow: hidden;
            left: 200px;
        }
        .banner {
            position: absolute;
            width: 100%;
            height: auto; /* Allows the banner to maintain aspect ratio */
            transition: opacity 1s ease-in-out;
            opacity: 0; /* Banner starts invisible */
            visibility: hidden; /* Banner is not clickable */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .banner.show {
            opacity: 1;
            visibility: visible;
            position: relative; /* Makes the banner part of the document flow */
        }
        .banner img {
            max-width: 60%; /* Decrease the size of the image - Adjust this value to change size */
            height: auto; /* Maintain aspect ratio */
            object-fit: cover;
            border-radius: 35px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1); /* Adds shadow around the box */
        }

        .banner:hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 210px;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.1); /* Gray transparent overlay */
            transition: background-color 0.5s; /* Smooth transition for the overlay */
            width: 650px;
            border-radius: 35px;
        }

        .nav-button {
            padding: 10px 15px; /* Adjust padding */
            font-size: 20px; /* Adjust font size */
            color: #FFFFFF; /* Text color */
            background: rgba(0, 86, 179, 0.5); /* Background color */
            border: none; /* Removes border */
            border-radius: 15px; /* Rounded corners */
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s; /* Smooth background color change and transform on hover */
        }
        .nav-button:hover {
            background-color: rgb(199, 224, 231); /* Darker shade on hover */
            transform: scale(1.1); /* Slightly enlarges the button on hover */
        }
        .left-nav, .right-nav {
            position: absolute;
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust alignment to the center of the parent */
            z-index: 30; /* Ensure they appear above the banners */
            pointer-events: auto; /* Allow the buttons to be clickable */
        }
        .left-nav {
            left: 220px; /* Align to the left side */
        }
        .right-nav {
            right: 220px; /* Align to the right side */
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
            width: 200px;  /* Fixed width for each product */
            min-height: 100px; /* Minimum height to maintain box size */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .product img {
            width: 100%; /* Ensures image takes up the full width of the box */
            height: 160px; /* Fixed height for images */
            object-fit: cover; /* Ensures the image covers the area without distorting aspect ratio */
        }

        .product h3 {
            text-align: center;
            margin: 5px 0 0 0; /* Reduced bottom margin to tighten the gap */
        }

        .product p {
            text-align: center;
            margin: 2px 0 10px; /* Minimal margin at the top, larger at the bottom */
        }

        .product a {
            padding: 5px 10px;
            background-color: #c7e0e7;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: auto; /* Pushes the link towards the bottom of the flex container */
        }

        .product a:hover {
            background-color: #a3bec9;
        }

        .auth-buttons button {
            background-color: #008080; /* Green background */
            color: white; /* White text */
            border-radius: 4px; /* Rounded corners */
            transition: background-color 0.3s, transform 0.2s; /* Smooth transitions for hover effects */
        }

        .auth-buttons button:hover {
            background-color: #76b947; /* Darker shade of green on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }

        .cart-button {
            padding: 5px 50px;
            display: inline-block;

        }

        .cart-button img {
            vertical-align: middle;
            width: 1000px; /* Adjust width as needed */
            height: auto; /* Adjust height as needed to maintain aspect ratio */
        }

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
</head>
<body>

<div class="top-bar">
    <div class="left-section">
        <!-- Logo as a link to refresh the page -->
        <a href="/" class="logo">
            <img src="https://i.postimg.cc/HLTrHxJ9/Logo-Modified.png" alt="E-Commerce Site Logo">
        </a>
        <div class="contact-info">
            <span>Contact: ecommerce@abc.com</span>
        </div>
    </div>
    <form class="search-form" onsubmit="event.preventDefault();">
        <input type="text" placeholder="Search in E-Shop" id="searchInput">
        <button type="submit"><img src="https://i.postimg.cc/Jhr5kFsh/Search-Icon-Modified.png" alt="Search"></button>
    </form>
    <!-- Add this within your .top-bar div -->
    <div class="cart-button" href="{{ route('cart.index') }}">
        <a href="{{ route('cart.index') }}">
            <img src="https://i.postimg.cc/GmrQXxt9/Cart-Icon-Modified.png" alt="View Cart" style="height: 24px; width: 24px;">
        </a>
    </div>

    <div class="auth-buttons">
        @guest
        <button onclick="window.location.href='{{ route('login') }}';">Login</button>
        <button onclick="window.location.href='{{ route('register') }}';">Register</button>
        @endguest
        @auth
        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
    </div>
</div>


<div class="banner-container">
    <div class="categories">
        <div class="categories-box">
            <h4>Categories</h4>
            <ul class="list-group">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="banners">
        <div class="left-nav">
            <button class="nav-button" onclick="navigate(-1)">&#10094;</button>
        </div>
        <div class="right-nav">
            <button class="nav-button" onclick="navigate(1)">&#10095;</button>
        </div>
        @foreach ($banners as $index => $banner)
        <a href="{{ route('category.show', ['id' => $banner->category_id]) }}" class="banner-link" style="display: block;">
            <div class="banner {{ $index === 0 ? 'show' : '' }}">
                <img src="{{ $banner->photo_url }}" alt="Banner Image">
            </div>
        </a>
        @endforeach
    </div>
</div>

<div class="product-listing" id="productListing">
    @foreach ($products as $product)
    <div class="product" data-name="{{ strtolower($product->product_name) }}">
        <img src="{{ $product->photo_url }}" alt="{{ $product->product_name }}" style="width: 100%; max-width: 200px; height: auto;">
        <h3>{{ $product->product_name }}</h3>
        <p>${{ $product->price }}</p>
        <a href="{{ route('product.show', $product->id) }}">View Details</a>
    </div>
    @endforeach
</div>

<script>
let currentIndex = 0;
const banners = document.querySelectorAll('.banner');
let autoChange = setInterval(() => navigate(1), 4000); // Starts automatic banner change

function navigate(direction) {
    clearInterval(autoChange); // Stops the current automatic change interval
    changeBanner((currentIndex + direction + banners.length) % banners.length);
    autoChange = setInterval(() => navigate(1), 4000); // Restarts automatic banner change
}

function changeBanner(index) {
    banners[currentIndex].classList.remove('show');
    banners[index].classList.add('show');
    currentIndex = index;
}

// Search functionality
document.querySelector('.search-form').addEventListener('submit', function() {
    let searchQuery = document.getElementById('searchInput').value.toLowerCase();
    let products = document.querySelectorAll('.product');
    products.forEach(product => {
        if (product.getAttribute('data-name').includes(searchQuery) || !searchQuery) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
});
</script>

<!-- Additional page content can be added here -->
</body>
</html>

