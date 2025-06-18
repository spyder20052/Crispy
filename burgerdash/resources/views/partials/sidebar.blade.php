<div class="sidebar w-64 bg-white shadow-xl flex flex-col transition-all duration-300 z-20 border-r border-gray-200">
    <div class="p-5 border-b border-gray-200">
        <div class="flex items-center">
            <div class="bg-secondary-500 w-10 h-10 rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-hamburger text-primary-500 text-xl"></i>
            </div>
            <h1 class="text-xl font-bold ml-3 text-gray-800">BurgerDash<span class="text-primary-500">Pro</span></h1>
        </div>
    </div>
    <div class="flex-1 overflow-y-auto py-4 scrollbar-hide">
        <nav class="space-y-1 px-3">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="dashboard">
                <i class="fas fa-chart-line text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Dashboard</span>
            </a>
            <a href="{{ route('orders') }}" class="nav-item {{ request()->routeIs('orders') ? 'active' : '' }} flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="orders">
                <i class="fas fa-list-alt text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Commandes</span>
                <span class="ml-auto notification-badge bg-danger text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">5</span>
            </a>
            <a href="{{ route('menu') }}" class="nav-item {{ request()->routeIs('menu') ? 'active' : '' }} flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="menu">
                <i class="fas fa-utensils text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Menu</span>
            </a>
            <a href="{{ route('loyalty') }}" class="nav-item {{ request()->routeIs('loyalty') ? 'active' : '' }} flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="loyalty">
                <i class="fas fa-crown text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Fidélité</span>
            </a>
            <a href="{{ route('sales') }}" class="nav-item {{ request()->routeIs('sales') ? 'active' : '' }} flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="sales">
                <i class="fas fa-cash-register text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Ventes</span>
            </a>
            <a href="{{ route('employees') }}" class="nav-item {{ request()->routeIs('employees') ? 'active' : '' }} flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="employees">
                <i class="fas fa-users text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Employés</span>
            </a>
            <a href="{{ route('stock') }}" class="nav-item {{ request()->routeIs('stock') ? 'active' : '' }} flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="inventory">
                <i class="fas fa-warehouse text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Stock</span>
                <span class="ml-auto notification-badge bg-warning text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">3</span>
            </a>
            <a href="#" class="nav-item flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100" data-target="reservations">
                <i class="fas fa-calendar-alt text-lg w-6 text-primary-500"></i>
                <span class="ml-3 font-medium">Réservations</span>
            </a>
        </nav>
    </div>
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-accent-500 flex items-center justify-center shadow-md">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'Admin User' }}</p>
                    <p class="text-xs text-gray-500">Administrateur</p>
                </div>
            </div>
            <button id="dark-mode-toggle" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 shadow-sm transition-colors duration-300">
                <i class="fas fa-moon text-gray-700"></i>
            </button>
        </div>
    </div>
</div> 