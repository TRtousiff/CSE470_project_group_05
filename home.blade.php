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
        }
        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #c7e0e7;
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
            width: calc(50% - 30px)
        }
        .search-form button img {
            height: 20px; /* Example size, adjust as needed */
        }

        .banners {
            width: 80%;
            margin: 20px auto; /* Decreased top margin to move banners up */
            position: relative;
            overflow: hidden;
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
        }

        .navigation {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%; /* Make sure the navigation covers the entire height of the banners container */
            display: flex;
            justify-content: space-between;
            align-items: center; /* This will vertically center the buttons within the banner area */
            z-index: 20; /* Ensures navigation is above the banners */
            pointer-events: none; /* Prevents the navigation container from capturing clicks, allowing banner links (if any) to be clickable */
        }

        .nav-button {
            pointer-events: auto; /* Enables clicks on the buttons themselves */
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background for visibility and design */
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 24px; /* Adjust size according to your design needs */
            border-radius: 20px;
        }

    </style>
</head>
<body>

<div class="top-bar">
        <div class="left-section">
            <div class="logo">
                <img src="https://i.postimg.cc/HLTrHxJ9/Logo-Modified.png" alt="E-Commerce Site Logo">
            </div>
            <div class="contact-info">
                <span>Contact: ecommerce@abc.com</span>
            </div>
        </div>
        <form class="search-form" onsubmit="event.preventDefault();">
            <input type="text" placeholder="Search in E-Shop">
            <button type="submit"><img src="https://i.postimg.cc/Jhr5kFsh/Search-Icon-Modified.png" alt="Search"></button>
        </form>
        <div class="auth-buttons">
            <button onclick="window.location.href='/login';">Login</button>
            <button onclick="window.location.href='/register';">Register</button>
        </div>
    </div>

    <div class="banners">
        <div class="navigation">
            <button class="nav-button" onclick="navigate(-1)">&#10094;</button>
            <button class="nav-button" onclick="navigate(1)">&#10095;</button>
        </div>
        @foreach ($banners as $index => $banner)
        <div class="banner {{ $index === 0 ? 'show' : '' }}">
            <img src="{{ $banner->photo_url }}" alt="Banner Image">
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
</script>

    <!-- Additional page content can be added here -->
</body>
</html>
