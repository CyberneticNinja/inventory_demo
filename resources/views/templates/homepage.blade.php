<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory Demo - Homepage')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-base-200">

    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-lg">
        <div class="flex-1">
            <a href="{{ url('/') }}" class="btn btn-ghost normal-case text-xl">Inventory Demo</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('items.index') }}">Items</a></li>
                <li><a href="{{ route('item_sold.index') }}">Items Sold</a></li>
                <li><a href="{{ route('item_added.index') }}">Add Items</a></li>
                <li><a href="{{ route('analytics.index')}}">Analytics</a></li>
                <li><a href="{{ route('reports') }}">Reports</a></li>

                <!-- Show login if not authenticated, else show logout -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mx-auto py-6">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer p-10 bg-base-200 text-base-content">
        <div>
            <p>Inventory Demo<br>Efficient Inventory Management since 2024</p>
        </div> 
        <div>
            <span class="footer-title">Quick Links</span> 
            <a href="{{ route('home') }}">Home</a> 
            @guest
                <a href="{{ route('login') }}">Login</a>
            @endguest
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('items.index') }}">Items</a>
                <a href="{{ route('item_sold.index') }}">Items Sold</a>
                <a href="{{ route('item_added.index') }}">Add Items</a>
                <a href="{{ route('analytics.index')}}">Analytics</a>
                <a href="{{ route('reports') }}">Reports</a>
        </div> 
        <div>
            <span class="footer-title">Contact Us</span> 
            <a class="link link-hover">Support</a> 
            <a class="link link-hover">Help Center</a>
            <a class="link link-hover">Feedback</a>
        </div>
    </footer>

</body>
</html>
