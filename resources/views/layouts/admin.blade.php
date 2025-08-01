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
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: white;
            border-right: 1px solid #e5e7eb;
            z-index: 40;
            transition: all 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar-nav-item {
            transition: all 0.2s ease-in-out;
            border-radius: 8px;
        }
        
        .sidebar-nav-item:hover {
            background-color: #f3f4f6;
        }
        
        .sidebar-nav-item.active {
            background-color: #dbeafe;
            color: #2563eb;
        }
        
        /* Topbar Styles */
        .topbar {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            z-index: 30;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .content-container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Card Styles */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
            
            .topbar {
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
            
            .topbar {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50" x-data="adminLayout()">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="flex flex-col h-full">
            <!-- Logo Section -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-recycle text-white text-sm"></i>
                    </div>
                    <span class="text-lg font-bold text-gray-900">Toko Daur Ulang</span>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg sidebar-nav-item hover:bg-gray-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-home text-lg"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('toko') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg sidebar-nav-item active">
                    <i class="fas fa-box text-lg"></i>
                    <span>Produk</span>
                </a>
                
                <a href="{{ route('orders') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg sidebar-nav-item hover:bg-gray-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span>Pesanan</span>
                </a>
                
                <a href="{{ route('customers') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg sidebar-nav-item hover:bg-gray-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-users text-lg"></i>
                    <span>Pelanggan</span>
                </a>
                
                <a href="{{ route('analytics') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg sidebar-nav-item hover:bg-gray-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-chart-line text-lg"></i>
                    <span>Analitik</span>
                </a>
                
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg sidebar-nav-item hover:bg-gray-50 hover:text-blue-600 transition-colors">
                    <i class="fas fa-cog text-lg"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
            
            <!-- User Profile -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <img src="https://via.placeholder.com/40x40/3b82f6/ffffff?text=A" alt="Admin" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Admin Toko</p>
                        <p class="text-xs text-gray-500">admin@tokodaurulang.com</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Topbar -->
    <div class="topbar">
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Button -->
            <button @click="toggleSidebar()" class="lg:hidden p-2 text-gray-600 hover:text-gray-900">
                <i class="fas fa-bars text-lg"></i>
            </button>
            
            <h1 class="text-xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="relative hidden md:block">
                <input type="text" placeholder="Cari produk, pesanan..." 
                       class="w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            
            <!-- Notifications -->
            <button @click="showNotifications = true" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                <i class="fas fa-bell text-lg"></i>
                <span class="notification-badge">3</span>
            </button>
            
            <!-- Admin Profile -->
            <div class="flex items-center space-x-3">
                <img src="https://via.placeholder.com/32x32/3b82f6/ffffff?text=A" alt="Admin" class="w-8 h-8 rounded-full">
                <span class="text-sm font-medium text-gray-900 hidden md:block">Admin</span>
                <i class="fas fa-chevron-down text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-container">
            @yield('content')
        </div>
    </main>

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
                showNotifications: false,
                
                toggleSidebar() {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.classList.toggle('mobile-open');
                },
                
                closeSidebar() {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.classList.remove('mobile-open');
                }
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html> 