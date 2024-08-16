<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemSold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Show the analytics dashboard.
     */
    public function index(Request $request)
    {
        // Default to today's month and year if no input is provided
        $month = $request->input('month', now()->format('m'));
        $year = $request->input('year', now()->format('Y'));

        // Get current date for boundary condition
        $currentDate = now();

        // Get analytics data for the selected month and year, ending at today's date
        $mostProfitableItem = $this->getMostProfitableItem($month, $year, $currentDate);
        $mostItemsSold = $this->getMostItemsSold($month, $year, $currentDate);

        // Return view with insights and month/year filters
        return view('analytics.index', compact('mostProfitableItem', 'mostItemsSold', 'month', 'year'));
    }

    /**
     * Get the most profitable item for a given month and year, up to today's date.
     */
    private function getMostProfitableItem($month, $year, $currentDate)
    {
        return Item::select('items.*', DB::raw('SUM(item_sold.quantity * items.price) as profit'))
            ->join('item_sold', 'items.id', '=', 'item_sold.item_id')
            ->whereMonth('item_sold.date', $month)
            ->whereYear('item_sold.date', $year)
            ->where('item_sold.date', '<=', $currentDate)  // Ensure the date is not in the future
            ->groupBy('items.id')
            ->orderBy('profit', 'desc')
            ->first();
    }

    /**
     * Get the item that sold the most for a given month and year, up to today's date.
     */
    private function getMostItemsSold($month, $year, $currentDate)
    {
        return Item::select('items.*', DB::raw('SUM(item_sold.quantity) as total_sold'))
            ->join('item_sold', 'items.id', '=', 'item_sold.item_id')
            ->whereMonth('item_sold.date', $month)
            ->whereYear('item_sold.date', $year)
            ->where('item_sold.date', '<=', $currentDate)  // Ensure the date is not in the future
            ->groupBy('items.id')
            ->orderBy('total_sold', 'desc')
            ->first();
    }
}
