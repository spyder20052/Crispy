<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KitchenOrder;
use App\Models\Sale;
use Carbon\Carbon;

class KitchenController extends Controller
{
    public function index() {
        $pending = KitchenOrder::where('status', 'en attente')->with('sale')->get();
        $preparing = KitchenOrder::where('status', 'en préparation')->with('sale')->get();
        $ready = KitchenOrder::where('status', 'prêt')->with('sale')->get();
        // Statistiques
        $pendingCount = $pending->count();
        $preparingCount = $preparing->count();
        $readyCount = $ready->count();
        $completedToday = KitchenOrder::where('status', 'servi')->whereDate('updated_at', Carbon::today())->count();
        $avgPrepTime = 8; // À calculer selon la logique métier
        return view('kitchen', [
            'pending' => $pending,
            'preparing' => $preparing,
            'ready' => $ready,
            'pendingCount' => $pendingCount,
            'preparingCount' => $preparingCount,
            'readyCount' => $readyCount,
            'completedToday' => $completedToday,
            'avgPrepTime' => $avgPrepTime,
        ]);
    }

    public function create() {
        return view('kitchen.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        KitchenOrder::create($validated);
        return redirect('/kitchen')->with('success', 'Commande cuisine ajoutée avec succès.');
    }

    public function edit($id) {
        $kitchen = KitchenOrder::findOrFail($id);
        return view('kitchen.edit', compact('kitchen'));
    }

    public function update(Request $request, $id) {
        $kitchen = KitchenOrder::findOrFail($id);
        $validated = $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        $kitchen->update($validated);
        return redirect('/kitchen')->with('success', 'Commande cuisine modifiée avec succès.');
    }

    public function destroy($id) {
        $kitchen = KitchenOrder::findOrFail($id);
        $kitchen->delete();
        return redirect('/kitchen')->with('success', 'Commande cuisine supprimée avec succès.');
    }
}
