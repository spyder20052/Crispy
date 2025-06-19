@extends('layout')
@section('title', 'Ajouter une vente')
@section('content')
<h1>Ajouter une vente</h1>
<form method="POST" action="{{ route('sales.store') }}">
    @csrf
    <div>
        <label>Date de vente</label>
        <input type="datetime-local" name="sale_date" required>
    </div>
    <div>
        <label>Employé</label>
        <select name="employee_id">
            <option value="">- Aucun -</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Produit</label>
        <select name="menu_id" required>
            @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Quantité</label>
        <input type="number" name="quantity" min="1" required>
    </div>
    <div>
        <label>Total (€)</label>
        <input type="number" name="total_price" min="0" step="0.01" required>
    </div>
    <div>
        <label>Méthode de paiement</label>
        <input type="text" name="payment_method" required>
    </div>
    <div>
        <label>Statut</label>
        <input type="text" name="status" required>
    </div>
    <button type="submit">Ajouter</button>
</form>
@endsection 