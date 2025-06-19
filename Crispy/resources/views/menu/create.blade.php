@extends('layout')
@section('title', 'Ajouter un plat')
@section('content')
<h1>Ajouter un plat</h1>
<form method="POST" action="{{ route('menu.store') }}">
    @csrf
    <div>
        <label>Nom</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Description</label>
        <textarea name="description"></textarea>
    </div>
    <div>
        <label>Catégorie</label>
        <input type="text" name="category" required>
    </div>
    <div>
        <label>Prix (€)</label>
        <input type="number" name="price" min="0" step="0.01" required>
    </div>
    <div>
        <label>Disponible</label>
        <select name="available" required>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
    </div>
    <div>
        <label>Image (URL)</label>
        <input type="text" name="image">
    </div>
    <button type="submit">Ajouter</button>
</form>
@endsection 