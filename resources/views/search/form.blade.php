@extends('templates.homepage')

@section('title', 'Reports')

@section('content')

<form action="{{ route('search.results') }}" method="GET" class="space-y-4">
    <div class="form-control">
        <label for="query" class="label">
            <span class="label-text">Search:</span>
        </label>
        <input type="text" name="query" id="query" required class="input input-bordered w-full">
    </div>

    <div class="form-control">
        <label for="type" class="label">
            <span class="label-text">Type:</span>
        </label>
        <select name="type" id="type" required class="select select-bordered w-full">
            <option value="items">Items</option>
            <option value="items_added">Items Added</option>
            <option value="items_sold">Items Sold</option>
        </select>
    </div>

    <div class="form-control">
        <label for="start_date" class="label">
            <span class="label-text">Start Date:</span>
        </label>
        <input type="date" name="start_date" id="start_date" class="input input-bordered w-full">
    </div>

    <div class="form-control">
        <label for="end_date" class="label">
            <span class="label-text">End Date:</span>
        </label>
        <input type="date" name="end_date" id="end_date" class="input input-bordered w-full">
    </div>

    <button type="submit" class="btn btn-primary w-full">Search</button>
</form>

@endsection
