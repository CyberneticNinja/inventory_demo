@extends('templates.homepage')

@section('title', 'Edit Item')

@section('content')
    <h2>Edit Item</h2>

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" name="barcode" class="form-control" value="{{ $item->barcode }}" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $item->price }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
@endsection
