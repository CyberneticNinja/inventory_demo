<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemSold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


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
    
        // Fetch analytics data
        $topSellingItems = $this->getTopSellingItems($month, $year, $currentDate);
        $leastSellingItems = $this->getLeastSellingItems($month, $year, $currentDate);
        $profitAnalysis = $this->getProfitAnalysis($month, $year, $currentDate);
        $monthlySalesTrend = $this->getMonthlySalesTrend($year);
    
        // Convert month numbers to month names
        $monthlySalesTrend->transform(function ($item) {
            $item->month_name = date("F", mktime(0, 0, 0, $item->month, 1));
            return $item;
        });
    
        // Pass the data to the view
        return view('analytics.index', compact('topSellingItems', 'leastSellingItems', 'profitAnalysis', 'monthlySalesTrend', 'month', 'year'));
    }

    private function getTopSellingItems($month, $year)
    {
        return Item::select('items.name', DB::raw('SUM(item_sold.quantity) as total_sold'))
            ->join('item_sold', 'items.id', '=', 'item_sold.item_id')
            ->whereMonth('item_sold.date', $month)
            ->whereYear('item_sold.date', $year)
            ->groupBy('items.name')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();
    }

    private function getLeastSellingItems($month, $year)
    {
        return Item::select('items.name', DB::raw('SUM(item_sold.quantity) as total_sold'))
            ->join('item_sold', 'items.id', '=', 'item_sold.item_id')
            ->whereMonth('item_sold.date', $month)
            ->whereYear('item_sold.date', $year)
            ->groupBy('items.name')
            ->orderBy('total_sold', 'asc')
            ->limit(5)
            ->get();
    }

    private function getProfitAnalysis($month, $year)
    {
        return Item::select('items.name', DB::raw('SUM(item_sold.quantity * items.price) as profit'))
            ->join('item_sold', 'items.id', '=', 'item_sold.item_id')
            ->whereMonth('item_sold.date', $month)
            ->whereYear('item_sold.date', $year)
            ->groupBy('items.name')
            ->orderBy('profit', 'desc')
            ->get();
    }

    private function getMonthlySalesTrend($year)
    {
        return DB::table('item_sold')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(quantity) as total_sold'))
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy('month')
            ->get();
    }
}
