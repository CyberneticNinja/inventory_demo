@extends('templates.homepage')
@section('title', 'View Item')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Item Details</h1>

        <div class="bg-base-100 p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Item Name:</h2>
                <p>{{ $item->name }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">Barcode:</h2>
                <p>{{ $item->barcode }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">Quantity:</h2>
                <p>{{ $item->quantity }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">(Bought)Price:</h2>
                <p>{{ $item->price }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold">(Selling)Price:</h2>
                <p>{{ $item->selling_price }}</p>
            </div>
            <div class="mt-6">
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
