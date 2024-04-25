<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Stylesheets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- Example for including CSS --}}
</head>
<body>
    <header>
        <!-- Navbar or Header content here -->
    </header>

    <main class="py-4">
        @yield('content') {{-- This line displays the content from child views --}}
    </main>

    <footer>
        <!-- Footer content here -->
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> {{-- Example for including JavaScript --}}
</body>
</html>
