<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index() {
        $inventories = Inventory::all();
        $alertes = Inventory::whereColumn('quantity', '<', 'threshold')->get();
        return view('inventory', [
            'inventories' => $inventories,
            'alertes' => $alertes,
        ]);
    }

    public function create() {
        return view('inventory.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'threshold' => 'required|integer|min:0',
            'unit' => 'required|string',
            'category' => 'required|in:Frais,Sec,Boisson,Emballage,Autre',
        ]);
        Inventory::create($validated);
        return redirect('/inventory')->with('success', 'Produit inventaire ajouté avec succès.');
    }

    public function edit($id) {
        $inventory = Inventory::findOrFail($id);
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, $id) {
        $inventory = Inventory::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'threshold' => 'required|integer|min:0',
            'unit' => 'required|string',
            'category' => 'required|in:Frais,Sec,Boisson,Emballage,Autre',
        ]);
        $inventory->update($validated);
        return redirect('/inventory')->with('success', 'Produit inventaire modifié avec succès.');
    }

    public function destroy($id) {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect('/inventory')->with('success', 'Produit inventaire supprimé avec succès.');
    }
}
