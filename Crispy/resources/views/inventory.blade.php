@extends('layout')
@section('title', 'Gestion des Stocks - BurgerDash')
@section('styles')
<style>
    /* ... CSS complet copié de inventory.html ... */
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

    /* Alerts Section */
    .alerts-section {
        margin-bottom: 2rem;
    }

    .alerts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .alert-card {
        background: white;
        border-radius: 0.5rem;
        padding: 1rem;
        border-left: 4px solid var(--danger);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .alert-icon {
        width: 2.5rem;
        height: 2.5rem;
        background-color: #fee2e2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--danger);
    }

    .alert-content h3 {
        color: var(--gray-900);
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .alert-content p {
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    /* Inventory Table */
    .inventory-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .inventory-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .inventory-filters {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .table-container {
        overflow-x: auto;
    }

    .inventory-table {
        width: 100%;
        border-collapse: collapse;
    }

    .inventory-table th,
    .inventory-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }

    .inventory-table th {
        background-color: var(--gray-50);
        font-weight: 600;
        color: var(--gray-700);
    }

    .inventory-table tbody tr:hover {
        background-color: var(--gray-50);
    }

    /* Stock Level Indicator */
    .stock-level {
        width: 100%;
        height: 6px;
        background-color: var(--gray-200);
        border-radius: 3px;
        overflow: hidden;
    }

    .stock-level-bar {
        height: 100%;
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .stock-level-high {
        background-color: var(--success);
    }

    .stock-level-medium {
        background-color: var(--warning);
    }

    .stock-level-low {
        background-color: var(--danger);
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

    /* Form Controls */
    .form-input,
    .form-select {
        padding: 0.5rem;
        border: 1px solid var(--gray-300);
        border-radius: 0.375rem;
        font-size: 0.875rem;
        outline: none;
        transition: border-color 0.2s;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--primary);
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

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--gray-700);
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }

        .inventory-filters {
            flex-direction: column;
        }

        .inventory-filters > * {
            width: 100%;
        }
    }

    /* Animations */
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert-card {
        animation: slideIn 0.3s ease-out;
    }
</style>
@endsection
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stocks - BurgerDash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="header">
        <h1>Gestion des Stocks</h1>
        <button class="btn btn-primary" id="openAddInventoryModal">
            <i class="fas fa-plus"></i>
            Ajouter un produit
        </button>
    </div>

    <section class="alerts-section">
        <div class="alerts-grid">
            @foreach($alertes as $alerte)
            <div class="alert-card">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="alert-content">
                    <h3>Stock faible : {{ $alerte->name }}</h3>
                    <p>Reste {{ $alerte->quantity }} {{ $alerte->unit }} (seuil : {{ $alerte->threshold }} {{ $alerte->unit }})</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <div class="inventory-card">
        <div class="inventory-header">
            <div class="inventory-filters">
                <input type="text" class="form-input" placeholder="Rechercher un ingrédient..." id="searchInput">
                <select class="form-select" id="categoryFilter">
                    <option value="">Toutes les catégories</option>
                    <option value="bread">Pain</option>
                    <option value="meat">Viande</option>
                    <option value="vegetables">Légumes</option>
                    <option value="sauce">Sauces</option>
                    <option value="drinks">Boissons</option>
                </select>
                <select class="form-select" id="stockFilter">
                    <option value="">Tous les niveaux</option>
                    <option value="low">Stock faible</option>
                    <option value="medium">Stock moyen</option>
                    <option value="high">Stock élevé</option>
                </select>
            </div>
        </div>

        <div class="table-container">
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Ingrédient</th>
                        <th>Catégorie</th>
                        <th>Stock actuel</th>
                        <th>Niveau</th>
                        <th>Seuil d'alerte</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->name }}</td>
                        <td>{{ $inventory->category }}</td>
                        <td>{{ $inventory->quantity }} {{ $inventory->unit }}</td>
                        <td>
                            <div class="stock-level">
                                @php
                                    $percent = $inventory->threshold > 0 ? min(100, round(($inventory->quantity / $inventory->threshold) * 100)) : 100;
                                    $levelClass = $percent <= 25 ? 'stock-level-low' : ($percent <= 50 ? 'stock-level-medium' : 'stock-level-high');
                                @endphp
                                <div class="stock-level-bar {{ $levelClass }}" style="width: {{ $percent }}%"></div>
                            </div>
                        </td>
                        <td>{{ $inventory->threshold }} {{ $inventory->unit }}</td>
                        <td>
                            <button class="btn btn-outline edit-inventory-btn"
                                data-id="{{ $inventory->id }}"
                                data-name="{{ $inventory->name }}"
                                data-quantity="{{ $inventory->quantity }}"
                                data-threshold="{{ $inventory->threshold }}"
                                data-unit="{{ $inventory->unit }}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Ajout Inventaire -->
    <div class="modal" id="addInventoryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Ajouter un produit</h2>
                <button class="modal-close" onclick="closeModal('addInventoryModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('inventory.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantité</label>
                    <input type="number" name="quantity" class="form-input" min="0" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Seuil d'alerte</label>
                    <input type="number" name="threshold" class="form-input" min="0" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Unité</label>
                    <input type="text" name="unit" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select name="category" class="form-input" required>
                        <option value="">Sélectionner</option>
                        <option value="Frais">Frais</option>
                        <option value="Sec">Sec</option>
                        <option value="Boisson">Boisson</option>
                        <option value="Emballage">Emballage</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
            </form>
        </div>
    </div>
    <!-- Modal Édition Inventaire -->
    <div class="modal" id="editInventoryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Modifier le produit</h2>
                <button class="modal-close" onclick="closeModal('editInventoryModal')">&times;</button>
            </div>
            <form method="POST" id="editInventoryForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="inventory_id" id="edit_inventory_id">
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" id="edit_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantité</label>
                    <input type="number" name="quantity" id="edit_quantity" class="form-input" min="0" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Seuil d'alerte</label>
                    <input type="number" name="threshold" id="edit_threshold" class="form-input" min="0" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Unité</label>
                    <input type="text" name="unit" id="edit_unit" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select name="category" id="edit_category" class="form-input" required>
                        <option value="">Sélectionner</option>
                        <option value="Frais">Frais</option>
                        <option value="Sec">Sec</option>
                        <option value="Boisson">Boisson</option>
                        <option value="Emballage">Emballage</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
    </div>

    <script>
        // ... JS complet copié de inventory.html ...
                // DOM Elements
                const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const stockFilter = document.getElementById('stockFilter');
        // const adjustModal = document.getElementById('adjustModal');
        const adjustForm = document.getElementById('adjustForm');
        const modalClose = document.querySelector('.modal-close');

        // Filter inventory
        function filterInventory() {
            const searchTerm = searchInput.value.toLowerCase();
            const category = categoryFilter.value;
            const stockLevel = stockFilter.value;

            document.querySelectorAll('.inventory-table tbody tr').forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const rowCategory = row.cells[1].textContent.toLowerCase();
                const stockBar = row.querySelector('.stock-level-bar');
                const level = stockBar.classList.contains('stock-level-low') ? 'low' :
                             stockBar.classList.contains('stock-level-medium') ? 'medium' : 'high';

                const matchesSearch = name.includes(searchTerm);
                const matchesCategory = !category || rowCategory === category;
                const matchesStock = !stockLevel || level === stockLevel;

                row.style.display = matchesSearch && matchesCategory && matchesStock ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterInventory);
        categoryFilter.addEventListener('change', filterInventory);
        stockFilter.addEventListener('change', filterInventory);

        // Modal Functions
        function adjustStock(btn) {
            const row = btn.closest('tr');
            document.getElementById('itemName').value = row.cells[0].textContent;
            document.getElementById('currentStock').value = row.cells[2].textContent;
            // adjustModal.classList.add('active');
        }

        // modalClose.addEventListener('click', () => {
        //     adjustModal.classList.remove('active');
        // });

        // adjustModal.addEventListener('click', (e) => {
        //     if (e.target === adjustModal) {
        //         adjustModal.classList.remove('active');
        //     }
        // });

        // Stock Adjustment
        function incrementStock() {
            const input = document.getElementById('adjustAmount');
            input.value = parseInt(input.value) + 1;
        }

        function decrementStock() {
            const input = document.getElementById('adjustAmount');
            const newValue = parseInt(input.value) - 1;
            input.value = newValue >= 0 ? newValue : 0;
        }

        // adjustForm.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     // Add stock adjustment logic here
        //     adjustModal.classList.remove('active');
        // });

        // Update stock levels appearance
        function updateStockLevels() {
            document.querySelectorAll('.stock-level-bar').forEach(bar => {
                const width = parseInt(bar.style.width);
                if (width <= 25) {
                    bar.className = 'stock-level-bar stock-level-low';
                } else if (width <= 50) {
                    bar.className = 'stock-level-bar stock-level-medium';
                } else {
                    bar.className = 'stock-level-bar stock-level-high';
                }
            });
        }

        // Initial stock levels update
        updateStockLevels();

        function openModal(id) { document.getElementById(id).classList.add('active'); }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }
        document.getElementById('openAddInventoryModal').onclick = () => openModal('addInventoryModal');
        document.querySelectorAll('.edit-inventory-btn').forEach(btn => {
            btn.onclick = function() {
                const inventoryId = this.dataset.id;
                const action = `/inventory/${inventoryId}`;
                document.getElementById('editInventoryForm').action = action;
                document.getElementById('edit_inventory_id').value = inventoryId;
                document.getElementById('edit_name').value = this.dataset.name;
                document.getElementById('edit_quantity').value = this.dataset.quantity;
                document.getElementById('edit_threshold').value = this.dataset.threshold;
                document.getElementById('edit_unit').value = this.dataset.unit;
                document.getElementById('edit_category').value = this.dataset.category;
                openModal('editInventoryModal');
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
    // Mets ici tout le JS de la page inventory
</script>
@endsection 