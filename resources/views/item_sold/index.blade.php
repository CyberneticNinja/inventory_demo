@extends('templates.homepage')
@section('title', 'Items List')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Items Sold List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('item_sold.create') }}" class="btn btn-primary mb-4">Add Item Sold</a>

        <table class="table-auto w-full bg-base-100">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemSold as $item)
                    <tr>
                        <td>{{ $item->item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->date->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('item_sold.edit', $item) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('item_sold.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item sold record?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
