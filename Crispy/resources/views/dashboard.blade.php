@extends('layout')
@section('title', 'Tableau de bord - BurgerDash')
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
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    body {
        background-color: var(--gray-100);
        min-height: 100vh;
        display: flex;
    }

    /* Sidebar */
    .sidebar {
        width: 280px;
        background: white;
        border-right: 1px solid var(--gray-200);
        display: flex;
        flex-direction: column;
        transition: all 0.3s;
        position: fixed;
        height: 100vh;
        z-index: 50;
    }

    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo {
        width: 40px;
        height: 40px;
    }

    .brand {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-900);
    }

    .nav-menu {
        padding: 1.5rem;
        flex: 1;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: var(--gray-700);
        text-decoration: none;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.2s;
    }

    .nav-item:hover {
        background-color: var(--gray-100);
        color: var(--primary);
    }

    .nav-item.active {
        background-color: var(--primary);
        color: white;
    }

    .nav-item i {
        width: 20px;
        margin-right: 0.75rem;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 140px !important;
        margin-top: 30px !important;
        padding: 0.5rem;
    }

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

    .header-actions {
        display: flex;
        gap: 1rem;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)) !important;
        gap: 0.7rem !important;
        margin-bottom: 1rem !important;
    }

    .stat-card {
        padding: 0.7rem !important;
        min-width: 0 !important;
        max-width: 100% !important;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    }

    .stat-card h3 {
        font-size: 2rem;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    .stat-icon {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 2rem;
        opacity: 0.1;
        color: var(--primary);
    }

    /* Charts Grid */
    .charts-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)) !important;
        gap: 0.7rem !important;
        margin-bottom: 1rem !important;
    }

    .chart-card {
        padding: 0.7rem !important;
        min-width: 0 !important;
        max-width: 100% !important;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0,0 0, 0.1);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .chart-title {
        font-size: 1.25rem;
        color: var(--gray-800);
        font-weight: 600;
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    /* Quick Actions */
    .quick-actions {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(110px, 1fr)) !important;
        gap: 0.5rem !important;
        margin-bottom: 1rem !important;
    }

    .action-card {
        padding: 0.7rem !important;
        min-width: 0 !important;
        max-width: 100% !important;
        background: white;
        border-radius: 0.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        border: 1px solid var(--gray-200);
    }

    .action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-color: var(--primary);
    }

    .action-icon {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .action-title {
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 0.5rem;
    }

    .action-description {
        font-size: 0.875rem;
        color: var(--gray-600);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            width: 180px;
            transform: translateX(-100%);
        }
        .sidebar.active {
            transform: translateX(0);
        }
        .main-content {
            margin-left: 0;
            padding: 0.2rem;
        }
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    /* Toggle Button */
    .toggle-sidebar {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--gray-700);
        cursor: pointer;
        padding: 0.5rem;
    }

    @media (max-width: 768px) {
        .toggle-sidebar {
            display: block;
        }
    }
</style>
@endsection
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - BurgerDash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <main class="main-content">
        <div class="header">
            <button class="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Tableau de bord</h1>
            <div class="header-actions">
                <div style="position: relative;">
                    <i class="fas fa-bell" style="font-size: 1.25rem; color: var(--gray-600); cursor: pointer;"></i>
                    <span style="position: absolute; top: -5px; right: -5px; background: var(--primary); color: white; border-radius: 50%; width: 16px; height: 16px; font-size: 0.75rem; display: flex; align-items: center; justify-content: center;">3</span>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card animate-fade-in">
                <i class="fas fa-euro-sign stat-icon"></i>
                <h3>{{ number_format($salesToday, 2, ',', ' ') }} €</h3>
                <p>Chiffre d'affaires (aujourd'hui)</p>
            </div>
            <div class="stat-card animate-fade-in">
                <i class="fas fa-shopping-bag stat-icon"></i>
                <h3>{{ $ordersToday }}</h3>
                <p>Commandes (aujourd'hui)</p>
            </div>
            <div class="stat-card animate-fade-in">
                <i class="fas fa-users stat-icon"></i>
                <h3>{{ $clientsActifs }}</h3>
                <p>Clients actifs</p>
            </div>
            <div class="stat-card animate-fade-in">
                <i class="fas fa-box stat-icon"></i>
                <h3>{{ $alertesStock }}</h3>
                <p>Alertes stock</p>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-card animate-fade-in">
                <div class="chart-header">
                    <h3 class="chart-title">Ventes horaires</h3>
                    <select class="form-select" id="selectVentesHoraires">
                        <option value="today">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <div class="chart-card animate-fade-in">
                <div class="chart-header">
                    <h3 class="chart-title">Produits populaires</h3>
                    <select class="form-select" id="selectProduitsPopulaires">
                        <option value="top5">Top 5</option>
                        <option value="top10">Top 10</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="quick-actions">
            <div class="action-card animate-fade-in">
                <i class="fas fa-utensils action-icon"></i>
                <h3 class="action-title">Vue cuisine</h3>
                <p class="action-description">{{ $commandesCuisine }} commandes en attente</p>
            </div>
            <div class="action-card animate-fade-in">
                <i class="fas fa-box action-icon"></i>
                <h3 class="action-title">Stock</h3>
                <p class="action-description">{{ $produitsACommander }} produits à commander</p>
            </div>
            <div class="action-card animate-fade-in">
                <i class="fas fa-calendar-alt action-icon"></i>
                <h3 class="action-title">Réservations</h3>
                <p class="action-description">{{ $reservationsJour }} réservations aujourd'hui</p>
            </div>
            <div class="action-card animate-fade-in">
                <i class="fas fa-users action-icon"></i>
                <h3 class="action-title">Employés</h3>
                <p class="action-description">{{ $employesService }} employés en service</p>
            </div>
        </div>
    </main>

    <script>
         // Toggle Sidebar
         document.querySelector('.toggle-sidebar').addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
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

        // Products Chart
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

        // Quick Actions
        document.querySelectorAll('.action-card').forEach(card => {
            card.addEventListener('click', () => {
                const title = card.querySelector('.action-title').textContent.toLowerCase();
                switch(title) {
                    case 'vue cuisine':
                        window.location.href = '/kitchen';
                        break;
                    case 'stock':
                        window.location.href = '/inventory';
                        break;
                    case 'réservations':
                        window.location.href = '/reservations';
                        break;
                    case 'employés':
                        window.location.href = '/employees';
                        break;
                }
            });
        });
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
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
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