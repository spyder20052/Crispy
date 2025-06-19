@extends('layout')
@section('title', 'Modifier un plat')
@section('content')
<h1>Modifier le plat #{{ $menu->id }}</h1>
<form method="POST" action="{{ route('menu.update', $menu->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label>Nom</label>
        <input type="text" name="name" value="{{ $menu->name }}" required>
    </div>
    <div>
        <label>Description</label>
        <textarea name="description">{{ $menu->description }}</textarea>
    </div>
    <div>
        <label>Catégorie</label>
        <input type="text" name="category" value="{{ $menu->category }}" required>
    </div>
    <div>
        <label>Prix (€)</label>
        <input type="number" name="price" min="0" step="0.01" value="{{ $menu->price }}" required>
    </div>
    <div>
        <label>Disponible</label>
        <select name="available" required>
            <option value="1" @if($menu->available) selected @endif>Oui</option>
            <option value="0" @if(!$menu->available) selected @endif>Non</option>
        </select>
    </div>
    <div>
        <label>Image (URL)</label>
        <input type="text" name="image" value="{{ $menu->image }}">
    </div>
    <button type="submit">Enregistrer</button>
</form>
@endsection 