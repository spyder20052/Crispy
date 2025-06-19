@extends('layout')
@section('title', 'Ajouter un produit inventaire')
@section('content')
<h1>Ajouter un produit inventaire</h1>
<form method="POST" action="{{ route('inventory.store') }}">
    @csrf
    <div>
        <label>Nom</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Quantité</label>
        <input type="number" name="quantity" min="0" required>
    </div>
    <div>
        <label>Seuil d'alerte</label>
        <input type="number" name="threshold" min="0" required>
    </div>
    <div>
        <label>Unité</label>
        <input type="text" name="unit" required>
    </div>
    <button type="submit">Ajouter</button>
</form>
@endsection 