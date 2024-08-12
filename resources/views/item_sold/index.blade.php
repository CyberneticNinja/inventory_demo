@extends('templates.homepage')

@section('title', 'Item Sold List')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Item Sold List</h1>

        <a href="{{ route('item_sold.create') }}" class="btn btn-primary mb-4">Add New Item Sold</a>

        @if ($itemSold->isEmpty())
            <p>No items sold yet.</p>
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
                    @foreach ($itemSold as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <a href="{{ route('item_sold.show', $item->id) }}" class="btn btn-danger">View</a>
                                <a href="{{ route('item_sold.edit', $item->id) }}" class="btn btn-danger">Edit</a>
                                <form action="{{ route('item_sold.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $itemSold->links() }}
            </div>
        @endif
    </div>
@endsection
