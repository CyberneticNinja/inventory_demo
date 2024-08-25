<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Data Report - {{ $year }}</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100vw;
        }
        .page {
            height: 100vh; /* Each page occupies the full viewport height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            page-break-after: always;
        }
        .page h1 {
            margin-bottom: 20px;
        }
        .page canvas {
            max-width: 90%;
            max-height: 80%;
        }
        .top-items, .profit-data {
            margin-top: 20px;
            text-align: left;
            width: 80%;
        }
        .top-items h2, .profit-data h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .top-items ul, .profit-data ul {
            list-style-type: decimal;
            padding-left: 20px;
        }
        .top-items li, .profit-data li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <!-- Page 1: Header and Introduction -->
    <div class="page">
        <h1>Sales Data Report for {{ $year }}</h1>
        <p>This report provides an overview of the sales data for the year {{ $year }}.</p>
    </div>

    <!-- Page 2: Sales Chart -->
    <div class="page">
        <h1>Monthly Sales Trend</h1>
        <canvas id="salesChart"></canvas>
    </div>

    <!-- Page 3: Top Selling Items by Month (First 6 Months) -->
    <div class="page">
        <div class="top-items">
            <h2>Top Selling Items by Month (Jan - Jun)</h2>
            <ul>
                @foreach($topItemsByMonth->sortKeys()->take(6) as $month => $items)
                    <li><strong>{{ \Carbon\Carbon::createFromDate(null, $month, 1)->format('F') }}:</strong>
                        <ul>
                            @foreach($items as $item)
                                <li>{{ $item->item->name }} - {{ $item->total_sold }} units sold</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Page 4: Top Selling Items by Month (Last 6 Months) -->
    <div class="page">
        <div class="top-items">
            <h2>Top Selling Items by Month (Jul - Dec)</h2>
            <ul>
                @foreach($topItemsByMonth->sortKeys()->skip(6) as $month => $items)
                    <li><strong>{{ \Carbon\Carbon::createFromDate(null, $month, 1)->format('F') }}:</strong>
                        <ul>
                            @foreach($items as $item)
                                <li>{{ $item->item->name }} - {{ $item->total_sold }} units sold</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <!-- Page 5: Profit Data -->
    <div class="page">
        <div class="profit-data">
            <h2>Profit Data for {{ $year }}</h2>
            <ul>
                @foreach($profitData as $profit)
                    <li>{{ $profit->item_name }} - Profit: ${{ number_format($profit->profit, 2) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Page 6: Percentage of Items Sold vs Added -->
    <div class="page">
        <h1>Percentage of Items Sold vs Added</h1>
        <canvas id="percentageChart"></canvas>
    </div>

    <script>
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: @json($salesData->pluck('month')->map(function($month) {
                    return \Carbon\Carbon::createFromDate(null, $month, 1)->format('F');
                })),
                datasets: [{
                    label: 'Total Sales',
                    data: @json($salesData->pluck('total_sales')),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const percentageCtx = document.getElementById('percentageChart').getContext('2d');
        const percentageChart = new Chart(percentageCtx, {
            type: 'bar',
            data: {
                labels: @json($percentageData->pluck('item_name')),
                datasets: [
                    {
                        label: 'Percentage of Items Sold',
                        data: @json($percentageData->pluck('percentage_sold')),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Items Added',
                        data: @json($percentageData->pluck('total_added')),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>
</body>
</html>
