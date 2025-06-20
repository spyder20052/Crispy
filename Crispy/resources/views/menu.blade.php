@extends('layout')

@section('title', 'Gestion du Menu - BurgerDash')

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
        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .menu-item {
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .menu-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .menu-item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .menu-item-content {
            padding: 1rem;
        }
        .menu-item-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 0.5rem;
        }
        .menu-item-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
        }
        .menu-item-price {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--primary);
        }
        .menu-item-description {
            color: var(--gray-600);
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
        .menu-item-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
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
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-900);
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
        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
        }
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
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
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--gray-300);
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: var(--success);
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            .menu-grid {
                grid-template-columns: 1fr;
            }
            .filters {
                flex-direction: column;
            }
            .filter-group {
                width: 100%;
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .menu-item {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
@endsection

@section('content')
    <div class="header">
        <h1>Gestion du Menu</h1>
        <button class="btn btn-primary" id="addItemBtn">
            <i class="fas fa-plus"></i>
            Ajouter un plat
        </button>
    </div>
    <div class="filters">
        <div class="filter-group">
            <label for="category" class="form-label">Catégorie:</label>
            <select id="category" class="form-select">
                <option value="">Toutes</option>
                <option value="burgers">Burgers</option>
                <option value="sides">Accompagnements</option>
                <option value="drinks">Boissons</option>
                <option value="desserts">Desserts</option>
            </select>
        </div>
        <div class="filter-group">
            <label for="status" class="form-label">Statut:</label>
            <select id="status" class="form-select">
                <option value="">Tous</option>
                <option value="available">Disponible</option>
                <option value="unavailable">Indisponible</option>
            </select>
        </div>
        <div class="filter-group">
            <label for="search" class="form-label">Rechercher:</label>
            <input type="text" id="search" class="form-input" placeholder="Nom du plat...">
        </div>
    </div>
    <div class="menu-grid">
        @foreach($menus as $menu)
        <div class="menu-item" data-category="{{ $menu->category }}">
            <img src="{{ $menu->image ?? 'https://via.placeholder.com/300x200?text=Image' }}" class="menu-item-image" alt="{{ $menu->name }}">
            <div class="menu-item-content">
                <div class="menu-item-header">
                    <h3 class="menu-item-title">{{ $menu->name }}</h3>
                    <span class="menu-item-price">{{ number_format($menu->price, 2, ',', ' ') }} €</span>
                </div>
                <p class="menu-item-description">{{ $menu->description }}</p>
                <div class="menu-item-footer">
                    <span class="badge {{ $menu->available ? 'badge-success' : 'badge-danger' }}">{{ $menu->available ? 'Disponible' : 'Indisponible' }}</span>
                    <div class="actions">
                        <button class="btn btn-outline edit-btn">
                            <i class="fas fa-edit"></i>
                        </button>
                        <label class="switch">
                            <input type="checkbox" {{ $menu->available ? 'checked' : '' }} disabled>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Modal Ajout/Édition -->
    <div class="modal" id="itemModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Ajouter un plat</h2>
                <button class="modal-close">&times;</button>
            </div>
            <form id="itemForm">
                <div class="form-group">
                    <label for="itemName" class="form-label">Nom du plat</label>
                    <input type="text" id="itemName" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="itemCategory" class="form-label">Catégorie</label>
                    <select id="itemCategory" class="form-select" required>
                        <option value="burgers">Burgers</option>
                        <option value="sides">Accompagnements</option>
                        <option value="drinks">Boissons</option>
                        <option value="desserts">Desserts</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="itemPrice" class="form-label">Prix (€)</label>
                    <input type="number" id="itemPrice" class="form-input" step="0.10" required>
                </div>
                <div class="form-group">
                    <label for="itemDescription" class="form-label">Description</label>
                    <textarea id="itemDescription" class="form-textarea" required></textarea>
                </div>
                <div class="form-group">
                    <label for="itemImage" class="form-label">Image</label>
                    <input type="file" id="itemImage" class="form-input" accept="image/*">
                </div>
                <div class="form-group">
                    <label class="form-label">Disponibilité</label>
                    <label class="switch">
                        <input type="checkbox" id="itemAvailability" checked>
                        <span class="slider"></span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // DOM Elements
        const addItemBtn = document.getElementById('addItemBtn');
        const modal = document.getElementById('itemModal');
        const modalClose = modal.querySelector('.modal-close');
        const itemForm = document.getElementById('itemForm');
        const menuGrid = document.querySelector('.menu-grid');
        const searchInput = document.getElementById('search');
        const categorySelect = document.getElementById('category');
        const statusSelect = document.getElementById('status');
        // Toggle Modal
        function toggleModal() {
            modal.classList.toggle('active');
        }
        addItemBtn.addEventListener('click', toggleModal);
        modalClose.addEventListener('click', toggleModal);
        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) toggleModal();
        });
        // Handle Form Submit
        itemForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Collect form data
            const formData = new FormData();
            formData.append('name', document.getElementById('itemName').value);
            formData.append('category', document.getElementById('itemCategory').value);
            formData.append('price', document.getElementById('itemPrice').value);
            formData.append('description', document.getElementById('itemDescription').value);
            formData.append('available', document.getElementById('itemAvailability').checked ? 1 : 0);

            // Handle image file input
            const imageInput = document.getElementById('itemImage');
            if (imageInput.files.length > 0) {
                formData.append('image', imageInput.files[0]);
            } else {
                formData.append('image', '');
            }

            // Send AJAX request
            fetch('{{ route("menu.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de l\'ajout du plat');
                }
                return response.json();
            })
            .then(data => {
                const menu = data.menu;

                // Create new menu item element
                const div = document.createElement('div');
                div.classList.add('menu-item');
                div.dataset.category = menu.category;

                const imageUrl = menu.image ? URL.createObjectURL(imageInput.files[0]) : 'https://via.placeholder.com/300x200?text=Image';

                div.innerHTML = `
                    <img src="${imageUrl}" class="menu-item-image" alt="${menu.name}">
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-title">${menu.name}</h3>
                            <span class="menu-item-price">${parseFloat(menu.price).toFixed(2).replace('.', ',')} €</span>
                        </div>
                        <p class="menu-item-description">${menu.description}</p>
                        <div class="menu-item-footer">
                            <span class="badge ${menu.available ? 'badge-success' : 'badge-danger'}">${menu.available ? 'Disponible' : 'Indisponible'}</span>
                            <div class="actions">
                                <button class="btn btn-outline edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <label class="switch">
                                    <input type="checkbox" ${menu.available ? 'checked' : ''} disabled>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                `;

                // Append new item to menu grid
                menuGrid.appendChild(div);

                // Reset form and close modal
                itemForm.reset();
                toggleModal();
            })
            .catch(error => {
                alert(error.message);
            });
        });
        // Filter items
        function filterItems() {
            const searchTerm = searchInput.value.toLowerCase();
            const category = categorySelect.value;
            const status = statusSelect.value;
            document.querySelectorAll('.menu-item').forEach(item => {
                const title = item.querySelector('.menu-item-title').textContent.toLowerCase();
                const itemCategory = item.dataset.category;
                const isAvailable = item.querySelector('input[type="checkbox"]').checked;
                const matchesSearch = title.includes(searchTerm);
                const matchesCategory = !category || itemCategory === category;
                const matchesStatus = !status || (status === 'available' && isAvailable) || (status === 'unavailable' && !isAvailable);
                item.style.display = matchesSearch && matchesCategory && matchesStatus ? 'block' : 'none';
            });
        }
        searchInput.addEventListener('input', filterItems);
        categorySelect.addEventListener('change', filterItems);
        statusSelect.addEventListener('change', filterItems);
        // Toggle item availability
        document.querySelectorAll('.switch input').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const menuItem = this.closest('.menu-item');
                const badge = menuItem.querySelector('.badge');
                if (this.checked) {
                    badge.className = 'badge badge-success';
                    badge.textContent = 'Disponible';
                } else {
                    badge.className = 'badge badge-danger';
                    badge.textContent = 'Indisponible';
                }
            });
        });
        // Edit item
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const menuItem = this.closest('.menu-item');
                // Populate form with item data
                document.getElementById('itemName').value = menuItem.querySelector('.menu-item-title').textContent;
                document.getElementById('itemPrice').value = menuItem.querySelector('.menu-item-price').textContent.replace('€', '').trim();
                document.getElementById('itemDescription').value = menuItem.querySelector('.menu-item-description').textContent;
                document.getElementById('itemAvailability').checked = menuItem.querySelector('.badge').classList.contains('badge-success');
                document.querySelector('.modal-title').textContent = 'Modifier le plat';
                toggleModal();
            });
        });
        // Preview image before upload
        document.getElementById('itemImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Preview logic here
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection 