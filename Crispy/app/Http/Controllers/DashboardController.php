<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Menu;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Reservation;
use App\Models\KitchenOrder;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $today = Carbon::today();
        $now = Carbon::now();

        // Chiffre d'affaires du jour
        $salesToday = Sale::whereDate('sale_date', $today)->sum('total_price');
        // Nombre de commandes du jour
        $ordersToday = Sale::whereDate('sale_date', $today)->count();
        // Nombre de clients actifs (distincts par email ou nom, à adapter selon la structure)
        $clientsActifs = Sale::whereDate('sale_date', $today)->distinct('employee_id')->count('employee_id');
        // Alertes stock (produits sous le seuil)
        $alertesStock = Inventory::whereColumn('quantity', '<', 'threshold')->count();

        // Ventes horaires (pour le graphe)
        $ventesHoraires = Sale::whereDate('sale_date', $today)
            ->selectRaw('HOUR(sale_date) as heure, SUM(total_price) as total')
            ->groupBy('heure')
            ->orderBy('heure')
            ->pluck('total', 'heure');

        // Produits populaires (top 5)
        $produitsPopulaires = Sale::whereDate('sale_date', $today)
            ->join('menus', 'sales.menu_id', '=', 'menus.id')
            ->selectRaw('menus.name, SUM(sales.quantity) as total')
            ->groupBy('menus.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'menus.name');

        // Commandes en attente cuisine
        $commandesCuisine = KitchenOrder::where('status', 'en attente')->count();
        // Produits à commander (stock sous le seuil)
        $produitsACommander = $alertesStock;
        // Réservations du jour
        $reservationsJour = Reservation::whereDate('date', $today)->count();
        // Employés en service (statut actif)
        $employesService = Employee::where('status', 'active')->count();

        return view('dashboard', [
            'salesToday' => $salesToday,
            'ordersToday' => $ordersToday,
            'clientsActifs' => $clientsActifs,
            'alertesStock' => $alertesStock,
            'ventesHoraires' => $ventesHoraires,
            'produitsPopulaires' => $produitsPopulaires,
            'commandesCuisine' => $commandesCuisine,
            'produitsACommander' => $produitsACommander,
            'reservationsJour' => $reservationsJour,
            'employesService' => $employesService,
        ]);
    }
}
