<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthlyReportController extends Controller
{
    public function index(Request $request)
{
    // Get the month filter from request (format: YYYY-MM)
    $month = $request->input('month');

    // Start the query builder
    $query = DB::table('stocks')
        ->join('items', 'stocks.item_id', '=', 'items.id')
        ->leftJoin('issuances', 'stocks.item_id', '=', 'issuances.item_id')
        ->select(
            'stocks.ris_number',
            'issuances.office',
            'items.item_name',
            'items.unit_cost as item_unit_cost',
            'stocks.quantity',
            'stocks.unit_cost as stock_unit_cost',
            'stocks.total_cost as stock_total_cost',
            'stocks.created_at'  // Add this if needed for filtering
        );

    // Apply month filter if provided
    if ($month) {
        // Filter by year and month (assumes 'created_at' datetime column)
        $query->whereYear('stocks.created_at', '=', substr($month, 0, 4))
              ->whereMonth('stocks.created_at', '=', substr($month, 5, 2));
    }

    // Get the results
    $report = $query->get();

    // Pass the month variable to the view to keep the filter selected
    return view('monthly_report.index', compact('report', 'month'));
}

    public function download()
    {
      
    $report = DB::table('stocks')
        ->join('items', 'stocks.item_id', '=', 'items.id')
        ->leftJoin('issuances', 'stocks.item_id', '=', 'issuances.item_id')
        ->select(
            'stocks.ris_number',
            'issuances.office',
            'items.item_name',
            'items.item_description as description',
            'stocks.quantity',
            'stocks.unit_cost as stock_unit_cost',
            'stocks.total_cost as stock_total_cost'
        )
        ->get();

    $filename = 'monthly_report.csv';

    $handle = fopen('php://temp', 'w+');

    // Add UTF-8 BOM for Excel compatibility
    fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

    // ===== CUSTOM HEADER ROWS =====
    fputcsv($handle, ['MONTHLY REPORT OF SUPPLIES AND MATERIALS ISSUED']);
    fputcsv($handle, ['Pangasinan State University - Urdaneta City']);
    fputcsv($handle, ['Urdaneta City, Pangasinan']);
    fputcsv($handle, ['Generated on: ' . now()->format('F d, Y')]);
    fputcsv($handle, []); // Blank line for spacing

    // ===== COLUMN HEADERS =====
    fputcsv($handle, [
        'RIS no.', 
        'Department Office Visited', 
        'Item', 
        'Unit', 
        'Quantity Issued', 
        'Unit Cost', 
        'Amount'
    ]);

    // ===== DATA ROWS =====
    $totalAmount = 0;

    foreach ($report as $row) {
        $totalAmount += $row->stock_total_cost;

        fputcsv($handle, [
            $row->ris_number,
            $row->office ?? 'N/A',
            $row->item_name,
            $row->description,
            $row->quantity,
            '₱' . number_format($row->stock_unit_cost, 2),
            '₱' . number_format($row->stock_total_cost, 2),
        ]);
    }

    // ===== FOOTER ROW =====
    fputcsv($handle, []); // Blank line for spacing
    fputcsv($handle, ['', '', '', '', '', 'Total Amount:', '₱' . number_format($totalAmount, 2)]);

    rewind($handle);
    $csvContent = stream_get_contents($handle);
    fclose($handle);

    return response($csvContent)
        ->header('Content-Type', 'text/csv; charset=UTF-8')
        ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
        ->header('Pragma', 'no-cache')
        ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
        ->header('Expires', '0');
}

    }
