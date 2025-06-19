@extends('layout')
@section('title', 'Modifier une vente')
@section('content')
<h1>Modifier la vente #{{ $sale->id }}</h1>
<form method="POST" action="{{ route('sales.update', $sale->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label>Date de vente</label>
        <input type="datetime-local" name="sale_date" value="{{ $sale->sale_date->format('Y-m-d\TH:i') }}" required>
    </div>
    <div>
        <label>Employé</label>
        <select name="employee_id">
            <option value="">- Aucun -</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" @if($sale->employee_id == $employee->id) selected @endif>{{ $employee->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Produit</label>
        <select name="menu_id" required>
            @foreach($menus as $menu)
                <option value="{{ $menu->id }}" @if($sale->menu_id == $menu->id) selected @endif>{{ $menu->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Quantité</label>
        <input type="number" name="quantity" min="1" value="{{ $sale->quantity }}" required>
    </div>
    <div>
        <label>Total (€)</label>
        <input type="number" name="total_price" min="0" step="0.01" value="{{ $sale->total_price }}" required>
    </div>
    <div>
        <label>Méthode de paiement</label>
        <input type="text" name="payment_method" value="{{ $sale->payment_method }}" required>
    </div>
    <div>
        <label>Statut</label>
        <input type="text" name="status" value="{{ $sale->status }}" required>
    </div>
    <button type="submit">Enregistrer</button>
</form>
@endsection 