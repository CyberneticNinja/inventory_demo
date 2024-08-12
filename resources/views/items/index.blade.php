
@extends('templates.homepage')
@section('title', 'Items List')

@section('content')
    <h1 class="text-3xl font-bold">Items List</h1>
        <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->barcode }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $items->links() }}
    </div>
@endsection
