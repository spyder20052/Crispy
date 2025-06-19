<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Team;

class EmployeesController extends Controller
{
    public function index() {
        $employees = Employee::all();
        $actifs = Employee::where('status', 'active')->count();
        $enFormation = Employee::where('status', 'training')->count();
        $equipes = Team::count();
        // Taux de présence fictif (à calculer selon la logique métier)
        $tauxPresence = 98;
        return view('employees', [
            'employees' => $employees,
            'actifs' => $actifs,
            'enFormation' => $enFormation,
            'equipes' => $equipes,
            'tauxPresence' => $tauxPresence,
        ]);
    }

    public function create() {
        return view('employees.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'status' => 'required|string',
            'role' => 'required|string',
        ]);
        Employee::create($validated);
        return redirect('/employees')->with('success', 'Employé ajouté avec succès.');
    }

    public function edit($id) {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id) {
        $employee = Employee::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'status' => 'required|string',
            'role' => 'required|string',
        ]);
        $employee->update($validated);
        return redirect('/employees')->with('success', 'Employé modifié avec succès.');
    }

    public function destroy($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect('/employees')->with('success', 'Employé supprimé avec succès.');
    }
}
