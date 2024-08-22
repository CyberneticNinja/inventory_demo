<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemAdded;
use App\Models\ItemSold;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\Support;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

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

        // Fetch profit data using raw SQL
        $profitData = DB::select("
        SELECT 
            i.id AS item_id,
            i.name AS item_name,
            (COALESCE(SUM(isold.quantity), 0) - COALESCE(SUM(ia.quantity), 0)) * i.price AS profit
        FROM 
            items i
        LEFT JOIN 
            item_added ia ON i.id = ia.item_id AND YEAR(ia.date) = ?
        LEFT JOIN 
            item_sold isold ON i.id = isold.item_id AND YEAR(isold.date) = ?
        GROUP BY 
            i.id, i.name, i.price
        ORDER BY 
            profit DESC
    ", [$year, $year]);

        // Render the view and save it as HTML
        $template = view('pdf.download.sales', compact('year', 'salesData', 'topItemsByMonth','profitData'))->render();

        $pdfPath = storage_path('app/temp/Report' . $year . '.pdf');

        Pdf::html($template)->withBrowsershot(function (Browsershot $browsershot) {
            $browsershot->setIncludePath(env('BROWSER_PATH'));
            $browsershot->waitUntilNetworkIdle()->setDelay(1000);
         })->save($pdfPath);
        // })->save('/Users/abrokwahs/Sites/inventory_demo/public/Report'.$year.'.pdf');

        return response()->download($pdfPath)->deleteFileAfterSend(true);
    }
}