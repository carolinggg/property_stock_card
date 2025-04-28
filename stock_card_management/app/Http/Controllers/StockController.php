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
        'item_id' => 'required|exists:items,id',
        'quantity' => 'required|integer',
        'unit_cost' => 'required|numeric',
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
        'quantity' => 'required|integer|min:1',
        'unit_cost' => 'required|numeric|min:0',
    ]);

    // Retrieve the stock entry
    $stock = Stock::findOrFail($id);

    // Add the new quantity to the existing stock
    $stock->quantity += $validated['quantity'];

    // Update the unit cost
    $stock->unit_cost = $validated['unit_cost'];

    // Save the updated stock record (total_cost will be auto-calculated)
    $stock->save();

    // Redirect back to the stock index page with a success message
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
