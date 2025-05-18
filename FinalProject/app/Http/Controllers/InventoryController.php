<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Issuance;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month'); // Format: YYYY-MM
        $export = $request->input('export');

        $stocksQuery = Stock::with('item')
            ->selectRaw('item_id, unit, 
                SUM(quantity) as total_quantity, 
                SUM(CASE WHEN supply_from = "purchased" THEN quantity ELSE 0 END) as purchased_quantity,
                SUM(CASE WHEN supply_from = "received" THEN quantity ELSE 0 END) as received_quantity,
                MAX(unit_cost) as unit_cost')
            ->groupBy('item_id', 'unit');

        if ($month) {
            $startDate = $month . '-01';
            $endDate = date('Y-m-t', strtotime($startDate));
            $stocksQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $stocks = $stocksQuery->get();

        // Group by category and supply type
        $stocksByCategory = $stocks->groupBy(function ($stock) {
            return $stock->item->category;
        });

        foreach ($stocksByCategory as $category => $stocksInCategory) {
            $stocksByCategory[$category] = $stocksInCategory->groupBy(function ($stock) {
                return $stock->item->supply_type;
            });
        }

        // Issuance counts
        $issuanceQuery = Issuance::selectRaw('item_id, COUNT(*) as issued_count')
            ->groupBy('item_id');

        if ($month) {
            $issuanceQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $issueCounts = $issuanceQuery->pluck('issued_count', 'item_id');

        // Totals
        $grandTotalAmount = 0;
        $grandTotalPurchasedAmount = 0;

        foreach ($stocks as $stock) {
            $stock->issued_count = $issueCounts[$stock->item_id] ?? 0;
            $stock->purchased_amount = $stock->purchased_quantity * $stock->unit_cost;
            $stock->received_amount = $stock->received_quantity * $stock->unit_cost;

            if (is_null($stock->supply_from)) {
                $stock->total_amount = $stock->total_quantity * $stock->unit_cost;
            } else {
                $stock->total_amount = $stock->purchased_amount + $stock->received_amount;
            }

            $grandTotalPurchasedAmount += $stock->purchased_amount;
            $grandTotalAmount += $stock->total_amount;
        }

        // Export to Excel if requested
        if ($export) {
            return Excel::download(new StockExport(
                $stocksByCategory,
                $grandTotalAmount,
                $grandTotalPurchasedAmount,
                $month
            ), 'inventory.xlsx');
        }

        return view('inventory.index', compact(
            'stocksByCategory',
            'grandTotalAmount',
            'grandTotalPurchasedAmount',
            'month'
        ));
    }
}
