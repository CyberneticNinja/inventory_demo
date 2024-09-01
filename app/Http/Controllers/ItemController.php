<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|unique:items',
            'name' => 'required',
            // 'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')
                        ->with('success','Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'barcode' => 'required|unique:items,barcode,' . $item->id,
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
    
        $item->update($request->except('quantity')); 
    
        return redirect()->route('items.index')
                         ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
    // Delete associated item_sold and item_added records
    $item->itemSold()->delete();
    $item->itemAdded()->delete();

    // Delete the item itself
    $item->delete();

    return redirect()->route('items.index')
                    ->with('success','Item deleted successfully.');
    }
}
