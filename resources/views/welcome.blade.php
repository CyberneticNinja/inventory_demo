<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Daisy UI Example</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-base-200">

    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-lg">
        <div class="flex-1">
            <a href="#" class="btn btn-ghost normal-case text-xl">MyWebsite</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero min-h-screen bg-base-300">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">Welcome to MyWebsite</h1>
                <p class="py-6">Discover the best services and products to meet your needs.</p>
                <a href="#" class="btn btn-primary">Get Started</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="p-6">
        <h2 class="text-3xl font-bold text-center mb-6">Our Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Feature One</h2>
                    <p>Some details about the first feature. It's really great and helpful!</p>
                    <div class="card-actions justify-end">
                        <a href="#" class="btn btn-secondary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Feature Two</h2>
                    <p>This feature is even better than the first one. You should check it out.</p>
                    <div class="card-actions justify-end">
                        <a href="#" class="btn btn-secondary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Feature Three</h2>
                    <p>And this one is the best of all. You won't believe how amazing it is!</p>
                    <div class="card-actions justify-end">
                        <a href="#" class="btn btn-secondary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer p-10 bg-base-200 text-base-content">
        <div>
            <p>MyWebsite<br>Providing reliable tech since 2024</p>
        </div> 
        <div>
            <span class="footer-title">Services</span> 
            <a class="link link-hover">Branding</a> 
            <a class="link link-hover">Design</a> 
            <a class="link link-hover">Marketing</a> 
            <a class="link link-hover">Advertisement</a>
        </div> 
        <div>
            <span class="footer-title">Company</span> 
            <a class="link link-hover">About us</a> 
            <a class="link link-hover">Contact</a> 
            <a class="link link-hover">Jobs</a> 
            <a class="link link-hover">Press kit</a>
        </div> 
        <div>
            <span class="footer-title">Legal</span> 
            <a class="link link-hover">Terms of use</a> 
            <a class="link link-hover">Privacy policy</a> 
            <a class="link link-hover">Cookie policy</a>
        </div>
    </footer>

</body>
</html>
