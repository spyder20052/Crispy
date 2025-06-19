@extends('layout')
@section('title', 'Modifier une commande cuisine')
@section('content')
<h1>Modifier la commande cuisine #{{ $kitchen->id }}</h1>
<form method="POST" action="{{ route('kitchen.update', $kitchen->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label>ID Vente</label>
        <input type="number" name="sale_id" value="{{ $kitchen->sale_id }}" required>
    </div>
    <div>
        <label>Statut</label>
        <input type="text" name="status" value="{{ $kitchen->status }}" required>
    </div>
    <div>
        <label>Notes</label>
        <textarea name="notes">{{ $kitchen->notes }}</textarea>
    </div>
    <button type="submit">Enregistrer</button>
</form>
@endsection 