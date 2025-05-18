<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class InventoryReportController extends Controller
{
    public function index()
    {
        $report = Item::with([
            'stocks' => function ($query) {
                $query->select('item_id', 'unit_cost', \DB::raw('SUM(quantity) as qty_received'))
                      ->groupBy('item_id', 'unit_cost');
            },
            'issuances' => function ($query) {
                $query->select('item_id', \DB::raw('SUM(qty_issued) as qty_issued'))
                      ->groupBy('item_id');
            }
        ])
        ->get()
        ->map(function ($item) {
            $qty_received = $item->stocks->sum('qty_received');
            $qty_issued = $item->issuances->sum('qty_issued');
            $remaining_stock = $qty_received - $qty_issued;
            $unit_cost = $item->stocks->first()->unit_cost ?? 0;

            // Placeholder values
            $purchases = 0;
            $received_supply = 0;
            $amount = ($purchases + $received_supply) * $unit_cost;

            return [
                'item_name' => $item->item_name,
                'unit' => $item->item_description,
                'qty_received' => $qty_received,
                'amount_received' => $qty_received * $unit_cost,
                'purchases' => $purchases,
                'received_supply' => $received_supply,
                'amount' => $amount,
                'qty_issued' => $qty_issued,
                'unit_cost' => $unit_cost,
                'amount_issued' => $qty_issued * $unit_cost,
            ];
        });

        return view('inventory.report', compact('report'));
    }
    public function store(Request $request)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'office' => 'required|string',
        'qty_issued' => 'required|numeric|min:1',
    ]);

    $item = \App\Models\Item::findOrFail($request->item_id);

    // Get total available quantity
    $totalStock = \App\Models\Stock::where('item_id', $item->id)->sum('quantity');

    // Get total already issued
    $totalIssued = \App\Models\Issuance::where('item_id', $item->id)->sum('qty_issued');

    $availableQty = $totalStock - $totalIssued;

    // Check if enough stock is available
    if ($request->qty_issued > $availableQty) {
        return back()->withErrors(['qty_issued' => 'Not enough stock available.']);
    }

    // Create the issuance record
    \App\Models\Issuance::create([
        'item_id' => $item->id,
        'office' => $request->office,
        'qty_issued' => $request->qty_issued,
        'balance_qty' => $availableQty - $request->qty_issued,
    ]);

    return redirect()->back()->with('success', 'Item issued successfully!');
}

}
