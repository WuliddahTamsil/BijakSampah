<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Toko Daur Ulang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html, body { 
            overflow-x: hidden; 
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }
        
        /* Sidebar Styles - Consistent with settings */
        .sidebar-gradient {
            background: linear-gradient(135deg, #75E6DA 0%, #05445E 63%);
        }
        .sidebar-hover { 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .sidebar-item-hover { 
            transition: all 0.2s ease-in-out; 
        }
        .sidebar-item-hover:hover { 
            background-color: rgba(255, 255, 255, 0.2); 
        }
        .sidebar-logo { 
            transition: all 0.3s ease-in-out; 
        }
        .sidebar-nav-item { 
            transition: all 0.2s ease-in-out; 
            border-radius: 8px; 
        }
        .sidebar-nav-item:hover { 
            background-color: rgba(255, 255, 255, 0.1); 
        }
        .sidebar-nav-item.active { 
            background-color: rgba(255, 255, 255, 0.2); 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        }
        
        /* Topbar Styles - Consistent with settings */
        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 48px;
            z-index: 40;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-right: 1.5rem;
            background: linear-gradient(135deg, #75E6DA 0%, #05445E 63%);
            transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            margin-top: 48px;
            min-height: calc(100vh - 48px);
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .content-container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Card Styles - Consistent with settings */
        .admin-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .admin-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Button Styles */
        .btn-primary {
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            background: #2563eb;
        }
        
        .btn-success {
            background: #10b981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-success:hover {
            background: #059669;
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-warning:hover {
            background: #d97706;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-danger:hover {
            background: #dc2626;
        }
        
        /* Status Badge Styles */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-active { 
            background: #dcfce7; 
            color: #166534; 
        }
        
        .status-inactive { 
            background: #fee2e2; 
            color: #991b1b; 
        }
        
        .status-pending { 
            background: #fef3c7; 
            color: #92400e; 
        }
        
        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .modal-overlay.active .modal-content {
            transform: scale(1);
        }
        
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #f3f4f6;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .modal-close:hover {
            background: #e5e7eb;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .fixed-header {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        
        @media (max-width: 768px) {
            .content-container {
                padding: 1rem;
            }
            
            .fixed-header {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50" x-data="adminLayout()">
    <!-- Sidebar -->
    <aside
        x-data="{ open: false, active: 'toko' }"
        x-ref="sidebar"
        @mouseenter="open = true; $root.sidebarOpen = true"
        @mouseleave="open = false; $root.sidebarOpen = false"
        class="fixed top-0 left-0 z-20 flex flex-col py-6 sidebar-hover overflow-hidden shadow-2xl group sidebar-gradient"
        :class="open ? 'w-64' : 'w-16'"
        style="transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); margin-top: 48px; height: calc(100vh - 48px);"
    >
        <div class="relative flex flex-col h-full w-full px-4">
            <!-- Logo Section -->
            <div class="flex items-center justify-center mb-8 mt-2 sidebar-logo">
                <img x-show="open" class="w-16 h-auto" src="{{ asset('asset/img/logo.png') }}" alt="Logo Penuh">
                <img x-show="!open" class="w-6 h-6" src="{{ asset('asset/img/logo.png') }}" alt="Logo Ikon">
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex flex-col gap-2 w-full flex-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 font-medium sidebar-nav-item whitespace-nowrap w-full" :class="open ? (active === 'dashboard' ? 'active text-white' : 'text-white') : (active === 'dashboard' ? 'active text-white justify-center' : 'text-white justify-center')">
                    <i class="fas fa-home text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('toko') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'toko' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'toko' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-box text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Produk</span>
                </a>
                
                <a href="{{ route('catalog') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'catalog' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'catalog' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-store text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Katalog</span>
                </a>
                
                <a href="{{ route('orders') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'orders' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'orders' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Pesanan</span>
                </a>
                
                <a href="{{ route('customers') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'customers' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'customers' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-users text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Pelanggan</span>
                </a>
                
                <a href="{{ route('analytics') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'analytics' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'analytics' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-chart-line text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Analitik</span>
                </a>
                
                <a href="{{ route('settings') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'settings' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'settings' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-cog text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Pengaturan</span>
                </a>
            </nav>
            
            <!-- User Profile -->
            <div class="w-full flex items-center py-3 mt-auto">
                <div class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover text-white hover:text-red-300 transition-all duration-200 w-full whitespace-nowrap" :class="open ? 'hover:bg-white/20 text-white' : 'hover:bg-white/20 text-white justify-center'">
                    <img src="https://via.placeholder.com/32x32/ffffff/3b82f6?text=A" alt="Admin" class="w-8 h-8 rounded-full">
                    <div x-show="open">
                        <p class="text-sm font-medium">Admin Toko</p>
                        <p class="text-xs opacity-75">admin@tokodaurulang.com</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 min-h-screen" style="background-color: #f8fafc;" :style="'padding-left:' + (sidebarOpen ? '16rem' : '4rem') + '; transition: padding-left 0.3s cubic-bezier(0.4,0,0.2,1);'">
        <!-- Topbar -->
        <div class="fixed-header" :style="'padding-left:' + (sidebarOpen ? '16rem' : '4rem') + ';'">
            <h1 class="text-white font-semibold text-lg">@yield('page-title', 'Admin Panel')</h1>
            <div class="flex items-center gap-4">
                <button @click="showNotifications = true" class="relative">
                    <i class="far fa-bell text-white text-sm"></i>
                    <span class="notification-badge">3</span>
                </button>
                <button class="focus:outline-none">
                    <i class="fas fa-search text-white text-sm"></i>
                </button>
                <div class="flex items-center gap-2">
                    <img src="https://via.placeholder.com/32x32/ffffff/3b82f6?text=A" alt="Admin" class="w-8 h-8 rounded-full">
                    <i class="fas fa-chevron-down text-white text-xs"></i>
                </div>
            </div>
        </div>

        <!-- Content Container -->
        <div class="p-8 w-full" style="padding-top: 60px;">
            @yield('content')
        </div>
    </div>

    <!-- Notifications Modal -->
    <div class="modal-overlay" :class="{ 'active': showNotifications }" @click.away="showNotifications = false">
        <div class="modal-content">
            <button @click="showNotifications = false" class="modal-close">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-900">Notifikasi</h3>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Pesanan baru diterima</p>
                        <p class="text-xs text-gray-600 mt-1">2 menit yang lalu</p>
                    </div>
                </div>
                
                <div class="flex items-start p-4 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Pembayaran berhasil</p>
                        <p class="text-xs text-gray-600 mt-1">5 menit yang lalu</p>
                    </div>
                </div>
                
                <div class="flex items-start p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Stok produk menipis</p>
                        <p class="text-xs text-gray-600 mt-1">10 menit yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function adminLayout() {
            return {
                sidebarOpen: false,
                showNotifications: false,
                
                toggleSidebar() {
                    const sidebar = document.querySelector('aside');
                    sidebar.classList.toggle('mobile-open');
                },
                
                closeSidebar() {
                    const sidebar = document.querySelector('aside');
                    sidebar.classList.remove('mobile-open');
                }
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html> 