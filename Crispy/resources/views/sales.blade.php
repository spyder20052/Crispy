@extends('layout')
@section('title', 'Ventes - BurgerDash')
@section('styles')
<style>
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
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', system-ui, sans-serif; }
    body { background-color: var(--gray-100); min-height: 100vh; padding: 2rem; }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
    .header h1 { font-size: 1.875rem; color: var(--gray-900); }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .stat-card { background: white; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
    .stat-card h3 { font-size: 2rem; color: var(--primary); margin-bottom: 0.5rem; }
    .stat-card p { color: var(--gray-600); font-size: 0.875rem; }
    .stat-trend { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; margin-top: 0.5rem; }
    .trend-up { color: var(--success); }
    .trend-down { color: var(--danger); }
    .charts-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .chart-card { background: white; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
    .chart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .chart-title { font-size: 1.25rem; color: var(--gray-800); font-weight: 600; }
    .chart-container { position: relative; height: 300px; }
    .sales-card { background: white; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); overflow: hidden; }
    .sales-header { padding: 1.5rem; border-bottom: 1px solid var(--gray-200); }
    .sales-filters { display: flex; gap: 1rem; flex-wrap: wrap; }
    .table-container { overflow-x: auto; }
    .sales-table { width: 100%; border-collapse: collapse; }
    .sales-table th, .sales-table td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--gray-200); }
    .sales-table th { background-color: var(--gray-50); font-weight: 600; color: var(--gray-700); }
    .sales-table tbody tr:hover { background-color: var(--gray-50); }
    .form-input, .form-select { padding: 0.5rem; border: 1px solid var(--gray-300); border-radius: 0.375rem; font-size: 0.875rem; outline: none; transition: border-color 0.2s; }
    .form-input:focus, .form-select:focus { border-color: var(--primary); }
    .btn { display: inline-flex; align-items: center; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 500; cursor: pointer; transition: all 0.2s; border: none; outline: none; gap: 0.5rem; }
    .btn-primary { background-color: var(--primary); color: white; }
    .btn-primary:hover { background-color: var(--primary-dark); }
    .btn-outline { background-color: transparent; border: 1px solid var(--gray-300); color: var(--gray-700); }
    .btn-outline:hover { border-color: var(--gray-400); background-color: var(--gray-50); }
    .badge { display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; }
    .badge-success { background-color: #def7ec; color: #03543f; }
    .badge-warning { background-color: #fef3c7; color: #92400e; }
    @media (max-width: 768px) { body { padding: 1rem; } .charts-grid { grid-template-columns: 1fr; } .sales-filters { flex-direction: column; } .sales-filters > * { width: 100%; } }
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
    <title>Ventes - BurgerDash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="header">
        <h1>Ventes</h1>
        <div>
            <button class="btn btn-primary" id="openAddSaleModal">
                <i class="fas fa-plus"></i> Ajouter une vente
            </button>
            <button class="btn btn-outline">
                <i class="fas fa-download"></i>
                Exporter
            </button>
        </div>
    </div>
    <div class="stats-grid">
        <div class="stat-card animate-fade-in">
            <h3>{{ number_format($salesToday, 2, ',', ' ') }} €</h3>
            <p>Ventes aujourd'hui</p>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up"></i>
                <span>+15% vs hier</span>
            </div>
        </div>
        <div class="stat-card animate-fade-in">
            <h3>{{ $ordersToday }}</h3>
            <p>Commandes</p>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up"></i>
                <span>+8% vs hier</span>
            </div>
        </div>
        <div class="stat-card animate-fade-in">
            <h3>{{ number_format($panierMoyen, 2, ',', ' ') }} €</h3>
            <p>Panier moyen</p>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up"></i>
                <span>+5% vs hier</span>
            </div>
        </div>
        <div class="stat-card animate-fade-in">
            <h3>{{ $conversion }}%</h3>
            <p>Taux de conversion</p>
            <div class="stat-trend trend-down">
                <i class="fas fa-arrow-down"></i>
                <span>-2% vs hier</span>
            </div>
        </div>
    </div>
    <div class="charts-grid">
        <div class="chart-card animate-fade-in">
            <div class="chart-header">
                <h3 class="chart-title">Ventes par heure</h3>
                <select class="form-select">
                    <option>Aujourd'hui</option>
                    <option>Cette semaine</option>
                    <option>Ce mois</option>
                </select>
            </div>
            <div class="chart-container">
                <canvas id="hourlyChart"></canvas>
            </div>
        </div>
        <div class="chart-card animate-fade-in">
            <div class="chart-header">
                <h3 class="chart-title">Produits les plus vendus</h3>
                <select class="form-select">
                    <option>Top 5</option>
                    <option>Top 10</option>
                    <option>Tous</option>
                </select>
            </div>
            <div class="chart-container">
                <canvas id="productsChart"></canvas>
            </div>
        </div>
    </div>
    <div class="sales-card animate-fade-in">
        <div class="sales-header">
            <div class="sales-filters">
                <input type="date" class="form-input" value="{{ date('Y-m-d') }}">
                <select class="form-select">
                    <option value="">Tous les produits</option>
                    <!-- Optionnel : générer dynamiquement les catégories -->
                </select>
                <select class="form-select">
                    <option value="">Tous les employés</option>
                    <!-- Optionnel : générer dynamiquement les employés -->
                </select>
                <input type="text" class="form-input" placeholder="Rechercher une commande...">
            </div>
        </div>
        <div class="table-container">
            <table class="sales-table">
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Date</th>
                        <th>Employé</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Paiement</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td>#{{ $sale->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $sale->employee_id ?? '-' }}</td>
                        <td>{{ $sale->menu->name ?? '-' }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ number_format($sale->total_price, 2, ',', ' ') }} €</td>
                        <td>{{ $sale->payment_method }}</td>
                        <td><span class="badge badge-success">{{ ucfirst($sale->status) }}</span></td>
                        <td>
                            <button class="btn btn-outline edit-sale-btn" 
                                data-id="{{ $sale->id }}"
                                data-sale_date="{{ $sale->sale_date }}"
                                data-employee_id="{{ $sale->employee_id }}"
                                data-menu_id="{{ $sale->menu_id }}"
                                data-quantity="{{ $sale->quantity }}"
                                data-total_price="{{ $sale->total_price }}"
                                data-payment_method="{{ $sale->payment_method }}"
                                data-status="{{ $sale->status }}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Ajout Vente -->
    <div class="modal" id="addSaleModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Ajouter une vente</h2>
                <button class="modal-close" onclick="closeModal('addSaleModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('sales.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Date de vente</label>
                    <input type="datetime-local" name="sale_date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Employé</label>
                    <select name="employee_id" class="form-input">
                        <option value="">- Aucun -</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Produit</label>
                    <select name="menu_id" class="form-input" required>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantité</label>
                    <input type="number" name="quantity" class="form-input" min="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Total (€)</label>
                    <input type="number" name="total_price" class="form-input" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Méthode de paiement</label>
                    <input type="text" name="payment_method" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" class="form-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
            </form>
        </div>
    </div>
    <!-- Modal Édition Vente -->
    <div class="modal" id="editSaleModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Modifier la vente</h2>
                <button class="modal-close" onclick="closeModal('editSaleModal')">&times;</button>
            </div>
            <form method="POST" id="editSaleForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="sale_id" id="edit_sale_id">
                <div class="form-group">
                    <label class="form-label">Date de vente</label>
                    <input type="datetime-local" name="sale_date" id="edit_sale_date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Employé</label>
                    <select name="employee_id" id="edit_employee_id" class="form-input">
                        <option value="">- Aucun -</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Produit</label>
                    <select name="menu_id" id="edit_menu_id" class="form-input" required>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantité</label>
                    <input type="number" name="quantity" id="edit_quantity" class="form-input" min="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Total (€)</label>
                    <input type="number" name="total_price" id="edit_total_price" class="form-input" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Méthode de paiement</label>
                    <input type="text" name="payment_method" id="edit_payment_method" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" id="edit_status" class="form-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
    </div>
    <script>
        // Hourly Sales Chart
        const hourlyCtx = document.getElementById('hourlyChart').getContext('2d');
        new Chart(hourlyCtx, {
            type: 'line',
            data: {
                labels: ['9h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h', '18h', '19h', '20h'],
                datasets: [{
                    label: 'Ventes (€)',
                    data: [150, 200, 350, 650, 850, 600, 450, 300, 400, 550, 750, 600],
                    borderColor: '#FF4136',
                    backgroundColor: 'rgba(255, 65, 54, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        // Top Products Chart
        const productsCtx = document.getElementById('productsChart').getContext('2d');
        new Chart(productsCtx, {
            type: 'bar',
            data: {
                labels: ['Classic Burger', 'Frites', 'Coca-Cola', 'Menu Maxi', 'Sundae'],
                datasets: [{
                    label: 'Quantité vendue',
                    data: [120, 95, 80, 60, 45],
                    backgroundColor: [
                        '#FF4136',
                        '#FF851B',
                        '#FFDC00',
                        '#2ECC40',
                        '#7FDBFF'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        // Filter sales
        document.querySelectorAll('.sales-filters input, .sales-filters select').forEach(filter => {
            // Ajoute ici la logique de filtrage si besoin
        });
        function openModal(id) { document.getElementById(id).classList.add('active'); }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }
        document.getElementById('openAddSaleModal').onclick = () => openModal('addSaleModal');
        document.querySelectorAll('.edit-sale-btn').forEach(btn => {
            btn.onclick = function() {
                const saleId = this.dataset.id;
                const action = `/sales/${saleId}`;
                document.getElementById('editSaleForm').action = action;
                document.getElementById('edit_sale_id').value = saleId;
                document.getElementById('edit_sale_date').value = this.dataset.sale_date.replace(' ', 'T');
                document.getElementById('edit_employee_id').value = this.dataset.employee_id || '';
                document.getElementById('edit_menu_id').value = this.dataset.menu_id;
                document.getElementById('edit_quantity').value = this.dataset.quantity;
                document.getElementById('edit_total_price').value = this.dataset.total_price;
                document.getElementById('edit_payment_method').value = this.dataset.payment_method;
                document.getElementById('edit_status').value = this.dataset.status;
                openModal('editSaleModal');
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
    // Données pour le graphe Ventes horaires
    const ventesHorairesLabels = {!! json_encode(array_map(fn($h)=>$h.'h', array_keys($ventesHoraires->toArray()))) !!};
    const ventesHorairesData = {!! json_encode(array_values($ventesHoraires->toArray())) !!};
    // Données pour le graphe Produits populaires
    const produitsPopulairesLabels = {!! json_encode(array_keys($produitsPopulaires->toArray())) !!};
    const produitsPopulairesData = {!! json_encode(array_values($produitsPopulaires->toArray())) !!};
    // Graphe Ventes horaires
    const hourlyCtx = document.getElementById('hourlyChart').getContext('2d');
    new Chart(hourlyCtx, {
        type: 'line',
        data: {
            labels: ventesHorairesLabels,
            datasets: [{
                label: 'Ventes (€)',
                data: ventesHorairesData,
                borderColor: '#FF4136',
                backgroundColor: 'rgba(255, 65, 54, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.1)' } },
                x: { grid: { display: false } }
            }
        }
    });
    // Graphe Produits populaires
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    new Chart(productsCtx, {
        type: 'bar',
        data: {
            labels: produitsPopulairesLabels,
            datasets: [{
                label: 'Quantité vendue',
                data: produitsPopulairesData,
                backgroundColor: [
                    '#FF4136','#FF851B','#FFDC00','#2ECC40','#7FDBFF','#B10DC9','#FF69B4','#01FF70','#FFB347','#AAAAAA'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.1)' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection 