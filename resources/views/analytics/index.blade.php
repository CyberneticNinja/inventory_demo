@extends('templates.homepage')

@section('title', 'Analytics')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Item Analytics</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('analytics.index') }}" class="mb-6">
        <div class="flex gap-4 items-center">
            <!-- Month and Year Selectors -->
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

    <!-- Analytics Results in a Grid Layout -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Best-Selling Items Chart -->
        <div class="bg-white p-6 rounded-lg shadow">
            @if($topSellingItems->isNotEmpty())
                <h2 class="text-xl font-semibold mb-2">Top 5 Best-Selling Items</h2>
                <canvas id="bestSellingChart"></canvas>
            @else
                <p>No data available for the selected month and year.</p>
            @endif
        </div>

        <!-- Least-Selling Items Chart -->
        <div class="bg-white p-6 rounded-lg shadow">
            @if($leastSellingItems->isNotEmpty())
                <h2 class="text-xl font-semibold mb-2">Top 5 Least-Selling Items</h2>
                <canvas id="leastSellingChart"></canvas>
            @else
                <p>No data available for the selected month and year.</p>
            @endif
        </div>

        <!-- Profit Analysis Chart -->
        <div class="bg-white p-6 rounded-lg shadow">
            @if($profitAnalysis->isNotEmpty())
                <h2 class="text-xl font-semibold mb-2">Profit Analysis</h2>
                <canvas id="profitChart"></canvas>
            @else
                <p>No data available for the selected month and year.</p>
            @endif
        </div>

        <!-- Monthly Sales Trend Chart -->
        <div class="bg-white p-6 rounded-lg shadow">
            @if($monthlySalesTrend->isNotEmpty())
                <h2 class="text-xl font-semibold mb-2">Monthly Sales Trend</h2>
                <canvas id="monthlySalesChart"></canvas>
            @else
                <p>No data available for the selected year.</p>
            @endif
        </div>
    </div>
</div>


<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Prepare the data for charts
    const bestSellingData = {
        labels: @json($topSellingItems->pluck('name')),
        datasets: [{
            label: 'Best-Selling Items',
            data: @json($topSellingItems->pluck('total_sold')),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
        }]
    };

    const leastSellingData = {
        labels: @json($leastSellingItems->pluck('name')),
        datasets: [{
            label: 'Least-Selling Items',
            data: @json($leastSellingItems->pluck('total_sold')),
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
        }]
    };

    const profitData = {
        labels: @json($profitAnalysis->pluck('name')),
        datasets: [{
            label: 'Profit ($)',
            data: @json($profitAnalysis->pluck('profit')),
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
        }]
    };

    const monthlySalesData = {
        labels: @json($monthlySalesTrend->pluck('month_name')),
        datasets: [{
            label: 'Monthly Sales',
            data: @json($monthlySalesTrend->pluck('total_sold')),
            backgroundColor: 'rgba(153, 102, 255, 0.5)',
        }]
    };

    // Render the charts
    const bestSellingChart = new Chart(document.getElementById('bestSellingChart'), {
        type: 'bar',
        data: bestSellingData,
    });

    const leastSellingChart = new Chart(document.getElementById('leastSellingChart'), {
        type: 'bar',
        data: leastSellingData,
    });

    const profitChart = new Chart(document.getElementById('profitChart'), {
        type: 'bar',
        data: profitData,
    });

    const monthlySalesChart = new Chart(document.getElementById('monthlySalesChart'), {
        type: 'line',
        data: monthlySalesData,
    });
</script>
@endsection
