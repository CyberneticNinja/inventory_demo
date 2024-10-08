<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemAdded;
use App\Models\ItemSold;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Get the earliest date from item_added table
        $firstDate = ItemAdded::orderBy('date', 'asc')->first()->date;

        // Determine the start and end years
        $startYear = date('Y', strtotime($firstDate));
        $endYear = now()->year;

        return view('reports.index', compact('startYear', 'endYear'));
    }
    public function download(Request $request)
    {
        $year = $request->year;
        // Get total sales per month for the selected year
        $salesData = ItemSold::selectRaw('MONTH(date) as month, SUM(quantity) as total_sales')
        ->whereYear('date', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $topItemsByMonth = ItemSold::select(DB::raw('item_id, MONTH(date) as month, SUM(quantity) as total_sold'))
        ->with('item')
        ->groupBy('item_id', 'month')
        ->orderBy('total_sold', 'desc')
        ->get()
        ->groupBy('month')
        ->map(function($items) {
            return $items->take(3); // Adjust this number based on how many top items you want to show per month
        });

        // Profit Data: Calculate profit for each item
        $profitData = DB::table('items')
            ->leftJoin('item_added', 'items.id', '=', 'item_added.item_id')
            ->leftJoin('item_sold', 'items.id', '=', 'item_sold.item_id')
            ->select('items.name as item_name', DB::raw('
                (SUM(item_added.quantity * items.price) - SUM(item_sold.quantity * items.selling_price)) as profit
            '))
            ->whereYear('item_added.date', $year)
        ->groupBy('items.id', 'items.name')  // Group by both item id and name
        ->havingRaw('profit > 0')
        ->orderByDesc('profit')
        ->get();    

        // Percentage of Items Sold vs Items Added
        $percentageData = DB::table('items')
        ->leftJoin('item_added', 'items.id', '=', 'item_added.item_id')
        ->leftJoin('item_sold', 'items.id', '=', 'item_sold.item_id')
        ->select('items.name as item_name', DB::raw('
            CASE WHEN SUM(item_added.quantity) > 0 THEN
                (SUM(item_sold.quantity) / SUM(item_added.quantity)) * 100
            ELSE 0 END as percentage_sold,
            SUM(item_added.quantity) as total_added
        '))
        ->whereYear('item_added.date', $year)
        ->groupBy('items.id', 'items.name')  // Add items.name to the GROUP BY clause
        ->orderByDesc('percentage_sold')
        ->get();    

        // Render the view and save it as HTML
        $template = view('pdf.download.sales', compact('year', 'salesData', 'topItemsByMonth','profitData','percentageData'))->render();

        $pdfPath = storage_path('app/public/report' . $year . '.pdf');
        Browsershot::html($template)
        ->setChromePath(env('CHROME_PATH'))
        ->waitUntilNetworkIdle()
        ->setNodeBinary(env('NODE_BINARY'))
        ->setNpmBinary(env('NPM_BINARY'))        
        ->setDelay(10000) 
        ->save($pdfPath);

        return response()->download($pdfPath)->deleteFileAfterSend(true);
    }
}
