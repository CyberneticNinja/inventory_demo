@extends('templates.homepage')
@section('title', 'View Item Added')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Item Added Details</h1>

        <div class="bg-base-100 p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Item:</h2>
                <p>{{ $itemAdded->item->name }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">Quantity:</h2>
                <p>{{ $itemAdded->quantity }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">Date Added:</h2>
                <p>{{ $itemAdded->date }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">Barcode:</h2>
                <p>{{ $itemAdded->item->barcode }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('item_added.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('item_added.edit', $itemAdded->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('item_added.destroy', $itemAdded->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
