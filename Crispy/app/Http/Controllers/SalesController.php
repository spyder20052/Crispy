<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Menu;
use App\Models\Employee;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index() {
        $today = Carbon::today();
        // Liste des ventes du jour
        $sales = Sale::with(['menu'])->whereDate('sale_date', $today)->orderByDesc('sale_date')->get();
        // Statistiques
        $salesToday = $sales->sum('total_price');
        $ordersToday = $sales->count();
        $panierMoyen = $ordersToday ? $salesToday / $ordersToday : 0;
        $conversion = 0; // À calculer selon la logique métier
        // Ventes horaires
        $ventesHoraires = Sale::whereDate('sale_date', $today)
            ->selectRaw('HOUR(sale_date) as heure, SUM(total_price) as total')
            ->groupBy('heure')
            ->orderBy('heure')
            ->pluck('total', 'heure');
        // Produits les plus vendus
        $produitsPopulaires = Sale::whereDate('sale_date', $today)
            ->join('menus', 'sales.menu_id', '=', 'menus.id')
            ->selectRaw('menus.name, SUM(sales.quantity) as total')
            ->groupBy('menus.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'menus.name');
        $menus = Menu::all();
        $employees = Employee::all();
        return view('sales', [
            'sales' => $sales,
            'salesToday' => $salesToday,
            'ordersToday' => $ordersToday,
            'panierMoyen' => $panierMoyen,
            'conversion' => $conversion,
            'ventesHoraires' => $ventesHoraires,
            'produitsPopulaires' => $produitsPopulaires,
            'menus' => $menus,
            'employees' => $employees,
        ]);
    }

    public function create() {
        $menus = Menu::all();
        $employees = Employee::all();
        return view('sales.create', compact('menus', 'employees'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'sale_date' => 'required|date',
            'employee_id' => 'nullable|exists:employees,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);
        Sale::create($validated);
        return redirect('/sales')->with('success', 'Vente ajoutée avec succès.');
    }

    public function edit($id) {
        $sale = Sale::findOrFail($id);
        $menus = Menu::all();
        $employees = Employee::all();
        return view('sales.edit', compact('sale', 'menus', 'employees'));
    }

    public function update(Request $request, $id) {
        $sale = Sale::findOrFail($id);
        $validated = $request->validate([
            'sale_date' => 'required|date',
            'employee_id' => 'nullable|exists:employees,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);
        $sale->update($validated);
        return redirect('/sales')->with('success', 'Vente modifiée avec succès.');
    }

    public function destroy($id) {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return redirect('/sales')->with('success', 'Vente supprimée avec succès.');
    }
}
