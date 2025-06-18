<header class="header bg-white border-b border-gray-200 p-4 flex items-center justify-between shadow-sm">
    <div class="flex items-center">
        <button id="sidebar-toggle" class="mr-4 text-gray-600 focus:outline-none hover:text-primary-500 transition-colors duration-300">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">@yield('header_title', 'Tableau de bord')</h2>
    </div>
    <div class="flex items-center space-x-4">
        <div class="relative">
            <button class="p-2 rounded-full hover:bg-gray-100 transition-colors duration-300 relative">
                <i class="fas fa-bell text-gray-600 hover:text-primary-500"></i>
                <span class="notification-badge bg-danger text-white rounded-full w-5 h-5 flex items-center justify-center text-xs absolute -top-1 -right-1">3</span>
            </button>
        </div>
        <div class="relative">
            <button class="p-2 rounded-full hover:bg-gray-100 transition-colors duration-300">
                <i class="fas fa-cog text-gray-600 hover:text-primary-500"></i>
            </button>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="p-2 rounded-full hover:bg-gray-100 transition-colors duration-300">
                <i class="fas fa-sign-out-alt text-gray-600 hover:text-primary-500"></i>
            </button>
        </form>
    </div>
</header> 