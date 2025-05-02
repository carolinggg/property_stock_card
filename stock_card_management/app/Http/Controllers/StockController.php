<?php
namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Item;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $stocks = Stock::with('item')->get();  // Get all stocks with item details
        return view('stocks.index', compact('stocks'));
    }

    // Show the form for creating a new resource.
   // Show the form for creating a new resource.
public function create()
{
    $items = Item::all();  // Get all items for the select dropdown
    return view('stocks.create', compact('items'));  // Render the 'add' view for adding new stock
}

public function store(Request $request)
{
   // Validate the input
$validated = $request->validate([
    'ris_number' => 'nullable|string|max:255',
    'item_id' => 'required|exists:items,id',
    'quantity' => 'required|numeric',
    'unit_cost' => 'required|numeric',
    'reference' => 'nullable|string',
    'receipt_qty' => 'nullable|numeric',
    'no_of_days_consume' => 'nullable|numeric',
    'unit' => 'nullable|string',
'supply_from' => 'nullable|in:purchased,received',
]);

    // Calculate total_cost before storing
    $validated['total_cost'] = $validated['quantity'] * $validated['unit_cost'];

    // Create the stock record with the calculated total_cost
    Stock::create($validated);

    // Redirect back to the stock index with a success message
    return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
}


    // Display the specified resource.
    public function show($id)
    {
        $stock = Stock::with('item')->findOrFail($id);
        return view('stocks.show', compact('stock'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        // Retrieve the stock entry by its ID
        $stock = Stock::findOrFail($id);
    
        // Retrieve all available items
        $items = Item::all();
    
        // Pass the stock data and items to the edit view
        return view('stocks.edit', compact('stock', 'items'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|numeric',
            'unit_cost' => 'required|numeric',
            'reference' => 'nullable|string',
            'receipt_qty' => 'nullable|numeric',
            'no_of_days_consume' => 'nullable|numeric',
            'unit' => 'nullable|string',
            'supply_from' => 'nullable|in:purchased,received',
        ]);
    
        // Retrieve the stock entry
        $stock = Stock::findOrFail($id);
    
        // Add new quantity to existing stock
        $stock->quantity += $validated['quantity'];
    
        // Update other fields
        $stock->unit_cost = $validated['unit_cost'];
        $stock->reference = $validated['reference'];
        $stock->receipt_qty = $validated['receipt_qty'];
        $stock->no_of_days_consume = $validated['no_of_days_consume'];
        $stock->unit = $validated['unit'];
        $stock->supply_from = $validated['supply_from'];
    
        // Save the changes
        $stock->save();
    
        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }
    
    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index');
    }

    public function add($id, $request){
        $stock = Stock::findOrFail($id);
        
    }
}
