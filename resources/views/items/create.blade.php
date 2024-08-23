@extends('templates.homepage')
@section('title', 'Add New Item')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Add New Item</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('items.store') }}" method="POST" class="bg-base-100 p-6 rounded-lg shadow-lg">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Item Name</label>
                <input type="text" name="name" id="name" class="input input-bordered w-full mt-1" required>
            </div>

            <div class="mb-4">
                <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode</label>
                <input type="text" name="barcode" id="barcode" class="input input-bordered w-full mt-1" required>
            </div>

            {{-- <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="input input-bordered w-full mt-1" required>
            </div> --}}

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price (Bought)</label>
                <input type="text" name="price" id="price" class="input input-bordered w-full mt-1" required>
            </div>
            <div class="mb-4">
                <label for="selling_price" class="block text-sm font-medium text-gray-700">Price (Selling)</label>
                <input type="text" name="selling_price" id="selling_price" class="input input-bordered w-full mt-1" required>
            </div>
            <div class="mt-6">
                <button type="submit" class="btn btn-primary">Add Item</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
