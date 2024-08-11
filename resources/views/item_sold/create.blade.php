@extends('templates.homepage')
@section('title', 'Add Item Sold')

@section('content')
   <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Add Item Sold</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('item_sold.store') }}" method="POST" class="bg-base-100 p-6 rounded-lg shadow-lg">
            @csrf

            <div class="mb-4">
                <label for="item_id" class="block text-sm font-medium text-gray-700">Select Item</label>
                <select name="item_id" id="item_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Choose an Item --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="input input-bordered w-full mt-1" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="input input-bordered w-full mt-1" required>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary">Add Item Sold</button>
                <a href="{{ route('item_sold.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection