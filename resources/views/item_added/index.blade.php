@extends('templates.homepage')

@section('title', 'Item Added List')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Item Added List</h1>

        <a href="{{ route('item_added.create') }}" class="btn btn-primary mb-4">Add New Item Added</a>

        @if ($itemAdded->isEmpty())
            <p>No items added yet.</p>
        @else
            <table class="table w-full bg-base-100 shadow-lg">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemAdded as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <a href="{{ route('item_added.show', $item->id) }}" class="btn btn-secondary">View</a>
                                <a href="{{ route('item_added.edit', $item->id) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('item_added.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection


{{-- @extends('templates.homepage')
@section('title', 'Add Items')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Add Item Added</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('item_added.store') }}" method="POST" class="bg-base-100 p-6 rounded-lg shadow-lg">
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
                <button type="submit" class="btn btn-primary">Add Item Added</button>
                <a href="{{ route('item_added.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection --}}
