@extends('layout')
@section('title', 'Gestion des Employés - BurgerDash')
@section('styles')
<style>
    /* ... CSS complet copié de employees.html ... */
     /* Variables et reset */
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

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    body {
        background-color: var(--gray-100);
        min-height: 100vh;
        padding: 2rem;
    }

    /* Header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .header h1 {
        font-size: 1.875rem;
        color: var(--gray-900);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .stat-card h3 {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    /* Employee Grid */
    .employee-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .employee-card {
        background: white;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .employee-card:hover {
        transform: translateY(-4px);
    }

    .employee-header {
        background: linear-gradient(to right, var(--primary), var(--primary-dark));
        padding: 1.5rem;
        color: white;
        position: relative;
    }

    .employee-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .employee-avatar i {
        font-size: 2rem;
        color: var(--primary);
    }

    .employee-name {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .employee-role {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .employee-status {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .employee-content {
        padding: 1.5rem;
    }

    .employee-info {
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: var(--gray-700);
        font-size: 0.875rem;
    }

    .employee-actions {
        display: flex;
        gap: 0.5rem;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-success {
        background-color: #def7ec;
        color: #03543f;
    }

    .badge-warning {
        background-color: #fef3c7;
        color: #92400e;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        outline: none;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
    }

    .btn-outline {
        background-color: transparent;
        border: 1px solid var(--gray-300);
        color: var(--gray-700);
    }

    .btn-outline:hover {
        border-color: var(--gray-400);
        background-color: var(--gray-50);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        padding: 2rem;
        border-radius: 0.5rem;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--gray-500);
        cursor: pointer;
    }

    /* Form */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--gray-700);
        font-weight: 500;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid var(--gray-300);
        border-radius: 0.375rem;
        font-size: 0.875rem;
        transition: border-color 0.2s;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary);
    }

    /* Search and Filters */
    .filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }

        .employee-grid {
            grid-template-columns: 1fr;
        }

        .filters {
            flex-direction: column;
        }

        .filters > * {
            width: 100%;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .employee-card {
        animation: fadeIn 0.3s ease-out;
    }
</style>
@endsection
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Employés - BurgerDash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="header">
        <h1>Gestion des Employés</h1>
        <button class="btn btn-primary" id="addEmployeeBtn">
            <i class="fas fa-user-plus"></i>
            Ajouter un employé
        </button>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>{{ $actifs }}</h3>
            <p>Employés actifs</p>
        </div>
        <div class="stat-card">
            <h3>{{ $enFormation }}</h3>
            <p>En formation</p>
        </div>
        <div class="stat-card">
            <h3>{{ $tauxPresence }}%</h3>
            <p>Taux de présence</p>
        </div>
        <div class="stat-card">
            <h3>{{ $equipes }}</h3>
            <p>Équipes</p>
        </div>
    </div>

    <div class="filters">
        <input type="text" class="form-input" placeholder="Rechercher un employé..." id="searchInput">
        <select class="form-select" id="roleFilter">
            <option value="">Tous les rôles</option>
            <option value="manager">Manager</option>
            <option value="chef">Chef</option>
            <option value="server">Serveur</option>
            <option value="cashier">Caissier</option>
        </select>
        <select class="form-select" id="statusFilter">
            <option value="">Tous les statuts</option>
            <option value="active">Actif</option>
            <option value="training">En formation</option>
            <option value="inactive">Inactif</option>
        </select>
    </div>

    <div class="employee-grid">
        @foreach($employees as $employee)
        <div class="employee-card">
            <div class="employee-header">
                <div class="employee-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h3 class="employee-name">{{ $employee->name }}</h3>
                <p class="employee-role">{{ ucfirst($employee->role) }}</p>
                <span class="employee-status badge {{ $employee->status === 'active' ? 'badge-success' : 'badge-warning' }}">
                    {{ $employee->status === 'active' ? 'Actif' : ($employee->status === 'training' ? 'En formation' : 'Inactif') }}
                </span>
            </div>
            <div class="employee-content">
                <div class="employee-info">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $employee->email }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $employee->phone }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Depuis le {{ $employee->start_date ? \Carbon\Carbon::parse($employee->start_date)->format('d/m/Y') : '-' }}</span>
                    </div>
                </div>
                <div class="employee-actions">
                    <button class="btn btn-outline" onclick="editEmployee(this)">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </button>
                    <button class="btn btn-outline" onclick="toggleStatus(this)">
                        <i class="fas fa-power-off"></i>
                        Statut
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal Ajout Employé -->
    <div class="modal" id="addEmployeeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Ajouter un employé</h2>
                <button class="modal-close" onclick="closeModal('addEmployeeModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('employees.store') }}">
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
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="phone" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <input type="text" name="role" class="form-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
            </form>
        </div>
    </div>
    <!-- Modal Édition Employé -->
    <div class="modal" id="editEmployeeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Modifier l'employé</h2>
                <button class="modal-close" onclick="closeModal('editEmployeeModal')">&times;</button>
            </div>
            <form method="POST" id="editEmployeeForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="employee_id" id="edit_employee_id">
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" id="edit_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="edit_email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="phone" id="edit_phone" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" id="edit_status" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <input type="text" name="role" id="edit_role" class="form-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
    </div>

    <script>
        // ... JS complet copié de employees.html ...
         // DOM Elements
         const searchInput = document.getElementById('searchInput');
        const roleFilter = document.getElementById('roleFilter');
        const statusFilter = document.getElementById('statusFilter');
        const addEmployeeBtn = document.getElementById('addEmployeeBtn');
        // const modal = document.getElementById('employeeModal');
        // const modalClose = modal.querySelector('.modal-close');
        // const employeeForm = document.getElementById('employeeForm');

        // Filter employees
        function filterEmployees() {
            const searchTerm = searchInput.value.toLowerCase();
            const role = roleFilter.value;
            const status = statusFilter.value;

            document.querySelectorAll('.employee-card').forEach(card => {
                const name = card.querySelector('.employee-name').textContent.toLowerCase();
                const employeeRole = card.querySelector('.employee-role').textContent.toLowerCase();
                const employeeStatus = card.querySelector('.employee-status').textContent.toLowerCase();

                const matchesSearch = name.includes(searchTerm);
                const matchesRole = !role || employeeRole === role;
                const matchesStatus = !status || employeeStatus === status;

                card.style.display = matchesSearch && matchesRole && matchesStatus ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterEmployees);
        roleFilter.addEventListener('change', filterEmployees);
        statusFilter.addEventListener('change', filterEmployees);

        // Modal Functions
        function openModal(id) { document.getElementById(id).classList.add('active'); }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }

        addEmployeeBtn.addEventListener('click', () => {
            // Réinitialise le formulaire d'ajout
            const form = document.querySelector('#addEmployeeModal form');
            form.reset();
            openModal('addEmployeeModal');
        });

        // Edit Employee
        function editEmployee(btn) {
            const card = btn.closest('.employee-card');
            // Récupère les infos
            const name = card.querySelector('.employee-name').textContent;
            const role = card.querySelector('.employee-role').textContent;
            const email = card.querySelector('.info-item:nth-child(1) span').textContent;
            const status = card.querySelector('.employee-status').textContent.trim().toLowerCase();
            // Pré-remplit le formulaire d'édition
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            document.getElementById('edit_status').value = status;
            openModal('editEmployeeModal');
        }

        // Toggle Status
        function toggleStatus(btn) {
            const card = btn.closest('.employee-card');
            const statusBadge = card.querySelector('.employee-status');
            
            if (statusBadge.classList.contains('badge-success')) {
                statusBadge.classList.replace('badge-success', 'badge-warning');
                statusBadge.textContent = 'Inactif';
            } else {
                statusBadge.classList.replace('badge-warning', 'badge-success');
                statusBadge.textContent = 'Actif';
            }
        }

        // Fermer les modals sur clic croix ou fond
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
    // Mets ici tout le JS de la page employees
</script>
@endsection 