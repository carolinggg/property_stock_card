<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;

class IssuanceController extends Controller
{
    public function index()
    {
        $issuances = Issuance::with('item')->get();
        return view('issuances.index', compact('issuances'));
    }

    public function create()
    {
        $items = Item::all();
        return view('issuances.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'office' => 'required|string',
            'qty_issued' => 'required|integer|min:1',
        ]);

        // Find the stock for the selected item
        $stock = Stock::where('item_id', $request->item_id)->first();

        if (!$stock) {
            return back()->withErrors('No stock available for this item.');
        }

        if ($stock->quantity < $request->qty_issued) {
            return back()->withErrors('Not enough stock available.');
        }

        // Subtract issued quantity
        $stock->quantity -= $request->qty_issued;
        $stock->save();

        // Create the issuance record
        Issuance::create([
            'item_id' => $request->item_id,
            'office' => $request->office,
            'qty_issued' => $request->qty_issued,
            'balance_qty' => $stock->quantity, 
        ]);

        return redirect()->route('issuances.index')->with('success', 'Issuance created successfully.');
    }

    public function edit(Issuance $issuance)
{
    $items = Item::all();
    return view('issuances.edit', compact('issuance', 'items'));
}

public function update(Request $request, Issuance $issuance)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'office' => 'required|string',
        'qty_issued' => 'required|integer|min:1',
    ]);

    // Find the current stock for the issuance's item
    $stock = Stock::where('item_id', $issuance->item_id)->first();

    if (!$stock) {
        return back()->withErrors('No stock available for the original item.');
    }

    // Calculate the difference in qty issued between old and new
    $qtyDifference = $request->qty_issued - $issuance->qty_issued;

    // If qtyDifference is positive, need to check if enough stock available
    if ($qtyDifference > 0 && $stock->quantity < $qtyDifference) {
        return back()->withErrors('Not enough stock available to increase issuance.');
    }

    // Adjust stock quantity accordingly
    // If qtyDifference is positive, subtract from stock
    // If qtyDifference is negative, add back to stock
    $stock->quantity -= $qtyDifference;
    $stock->save();

    // Update issuance details
    $issuance->update([
        'item_id' => $request->item_id,
        'office' => $request->office,
        'qty_issued' => $request->qty_issued,
        'balance_qty' => $stock->quantity,
    ]);

    return redirect()->route('issuances.index')->with('success', 'Issuance updated successfully.');
}


    public function destroy(Issuance $issuance)
    {
        $issuance->delete();
        return back()->with('success', 'Issuance deleted.');
    }
}
