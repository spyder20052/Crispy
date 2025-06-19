@extends('layout')
@section('title', 'Ajouter une commande cuisine')
@section('content')
<h1>Ajouter une commande cuisine</h1>
<form method="POST" action="{{ route('kitchen.store') }}">
    @csrf
    <div>
        <label>ID Vente</label>
        <input type="number" name="sale_id" required>
    </div>
    <div>
        <label>Statut</label>
        <input type="text" name="status" required>
    </div>
    <div>
        <label>Notes</label>
        <textarea name="notes"></textarea>
    </div>
    <button type="submit">Ajouter</button>
</form>
@endsection 