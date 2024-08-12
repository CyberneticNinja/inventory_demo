<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemSold;
use App\Models\Item;

class ItemSoldController extends Controller
{
    public function index()
    {
        $itemSold = ItemSold::paginate(10);
        return view('item_sold.index', compact('itemSold'));
    }

    public function create()
    {
        $items = Item::all(); // Fetch items for dropdown
        return view('item_sold.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);
    
        $item = Item::findOrFail($request->item_id);

        $currentQuantity = $item->quantity;    

        if ($currentQuantity - $request->quantity < 1) {
            return redirect()->back()->withErrors(['quantity' => 'The remaining item quantity cannot be less than 1.']);
        }
    
        ItemSold::create($request->all());
    
        return redirect()->route('item_sold.index')
                        ->with('success', 'Item Sold recorded successfully.');
    }

    public function show(ItemSold $itemSold)
    {
        return view('item_sold.show', compact('itemSold'));
    }

    public function edit(ItemSold $itemSold)
    {
        $items = Item::all(); // Fetch items for dropdown
        return view('item_sold.edit', compact('itemSold', 'items'));
    }

    public function update(Request $request, ItemSold $itemSold)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        $itemSold->update($request->all());

        return redirect()->route('item_sold.index')
                        ->with('success', 'Item Sold updated successfully.');
    }

    public function destroy(ItemSold $itemSold)
    {
        $itemSold->delete();

        return redirect()->route('item_sold.index')
                        ->with('success', 'Item Sold deleted successfully.');
    }
}
