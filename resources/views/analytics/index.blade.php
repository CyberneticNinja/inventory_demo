@extends('templates.homepage')

@section('title', 'Edit Item')

@section('content')
    <h2>Edit Item</h2>
    <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Item Analytics</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('analytics.index') }}" class="mb-6">
        <div class="flex gap-4 items-center">
            <div>
                <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                <select name="month" id="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ $m == $month ? 'selected' : '' }}>
                            {{ date("F", mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach(range(now()->year - 5, now()->year) as $y)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="mt-6 px-4 py-2 bg-indigo-600 text-white font-bold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Apply</button>
        </div>
    </form>

    <!-- Analytics Results -->
    <div class="space-y-6">
        <!-- Most Profitable Item -->
        @if($mostProfitableItem)
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Most Profitable Item</h2>
                <p><strong>Name:</strong> {{ $mostProfitableItem->name }}</p>
                <p><strong>Barcode:</strong> {{ $mostProfitableItem->barcode }}</p>
                <p><strong>Profit:</strong> ${{ number_format($mostProfitableItem->profit, 2) }}</p>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600">No data available for the selected period.</p>
            </div>
        @endif

        <!-- Most Items Sold -->
        @if($mostItemsSold)
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Item with Most Sales</h2>
                <p><strong>Name:</strong> {{ $mostItemsSold->name }}</p>
                <p><strong>Barcode:</strong> {{ $mostItemsSold->barcode }}</p>
                <p><strong>Total Sold:</strong> {{ $mostItemsSold->total_sold }}</p>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600">No data available for the selected period.</p>
            </div>
        @endif
    </div>
</div>
@endsection