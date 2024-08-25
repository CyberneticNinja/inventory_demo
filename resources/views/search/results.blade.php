@extends('templates.homepage')

@section('title', 'Search Results')

@section('content')
    <h1>Search Results</h1>

    @if($results->isEmpty())
        <p>No results found.</p>
    @else
        <table class="table-auto w-full">
            <thead>
                <tr>
                    @if($searchType == 'items')
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    @elseif($searchType == 'items_sold' || $searchType == 'items_added')
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        @if($searchType == 'items')
                            <td>{{ $result->name }}</td>
                            <td>${{ number_format($result->price, 2) }}</td>
                            <td>{{ $result->description }}</td>
                            <td><a href="{{ url('items', $result->id) }}" class="btn btn-primary">View Item</a></td>
                        @elseif($searchType == 'items_sold' || $searchType == 'items_added')
                            <td>{{ $result->item->name }}</td>
                            <td>{{ $result->quantity }}</td>
                            <td>{{ $result->date }}</td>
                            <td>
                                @if($searchType == 'items_sold')
                                    <a href="{{ url('item_sold', $result->id) }}" class="btn btn-primary">View Item Sold</a>
                                @elseif($searchType == 'items_added')
                                    <a href="{{ url('item_added', $result->id) }}" class="btn btn-primary">View Item Added</a>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $results->links() }}
        </div>
    @endif
@endsection
