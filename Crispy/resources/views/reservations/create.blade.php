@extends('layout')
@section('title', 'Ajouter une réservation')
@section('content')
<h1>Ajouter une réservation</h1>
<form method="POST" action="{{ route('reservations.store') }}">
    @csrf
    <div>
        <label>Nom</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Date</label>
        <input type="datetime-local" name="date" required>
    </div>
    <div>
        <label>Nombre de personnes</label>
        <input type="number" name="guests" min="1" required>
    </div>
    <div>
        <label>Statut</label>
        <input type="text" name="status" required>
    </div>
    <button type="submit">Ajouter</button>
</form>
@endsection 