<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemAdded;
use App\Models\ItemSold;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function showSearchForm()
    {
        return view('search.form');
    }

    public function searchResults(Request $request)
{
    $query = $request->input('query');
    $type = $request->input('type');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $page = $request->input('page', 1); // Default to page 1 if not provided

    $results = collect(); // Initialize as an empty collection

    if ($type == 'items') {
        $results = Item::where('name', 'like', "%{$query}%")->paginate(25);
    } elseif ($type == 'items_sold') {
        $results = ItemSold::whereHas('item', function($q) use ($query) {
                            $q->where('name', 'like', "%{$query}%");
                        })
                        ->when($startDate, function ($query, $startDate) {
                            return $query->whereDate('date', '>=', $startDate);
                        })
                        ->when($endDate, function ($query, $endDate) {
                            return $query->whereDate('date', '<=', $endDate);
                        })
                        ->paginate(25);
    } elseif ($type == 'items_added') {
        $results = ItemAdded::whereHas('item', function($q) use ($query) {
                            $q->where('name', 'like', "%{$query}%");
                        })
                        ->when($startDate, function ($query, $startDate) {
                            return $query->whereDate('date', '>=', $startDate);
                        })
                        ->when($endDate, function ($query, $endDate) {
                            return $query->whereDate('date', '<=', $endDate);
                        })
                        ->paginate(25);
    }

    // Append query parameters to pagination links
    $results->appends($request->except('page'));

    return view('search.results', [
        'results' => $results,
        'searchType' => $type,
    ]);
}


    // public function searchResults(Request $request)
    // {
    //     $query = $request->input('query');
    //     $type = $request->input('type');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     $searchType = $type;
    //     $results = [];

    //     switch ($type) {
    //         case 'items':
    //             $results = Item::where('name', 'like', "%$query%")
    //                 ->when($startDate, fn($query) => $query->whereDate('created_at', '>=', $startDate))
    //                 ->when($endDate, fn($query) => $query->whereDate('created_at', '<=', $endDate))
    //                 ->get();
    //             break;
    //         case 'items_added':
    //             $results = ItemAdded::with('item')
    //                 ->whereHas('item', fn($q) => $q->where('name', 'like', "%$query%"))
    //                 ->when($startDate, fn($query) => $query->whereDate('date', '>=', $startDate))
    //                 ->when($endDate, fn($query) => $query->whereDate('date', '<=', $endDate))
    //                 ->get();
    //             break;
    //         case 'items_sold':
    //             $results = ItemSold::with('item')
    //                 ->whereHas('item', fn($q) => $q->where('name', 'like', "%$query%"))
    //                 ->when($startDate, fn($query) => $query->whereDate('date', '>=', $startDate))
    //                 ->when($endDate, fn($query) => $query->whereDate('date', '<=', $endDate))
    //                 ->get();
    //             break;
    //     }
    //     return view('search.results', compact('results','searchType'));
    // }
}
