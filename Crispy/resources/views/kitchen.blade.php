@extends('layout')
@section('title', 'Cuisine - BurgerDash')
@section('styles')
<style>
    /* ... CSS complet copié de kitchen.html ... */
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

    /* Stats */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
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

    /* Kanban Board */
    .kanban {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .kanban-column {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .kanban-column h2 {
        font-size: 1.25rem;
        color: var(--gray-800);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .kanban-column[data-status="pending"] h2 {
        color: var(--warning);
    }

    .kanban-column[data-status="preparing"] h2 {
        color: var(--primary);
    }

    .kanban-column[data-status="ready"] h2 {
        color: var(--success);
    }

    /* Order Cards */
    .order-card {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .order-number {
        font-weight: bold;
        color: var(--gray-800);
    }

    .order-time {
        font-size: 0.875rem;
        color: var(--gray-600);
    }

    .order-items {
        margin: 0.5rem 0;
        padding-left: 1rem;
    }

    .order-item {
        font-size: 0.875rem;
        color: var(--gray-700);
        margin-bottom: 0.25rem;
    }

    .order-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
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
        font-size: 0.875rem;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
    }

    .btn-success {
        background-color: var(--success);
        color: white;
    }

    .btn-success:hover {
        background-color: #2ab737;
    }

    .btn-warning {
        background-color: var(--warning);
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67700;
    }

    /* Timer Badge */
    .timer-badge {
        background-color: var(--gray-200);
        color: var(--gray-700);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .timer-badge.urgent {
        background-color: var(--danger);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }

        .kanban {
            grid-template-columns: 1fr;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }
    }

    /* Animations */
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .order-card {
        animation: slideIn 0.3s ease-out;
    }

    /* Sound Toggle */
    .sound-toggle {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        background: white;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        transition: all 0.2s;
    }

    .sound-toggle:hover {
        transform: scale(1.1);
    }

    .sound-toggle i {
        color: var(--primary);
        font-size: 1.25rem;
    }

    /* Modal Styles */
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
    <title>Cuisine - BurgerDash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="header">
        <h1>Cuisine</h1>
        <div class="actions">
            <button class="btn btn-primary">
                <i class="fas fa-sync-alt"></i>
                Actualiser
            </button>
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <h3>{{ $pendingCount }}</h3>
            <p>Commandes en attente</p>
        </div>
        <div class="stat-card">
            <h3>{{ $preparingCount }}</h3>
            <p>En préparation</p>
        </div>
        <div class="stat-card">
            <h3>{{ $completedToday }}</h3>
            <p>Complétées aujourd'hui</p>
        </div>
        <div class="stat-card">
            <h3>{{ $avgPrepTime }} min</h3>
            <p>Temps moyen de préparation</p>
        </div>
    </div>

    <div class="kanban">
        <!-- Colonne En Attente -->
        <div class="kanban-column" data-status="pending">
            <h2>
                <i class="fas fa-clock"></i>
                En Attente ({{ $pendingCount }})
            </h2>
            <div class="order-list">
                @foreach($pending as $order)
                <div class="order-card" draggable="true">
                    <div class="order-header">
                        <span class="order-number">#{{ $order->sale_id }}</span>
                        <span class="timer-badge">
                            <i class="fas fa-clock"></i>
                            2 min
                        </span>
                    </div>
                    <div class="order-items">
                        <div class="order-item">Commande à détailler</div>
                    </div>
                    <div class="order-actions">
                        <button class="btn btn-primary">Commencer</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Colonne En Préparation -->
        <div class="kanban-column" data-status="preparing">
            <h2>
                <i class="fas fa-fire"></i>
                En Préparation ({{ $preparingCount }})
            </h2>
            <div class="order-list">
                @foreach($preparing as $order)
                <div class="order-card" draggable="true">
                    <div class="order-header">
                        <span class="order-number">#{{ $order->sale_id }}</span>
                        <span class="timer-badge">
                            <i class="fas fa-clock"></i>
                            4 min
                        </span>
                    </div>
                    <div class="order-items">
                        <div class="order-item">Commande à détailler</div>
                    </div>
                    <div class="order-actions">
                        <button class="btn btn-success">Terminer</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Colonne Prêt -->
        <div class="kanban-column" data-status="ready">
            <h2>
                <i class="fas fa-check-circle"></i>
                Prêt ({{ $readyCount }})
            </h2>
            <div class="order-list">
                @foreach($ready as $order)
                <div class="order-card">
                    <div class="order-header">
                        <span class="order-number">#{{ $order->sale_id }}</span>
                        <span class="order-time">14:30</span>
                    </div>
                    <div class="order-items">
                        <div class="order-item">Commande à détailler</div>
                    </div>
                    <div class="order-actions">
                        <button class="btn btn-warning">Servir</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sound Toggle Button -->
    <button class="sound-toggle" id="soundToggle">
        <i class="fas fa-volume-up"></i>
    </button>

    <!-- Modal Ajout Commande Cuisine -->
    <div class="modal" id="addKitchenModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Ajouter une commande cuisine</h2>
                <button class="modal-close" onclick="closeModal('addKitchenModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('kitchen.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">ID Vente</label>
                    <input type="number" name="sale_id" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
            </form>
        </div>
    </div>
    <!-- Modal Édition Commande Cuisine -->
    <div class="modal" id="editKitchenModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="margin-bottom:0;">Modifier la commande cuisine</h2>
                <button class="modal-close" onclick="closeModal('editKitchenModal')">&times;</button>
            </div>
            <form method="POST" id="editKitchenForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="kitchen_id" id="edit_kitchen_id">
                <div class="form-group">
                    <label class="form-label">ID Vente</label>
                    <input type="number" name="sale_id" id="edit_sale_id" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <input type="text" name="status" id="edit_status" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" id="edit_notes" class="form-input"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
    </div>

    <script>
        // ... JS complet copié de kitchen.html ...
         // DOM Elements
         const orderCards = document.querySelectorAll('.order-card');
        const orderLists = document.querySelectorAll('.order-list');
        const soundToggle = document.getElementById('soundToggle');
        let soundEnabled = true;

        // Drag and Drop
        orderCards.forEach(card => {
            card.addEventListener('dragstart', handleDragStart);
            card.addEventListener('dragend', handleDragEnd);
        });

        orderLists.forEach(list => {
            list.addEventListener('dragover', handleDragOver);
            list.addEventListener('drop', handleDrop);
        });

        function handleDragStart(e) {
            this.style.opacity = '0.4';
            e.dataTransfer.setData('text/plain', this.innerHTML);
        }

        function handleDragEnd(e) {
            this.style.opacity = '1';
        }

        function handleDragOver(e) {
            e.preventDefault();
        }

        function handleDrop(e) {
            e.preventDefault();
            const data = e.dataTransfer.getData('text/plain');
            const newCard = document.createElement('div');
            newCard.className = 'order-card';
            newCard.setAttribute('draggable', true);
            newCard.innerHTML = data;
            this.appendChild(newCard);

            // Add drag listeners to new card
            newCard.addEventListener('dragstart', handleDragStart);
            newCard.addEventListener('dragend', handleDragEnd);

            // Update column counts
            updateColumnCounts();
            playSound('move');
        }

        // Sound Effects
        const sounds = {
            move: new Audio('data:audio/wav;base64,UklGRl9vT19...'), // Base64 encoded short sound
            newOrder: new Audio('data:audio/wav;base64,UklGRl9vT19...') // Base64 encoded notification sound
        };

        function playSound(soundName) {
            if (soundEnabled && sounds[soundName]) {
                sounds[soundName].play();
            }
        }

        // Toggle Sound
        soundToggle.addEventListener('click', () => {
            soundEnabled = !soundEnabled;
            const icon = soundToggle.querySelector('i');
            if (soundEnabled) {
                icon.className = 'fas fa-volume-up';
            } else {
                icon.className = 'fas fa-volume-mute';
            }
        });

        // Update column counts
        function updateColumnCounts() {
            document.querySelectorAll('.kanban-column').forEach(column => {
                const count = column.querySelectorAll('.order-card').length;
                const title = column.querySelector('h2');
                const status = column.dataset.status;
                title.innerHTML = `
                    <i class="fas fa-${getStatusIcon(status)}"></i>
                    ${getStatusText(status)} (${count})
                `;
            });
        }

        function getStatusIcon(status) {
            const icons = {
                pending: 'clock',
                preparing: 'fire',
                ready: 'check-circle'
            };
            return icons[status] || 'clock';
        }

        function getStatusText(status) {
            const texts = {
                pending: 'En Attente',
                preparing: 'En Préparation',
                ready: 'Prêt'
            };
            return texts[status] || 'En Attente';
        }

        // Action Buttons
        document.addEventListener('click', (e) => {
            if (e.target.matches('.btn')) {
                const card = e.target.closest('.order-card');
                const currentColumn = card.closest('.kanban-column');
                const nextColumn = currentColumn.nextElementSibling;

                if (nextColumn) {
                    nextColumn.querySelector('.order-list').appendChild(card);
                    updateColumnCounts();
                    playSound('move');
                } else if (currentColumn.dataset.status === 'ready') {
                    card.remove();
                    updateColumnCounts();
                    playSound('move');
                }
            }
        });

        // Timer Updates
        setInterval(() => {
            document.querySelectorAll('.timer-badge').forEach(timer => {
                const timeText = timer.textContent.trim();
                const minutes = parseInt(timeText);
                if (!isNaN(minutes) && minutes >= 5) {
                    timer.classList.add('urgent');
                }
            });
        }, 60000);

        // Initial column count update
        updateColumnCounts();
    </script>
</body>
</html>
@endsection
@section('scripts')
<script>
    // Mets ici tout le JS de la page kitchen
</script>
@endsection 