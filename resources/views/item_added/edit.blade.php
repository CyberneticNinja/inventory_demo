@extends('templates.homepage')
@section('title', 'Edit Item Added')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Edit Item Added</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('item_added.update', $itemAdded->id) }}" method="POST" class="bg-base-100 p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="item_id" class="block text-sm font-medium text-gray-700">Select Item</label>
                <select name="item_id" id="item_id" class="select select-bordered w-full mt-1" required>
                    <option value="">-- Choose an Item --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ $itemAdded->item_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="input input-bordered w-full mt-1" value="{{ $itemAdded->quantity }}" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="input input-bordered w-full mt-1" value="{{ $itemAdded->date }}" required>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary">Update Item Added</button>
                <a href="{{ route('item_added.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
