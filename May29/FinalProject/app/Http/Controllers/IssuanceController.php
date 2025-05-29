<?php

namespace App\Http\Controllers;
use App\Exports\IssuanceSummaryExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Issuance;
use App\Models\Item;
use App\Models\Stock;
use App\Models\Office;
use Illuminate\Http\Request;

class IssuanceController extends Controller
{
    public function index()
    {
        $issuances = Issuance::with('item')
            ->get()
            ->sortBy(fn($issuance) => $issuance->item->item_name)
            ->values(); // reset keys for clean output

        return view('issuances.index', compact('issuances'));
    }

    public function create()
    {
        $items = Item::all();
        $offices = Office::orderBy('office_name')->get();
        return view('issuances.create', compact('items','offices'));
    }
    public function edit(Issuance $issuance)
{
    $items = Item::all(); // So the dropdown has all items
    return view('issuances.edit', compact('issuance', 'items'));
}

public function update(Request $request, Issuance $issuance)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'office' => 'required|exists:offices,office_name',
        'qty_issued' => 'required|integer|min:1',
    ]);

    $oldQty = $issuance->qty_issued;

    // Get the stock for the item
    $stock = Stock::where('item_id', $issuance->item_id)->first();

    if (!$stock) {
        return back()->withErrors('No stock available for this item.');
    }

    // Adjust stock based on qty difference
    $diff = $request->qty_issued - $oldQty;
    if ($stock->quantity < $diff) {
        return back()->withErrors('Not enough stock available for update.');
    }

    $stock->quantity -= $diff;
    $stock->save();

    // Update issuance
    $issuance->update([
        'item_id' => $request->item_id,
        'office' => $request->office,
        'qty_issued' => $request->qty_issued,
    ]);

    return redirect()->route('issuances.index')->with('success', 'Issuance updated successfully.');
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
            ]);

        return redirect()->route('issuances.index')->with('success', 'Issuance created successfully.');
    }

    public function destroy(Issuance $issuance)
    {
        $issuance->delete();
        return back()->with('success', 'Issuance deleted.');
    }

        public function summary()
{
    $summary = Issuance::with(['item', 'item.stocks'])
        ->get()
        ->map(function ($issuance) {
            $latestStock = $issuance->item->stocks->sortByDesc('created_at')->first();

            return [
                'item_name' => $issuance->item->item_name,
                'ris_number' => optional($latestStock)->ris_number ?? 'N/A',
                'unit' => optional($latestStock)->unit ?? 'N/A',
                'qty_issued' => $issuance->qty_issued,
                'unit_cost' => optional($latestStock)->unit_cost ?? 0,
                'office' => $issuance->office,
                'total_cost' => $issuance->qty_issued * (optional($latestStock)->unit_cost ?? 0),
                'created_at' => $issuance->created_at->format('Y-m-d H:i:s'),
            ];
        })
        ->sortBy('item_name') // alphabetical
        ->values();

    return view('issuances.summary', compact('summary'));
}
        
public function downloadSummaryExcel()
{
    $summary = Issuance::with(['item', 'item.stocks'])
        ->get()
        ->map(function ($issuance) {
            $latestStock = $issuance->item->stocks->sortByDesc('created_at')->first();

            return [
                'item_name' => $issuance->item->item_name,
                'ris_number' => optional($latestStock)->ris_number ?? 'N/A',
                'unit' => optional($latestStock)->unit ?? 'N/A',
                'qty_issued' => $issuance->qty_issued,
                'unit_cost' => optional($latestStock)->unit_cost ?? 0,
                'office' => $issuance->office,
                'total_cost' => $issuance->qty_issued * (optional($latestStock)->unit_cost ?? 0),
                'created_at' => $issuance->created_at->format('Y-m-d H:i:s'),
            ];
        });

    return Excel::download(new IssuanceSummaryExport($summary), 'issuance_summary.xlsx');
}
}
