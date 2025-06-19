@extends('layout')
@section('title', 'Modifier un produit inventaire')
@section('content')
<h1>Modifier le produit inventaire #{{ $inventory->id }}</h1>
<form method="POST" action="{{ route('inventory.update', $inventory->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label>Nom</label>
        <input type="text" name="name" value="{{ $inventory->name }}" required>
    </div>
    <div>
        <label>Quantité</label>
        <input type="number" name="quantity" min="0" value="{{ $inventory->quantity }}" required>
    </div>
    <div>
        <label>Seuil d'alerte</label>
        <input type="number" name="threshold" min="0" value="{{ $inventory->threshold }}" required>
    </div>
    <div>
        <label>Unité</label>
        <input type="text" name="unit" value="{{ $inventory->unit }}" required>
    </div>
    <button type="submit">Enregistrer</button>
</form>
@endsection 