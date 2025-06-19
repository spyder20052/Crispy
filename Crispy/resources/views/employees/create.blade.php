@extends('layout')
@section('title', 'Ajouter un employé')
@section('content')
<h1>Ajouter un employé</h1>
<form method="POST" action="{{ route('employees.store') }}">
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
        <label>Statut</label>
        <input type="text" name="status" required>
    </div>
    <div>
        <label>Rôle</label>
        <input type="text" name="role" required>
    </div>
    <button type="submit">Ajouter</button>
</form>
@endsection 