<?php

// app/Http/Controllers/ItemController.php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Issuance;
use App\Models\Stock;

class ItemController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $items = Item::all();  // Fetch all items from the database
        return view('items.index', compact('items'));  // Pass items to the view
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('items.create');  // Return create view
    }

    public function store(Request $request)
    {
        // Validate the request input (no 'unit_cost' anymore)
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string|max:255',
            'supply_type' => 'required|in:Office Supply,Medical Supply,Janitorial Supply',
        ]);
        
    
        // Create the item in the database
        Item::create($validated);
    
        // Redirect back to the items list
        return redirect()->route('items.index');
    }
    

    // Display the specified resource.
    public function show($id)
    {
        // Find the item by ID or return 404 if not found
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));  // Return show view with the item
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        // Find the item by ID or return 404 if not found
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));  // Return edit view with the item
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
    // Validate the request input (no 'unit_cost' anymore)
    $validated = $request->validate([
        'item_name' => 'required|string|max:255',
        'item_description' => 'nullable|string|max:255',
        'supply_type' => 'required|in:Office Supply,Medical Supply,Janitorial Supply',
    ]);

    // Find the item by ID or return 404 if not found
    $item = Item::findOrFail($id);
    $item->update($validated);  // Update the item in the database

    // Redirect back to the items list
    return redirect()->route('items.index');
    }
    // Remove the specified resource from storage.
    public function destroy($id)
    {
        // Find the item by ID or return 404 if not found
        $item = Item::findOrFail($id);
        $item->delete();  // Delete the item

        // Redirect back to the items list
        return redirect()->route('items.index');
    }
    public function stockcard(Item $item)
    {
        // Retrieve all stocks and issuances associated with the item
        $stocks = Stock::where('item_id', $item->id)->get();
        $issuances = Issuance::where('item_id', $item->id)->get();
        
        // Pass the item, stocks, and issuances to the view
        return view('items.stockcard', compact('item', 'stocks', 'issuances'));
    }
    
}
