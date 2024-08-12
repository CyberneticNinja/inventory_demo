<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemAdded;
use App\Models\Item;

class ItemAddedController extends Controller
{
    public function index()
    {
        $itemAdded = ItemAdded::paginate(10);
        return view('item_added.index', compact('itemAdded'));
    }

    public function create()
    {
        $items = Item::all(); // Fetch items for dropdown
        return view('item_added.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        ItemAdded::create($request->all());

        $item = Item::where('id', $request->item_id)->first();
        $item->quantity = $item->getQuantityAttribute();
        $item->save();

        return redirect()->route('item_added.index')
                         ->with('success', 'Item Added recorded successfully.');
    }

    public function show(ItemAdded $itemAdded)
    {
        return view('item_added.show', compact('itemAdded'));
    }

    public function edit(ItemAdded $itemAdded)
    {
        $items = Item::all(); // Fetch items for dropdown
        return view('item_added.edit', compact('itemAdded', 'items'));
    }

    public function update(Request $request, ItemAdded $itemAdded)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        $itemAdded->update($request->all());

        return redirect()->route('item_added.index')
                         ->with('success', 'Item Added updated successfully.');
    }

    public function destroy(ItemAdded $itemAdded)
    {
        $itemAdded->delete();

        return redirect()->route('item_added.index')
                         ->with('success', 'Item Added deleted successfully.');
    }
}
