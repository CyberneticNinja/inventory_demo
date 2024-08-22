@extends('templates.homepage')

@section('title', 'Reports')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Generate Report</h1>

    <form method="POST" action="{{ route('reports.download') }}">
        @csrf
        <div class="flex gap-4 items-center mb-4">
            {{-- <div>
                <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                <select name="month" id="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ date("F", mktime(0, 0, 0, $m, 1)) }}</option>
                    @endforeach
                </select>
            </div> --}}

            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach(range($startYear, $endYear) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-bold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Download Report
        </button>
    </form>
</div>
@endsection
