<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BurgerDash')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('head')
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
        html, body { height: 100%; width: 100%; }
        body { 
            background-color: var(--gray-100); 
            min-height: 100vh; 
            min-width: 100vw;
            display: flex; 
            align-items: flex-start; 
            justify-content: flex-start;
            position: relative;
            overflow-x: hidden;
        }
        .sidebar { 
            width: 280px; 
            background: white; 
            border-right: 1px solid var(--gray-200); 
            display: flex; 
            flex-direction: column; 
            transition: all 0.3s; 
            position: fixed; 
            top: 0;
            left: 0;
            height: 100vh; 
            z-index: 50; 
            box-shadow: 0 0 0 0 transparent;
        }
        .sidebar-header { padding: 1.5rem; border-bottom: 1px solid var(--gray-200); display: flex; align-items: center; gap: 1rem; }
        .logo { width: 40px; height: 40px; }
        .brand { font-size: 1.25rem; font-weight: 600; color: var(--gray-900); }
        .nav-menu { padding: 1.5rem; flex: 1; }
        .nav-item { display: flex; align-items: center; padding: 0.75rem 1rem; color: var(--gray-700); text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.5rem; transition: all 0.2s; }
        .nav-item:hover { background-color: var(--gray-100); color: var(--primary); }
        .nav-item.active { background-color: var(--primary); color: white; }
        .nav-item i { width: 20px; margin-right: 0.75rem; }
        .main-content { 
            flex: 1; 
            margin-left: 280px; 
            padding: 2rem; 
            min-height: 100vh;
            width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 768px) { 
            .sidebar { transform: translateX(-100%); } 
            .sidebar.active { transform: translateX(0); } 
            .main-content { margin-left: 0; } 
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <svg class="logo" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" fill="#FF4136"/>
                <path d="M30 40 Q50 20 70 40 L70 65 Q50 85 30 65 Z" fill="#FFDC00"/>
                <circle cx="40" cy="45" r="5" fill="#2ECC40"/>
                <circle cx="60" cy="45" r="5" fill="#2ECC40"/>
            </svg>
            <span class="brand">BurgerDash</span>
        </div>
        <div class="nav-menu">
            <a href="{{ url('/dashboard') }}" class="nav-item @if(request()->is('dashboard')) active @endif">
                <i class="fas fa-chart-line"></i> Tableau de bord
            </a>
            <a href="{{ url('/kitchen') }}" class="nav-item @if(request()->is('kitchen')) active @endif">
                <i class="fas fa-utensils"></i> Cuisine
            </a>
            <a href="{{ url('/menu') }}" class="nav-item @if(request()->is('menu')) active @endif">
                <i class="fas fa-hamburger"></i> Menu
            </a>
            <a href="{{ url('/inventory') }}" class="nav-item @if(request()->is('inventory')) active @endif">
                <i class="fas fa-box"></i> Stock
            </a>
            <a href="{{ url('/employees') }}" class="nav-item @if(request()->is('employees')) active @endif">
                <i class="fas fa-users"></i> Employés
            </a>
            <a href="{{ url('/sales') }}" class="nav-item @if(request()->is('sales')) active @endif">
                <i class="fas fa-cash-register"></i> Ventes
            </a>
            <a href="{{ url('/reservations') }}" class="nav-item @if(request()->is('reservations')) active @endif">
                <i class="fas fa-calendar-alt"></i> Réservations
            </a>
        </div>
    </nav>
    <main class="main-content">
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html> 