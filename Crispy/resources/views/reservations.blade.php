@extends('layout')
@section('title', 'Réservations - BurgerDash')
@section('styles')
<style>
    :root {
        --primary: #FF4136;
        --primary-dark: #E60000;
        --primary-light: #FF7675;
        --secondary: #FF851B;
        --accent: #FFDC00;
        --success: #2ECC40;
        --warning: #FF851B;
        --danger: #FF4136;
        --gray-100: #f7fafc;
        --gray-200: #edf2f7;
        --gray-300: #e2e8f0;
        --gray-400: #cbd5e0;
        --gray-500: #a0aec0;
        --gray-600: #718096;
        --gray-700: #4a5568;
        --gray-800: #2d3748;
        --gray-900: #1a202c;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', system-ui, sans-serif; }
    body { background-color: var(--gray-100); min-height: 100vh; padding: 2rem; }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
    .header h1 { font-size: 1.875rem; color: var(--gray-900); }
    .grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
    @media (max-width: 1024px) { .grid { grid-template-columns: 1fr; } }
    .card { background: white; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); overflow: hidden; }
    .card-header { padding: 1.5rem; border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center; }
    .card-title { font-size: 1.25rem; color: var(--gray-800); font-weight: 600; }
    .card-body { padding: 1.5rem; }
    .calendar { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
    .calendar th { padding: 0.75rem; text-align: center; font-weight: 600; color: var(--gray-700); }
    .calendar td { padding: 0.75rem; text-align: center; border: 1px solid var(--gray-200); cursor: pointer; position: relative; }
    .calendar td:hover { background-color: var(--gray-100); }
    .calendar .today { background-color: var(--primary-light); color: white; }
    .calendar .has-reservations::after { content: ''; position: absolute; bottom: 0.25rem; left: 50%; transform: translateX(-50%); width: 0.375rem; height: 0.375rem; background-color: var(--primary); border-radius: 50%; }
    .reservations-list { list-style: none; }
    .reservation-item { padding: 1rem; border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center; }
    .reservation-item:last-child { border-bottom: none; }
    .reservation-info h3 { font-size: 1rem; color: var(--gray-800); margin-bottom: 0.25rem; }
    .reservation-info p { font-size: 0.875rem; color: var(--gray-600); }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--gray-700); font-weight: 500; }
    .form-input, .form-select { width: 100%; padding: 0.5rem; border: 1px solid var(--gray-300); border-radius: 0.375rem; font-size: 0.875rem; outline: none; transition: border-color 0.2s; }
    .form-input:focus, .form-select:focus { border-color: var(--primary); }
    .btn { display: inline-flex; align-items: center; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 500; cursor: pointer; transition: all 0.2s; border: none; outline: none; gap: 0.5rem; }
    .btn-primary { background-color: var(--primary); color: white; }
    .btn-primary:hover { background-color: var(--primary-dark); }
    .btn-outline { background-color: transparent; border: 1px solid var(--gray-300); color: var(--gray-700); }
    .btn-outline:hover { border-color: var(--gray-400); background-color: var(--gray-50); }
    .badge { display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; }
    .badge-pending { background-color: #fef3c7; color: #92400e; }
    .badge-confirmed { background-color: #def7ec; color: #03543f; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.3s ease-out; }
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.3); justify-content: center; align-items: center; z-index: 1000; }
    .modal.active { display: flex; }
    .modal-content { background: white; padding: 2rem 2.5rem; border-radius: 0.7rem; min-width: 350px; max-width: 95vw; box-shadow: 0 8px 32px rgba(0,0,0,0.18); }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .modal-close { background: none; border: none; font-size: 2rem; color: #aaa; cursor: pointer; }
    .form-group { margin-bottom: 1.2rem; display: flex; flex-direction: column; }
    .form-label { font-weight: 600; margin-bottom: 0.4rem; color: #333; }
    .form-input { padding: 0.6rem 1rem; border: 1px solid #e2e8f0; border-radius: 0.4rem; font-size: 1rem; transition: border-color 0.2s; }
    .form-input:focus { border-color: var(--primary); outline: none; }
    .btn-block { width: 100%; margin-top: 0.5rem; font-size: 1.1rem; border-radius: 0.4rem; padding: 0.7rem 0; }
</style>
@endsection
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations - BurgerDash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="header">
        <h1>Réservations</h1>
        <button class="btn btn-primary" id="openAddReservationModal">
            <i class="fas fa-plus"></i>
            Nouvelle réservation
        </button>
    </div>
    <div class="grid">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h2 class="card-title">Réservations du jour</h2>
                <div>
                    <button class="btn btn-outline">
                        <i class="fas fa-filter"></i>
                        Filtrer
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="reservations-list">
                    @foreach($reservationsToday as $reservation)
                    <li class="reservation-item">
                        <div class="reservation-info">
                            <h3>{{ $reservation->name }} ({{ $reservation->guests }} pers.)</h3>
                            <p>{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="badge {{ $reservation->status === 'confirmé' ? 'badge-confirmed' : 'badge-pending' }}">{{ ucfirst($reservation->status) }}</span>
                        <button class="btn btn-outline edit-reservation-btn"
                            data-id="{{ $reservation->id }}"
                            data-name="{{ $reservation->name }}"
                            data-email="{{ $reservation->email }}"
                            data-date="{{ $reservation->date }}"
                            data-guests="{{ $reservation->guests }}"
                            data-status="{{ $reservation->status }}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card animate-fade-in">
            <div class="card-header">
                <h2 class="card-title">Calendrier</h2>
            </div>
            <div class="card-body">
                <table class="calendar">
                    <thead>
                        <tr>
                            <th>L</th>
                            <th>M</th>
                            <th>M</th>
                            <th>J</th>
                            <th>V</th>
                            <th>S</th>
                            <th>D</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td class="has-reservations">6</td>
                            <td class="has-reservations">7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td class="today">10</td>
                            <td class="has-reservations">11</td>
                            <td>12</td>
                            <td class="has-reservations">13</td>
                            <td>14</td>
                        </tr>
                    </tbody>
                </table>
                <form>
                    <div class="form-group">
                        <label class="form-label">Nom du client</label>
                        <input type="text" class="form-input" placeholder="Nom du client">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nombre de personnes</label>
                        <select class="form-select">
                            <option>1 personne</option>
                            <option>2 personnes</option>
                            <option>3 personnes</option>
                            <option>4 personnes</option>
                            <option>5 personnes</option>
                            <option>6 personnes</option>
                            <option>7+ personnes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Heure</label>
                        <input type="time" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Table</label>
                        <select class="form-select">
                            <option>Table 1 (2-4 pers.)</option>
                            <option>Table 2 (2-4 pers.)</option>
                            <option>Table 3 (2-4 pers.)</option>
                            <option>Table 4 (4-6 pers.)</option>
                            <option>Table 5 (4-6 pers.)</option>
                            <option>Table 6 (6-8 pers.)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-check"></i>
                        Confirmer la réservation
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ajout Réservation -->
    <div class="modal" id="addReservationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Nouvelle réservation</h2>
                <button class="modal-close" onclick="closeModal('addReservationModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="datetime-local" name="date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre de personnes</label>
                    <input type="number" name="guests" class="form-input" min="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom du client</label>
                    <input type="text" name="customer_name" class="form-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
            </form>
        </div>
    </div>
    <!-- Modal Édition Réservation -->
    <div class="modal" id="editReservationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Modifier la réservation</h2>
                <button class="modal-close" onclick="closeModal('editReservationModal')">&times;</button>
            </div>
            <form method="POST" id="editReservationForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="reservation_id" id="edit_reservation_id">
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" id="edit_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="edit_email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="datetime-local" name="date" id="edit_date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre de personnes</label>
                    <input type="number" name="guests" id="edit_guests" class="form-input" min="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" id="edit_status" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom du client</label>
                    <input type="text" name="customer_name" id="edit_customer_name" class="form-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
    </div>
    <script>
        function openModal(id) { document.getElementById(id).classList.add('active'); }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }
        document.getElementById('openAddReservationModal').onclick = () => openModal('addReservationModal');
        document.querySelectorAll('.edit-reservation-btn').forEach(btn => {
            btn.onclick = function() {
                const reservationId = this.dataset.id;
                const action = `/reservations/${reservationId}`;
                document.getElementById('editReservationForm').action = action;
                document.getElementById('edit_reservation_id').value = reservationId;
                document.getElementById('edit_name').value = this.dataset.name;
                document.getElementById('edit_email').value = this.dataset.email;
                document.getElementById('edit_date').value = this.dataset.date.replace(' ', 'T');
                document.getElementById('edit_guests').value = this.dataset.guests;
                document.getElementById('edit_status').value = this.dataset.status;
                document.getElementById('edit_customer_name').value = this.dataset.name;
                openModal('editReservationModal');
            }
        });
        document.querySelectorAll('.modal-close').forEach(btn => {
            btn.onclick = function() { closeModal(this.closest('.modal').id); }
        });
        window.onclick = function(event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target === modal) closeModal(modal.id);
            });
        }
    </script>
</body>
</html>
@endsection
@section('scripts')
<script>
    // Mets ici tout le JS de la page reservations
</script>
@endsection 