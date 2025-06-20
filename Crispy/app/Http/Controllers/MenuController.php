<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index() {
        $menus = Menu::all();
        return view('menu', compact('menus'));
    }

    public function create() {
        return view('menu.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'available' => 'required|boolean',
            'image' => 'nullable|string',
        ]);
        $menu = Menu::create($validated);
        if ($request->ajax()) {
            return response()->json(['menu' => $menu], 201);
        }
        return redirect('/menu')->with('success', 'Plat ajouté avec succès.');
    }

    public function edit($id) {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, $id) {
        $menu = Menu::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'available' => 'required|boolean',
            'image' => 'nullable|string',
        ]);
        $menu->update($validated);
        return redirect('/menu')->with('success', 'Plat modifié avec succès.');
    }

    public function destroy($id) {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect('/menu')->with('success', 'Plat supprimé avec succès.');
    }
}
