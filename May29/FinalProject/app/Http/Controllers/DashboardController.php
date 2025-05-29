<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get all items ordered alphabetically by item_name
        $items = Item::orderBy('item_name')->get();

        // Get selected item id from request or default to the first item's id if exists
        $selectedItemId = $request->input('item_id');

        if (!$selectedItemId && $items->count() > 0) {
            $selectedItemId = $items->first()->id;
        }

        $stockData = [];

        if ($selectedItemId) {
            $item = Item::find($selectedItemId);
            if ($item) {
                $stocks = $item->stocks()->orderBy('created_at')->get();

                $stockData = $stocks->map(function ($stock) {
                    return [
                        'date' => $stock->created_at->format('Y-m-d'),
                        'quantity' => $stock->quantity,
                    ];
                });
            }
        }

        return view('dashboard', compact('items', 'selectedItemId', 'stockData'));
    }
}
