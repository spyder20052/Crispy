@extends('layout')
@section('title', 'Modifier un employé')
@section('content')
<h1>Modifier l'employé #{{ $employee->id }}</h1>
<form method="POST" action="{{ route('employees.update', $employee->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label>Nom</label>
        <input type="text" name="name" value="{{ $employee->name }}" required>
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ $employee->email }}" required>
    </div>
    <div>
        <label>Statut</label>
        <input type="text" name="status" value="{{ $employee->status }}" required>
    </div>
    <div>
        <label>Rôle</label>
        <input type="text" name="role" value="{{ $employee->role }}" required>
    </div>
    <button type="submit">Enregistrer</button>
</form>
@endsection 