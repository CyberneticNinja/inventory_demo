@extends('templates.homepage')

@section('title', 'Inventory System Demo')

@section('content')
<div class="container mx-auto p-6">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Inventory System Demo</h1>
        <p class="text-lg mb-6">
            Welcome to the Inventory System Demo. This system was built by <strong>Stephen Abrokwah</strong> to showcase 
            my expertise in PHP, Laravel, Databases, APIs, DaisyUI and more. Explore the features and functionalities of the system.
        </p>
        <p class="text-lg mb-6">
            -For demo purposes data is reset every 60 mins
        <p>
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/demo_image.jpeg') }}" alt="Demo Image" class="rounded-lg shadow-lg w-2/3 sm:w-1/3">
        </div>

        <div class="space-y-4">
            <a href="{{ route('analytics.index') }}" class="btn btn-primary">View Analytics</a>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">View Items</a>
        </div>
    </div>
</div>
@endsection
