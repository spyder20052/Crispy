@extends('layout')
@section('title', 'Modifier une réservation')
@section('content')
<h1>Modifier la réservation #{{ $reservation->id }}</h1>
<form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label>Nom</label>
        <input type="text" name="name" value="{{ $reservation->name }}" required>
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ $reservation->email }}" required>
    </div>
    <div>
        <label>Date</label>
        <input type="datetime-local" name="date" value="{{ $reservation->date->format('Y-m-d\TH:i') }}" required>
    </div>
    <div>
        <label>Nombre de personnes</label>
        <input type="number" name="guests" min="1" value="{{ $reservation->guests }}" required>
    </div>
    <div>
        <label>Statut</label>
        <input type="text" name="status" value="{{ $reservation->status }}" required>
    </div>
    <button type="submit">Enregistrer</button>
</form>
@endsection 