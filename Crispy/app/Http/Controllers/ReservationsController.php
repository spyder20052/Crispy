<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    public function index() {
        $today = Carbon::today();
        $month = Carbon::now()->month;
        $reservationsToday = Reservation::whereDate('date', $today)->get();
        $reservationsMonth = Reservation::whereMonth('date', $month)->get();
        return view('reservations', [
            'reservationsToday' => $reservationsToday,
            'reservationsMonth' => $reservationsMonth,
        ]);
    }

    public function create() {
        return view('reservations.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'email' => 'required|email',
            'date' => 'required|date',
            'guests' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);
        Reservation::create($validated);
        return redirect('/reservations')->with('success', 'Réservation ajoutée avec succès.');
    }

    public function edit($id) {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, $id) {
        $reservation = Reservation::findOrFail($id);
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'email' => 'required|email',
            'date' => 'required|date',
            'guests' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);
        $reservation->update($validated);
        return redirect('/reservations')->with('success', 'Réservation modifiée avec succès.');
    }

    public function destroy($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect('/reservations')->with('success', 'Réservation supprimée avec succès.');
    }
}
