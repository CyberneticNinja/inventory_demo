@extends('templates.homepage')
@section('title', 'Items Added List')

@section('content')
    <h1 class="text-3xl font-bold">Items Added List</h1>
            <a href="{{ route('item_added.create') }}" class="btn btn-primary mb-4">Add New Item</a>

        <table class="table table-striped mt-4">
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
                        <a href="{{ route('item_added.show', $item->id) }}" class="btn btn-danger">View</a>
                        <a href="{{ route('item_added.edit', $item->id) }}" class="btn btn-danger">Edit</a>
                            <form action="{{ route('item_added.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $itemAdded->links() }}
    </div>
@endsection
