@extends('layouts.app')

@section('content')
<style>
    html, body {
        overflow-x: hidden;
    }
    .sidebar-gradient {
        background: var(--sidebar-gradient);
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
    .toko-card {
        background: var(--bg-primary) !important;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-primary) !important;
        color: var(--text-primary) !important;
    }
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
        background: var(--sidebar-gradient) !important;
        transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Dark theme overrides for toko page */
    .dark .text-gray-900 { color: var(--text-primary) !important; }
    .dark .text-gray-600 { color: var(--text-secondary) !important; }
    .dark .text-gray-500 { color: var(--text-muted) !important; }
    .dark .border-gray-100 { border-color: var(--border-primary) !important; }
    .dark .border-gray-300 { border-color: var(--border-secondary) !important; }
    .dark .bg-gray-50 { background-color: var(--bg-secondary) !important; }
    .dark .bg-white { background-color: var(--bg-primary) !important; }
    
    /* Ensure all text elements use theme colors */
    .text-gray-900 { color: var(--text-primary) !important; }
    .text-gray-600 { color: var(--text-secondary) !important; }
    .text-gray-500 { color: var(--text-muted) !important; }
    .border-gray-100 { border-color: var(--border-primary) !important; }
    .border-gray-300 { border-color: var(--border-secondary) !important; }
    .bg-gray-50 { background-color: var(--bg-secondary) !important; }
    .bg-white { background-color: var(--bg-primary) !important; }
    
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
    
    .status-pending { 
        background: #fef3c7; 
        color: #92400e; 
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
</style>

<div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="tokoApp()" x-init="init()">
    {{-- Sidebar --}}
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
            {{-- Logo Section --}}
            <div class="flex items-center justify-center mb-8 mt-2 sidebar-logo">
                <img x-show="open" class="w-16 h-auto" src="{{ asset('asset/img/logo.png') }}" alt="Logo Penuh">
                <img x-show="!open" class="w-6 h-6" src="{{ asset('asset/img/logo.png') }}" alt="Logo Ikon">
            </div>
            
            {{-- Navigation Menu --}}
            <nav class="flex flex-col gap-2 w-full flex-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 font-medium sidebar-nav-item whitespace-nowrap w-full" :class="open ? (active === 'dashboard' ? 'active text-white' : 'text-white') : (active === 'dashboard' ? 'active text-white justify-center' : 'text-white justify-center')">
                    <i class="fas fa-home text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('bank-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'bank-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'bank-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-tachometer-alt text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Bank Sampah</span>
                </a>
                
                <a href="{{ route('toko') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'toko' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'toko' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-store text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Toko</span>
                </a>
                
                <a href="{{ route('komunitas') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'komunitas' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'komunitas' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-users text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Komunitas</span>
                </a>
                
                <a href="{{ route('berita') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'berita' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'berita' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-newspaper text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Berita</span>
                </a>
                
                <a href="{{ route('keuangan') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'keuangan' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'keuangan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-file-invoice-dollar text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Keuangan</span>
                </a>
                
                <a href="{{ route('chat') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'chat' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'pesan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-comment-dots text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Pesan</span>
                </a>
                
                <a href="{{ route('feedback') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'feedback' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'umpan-balik' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-info-circle text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Umpan Balik</span>
                </a>
                
                <a href="{{ route('settings') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'settings' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'settings' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-cog text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Settings</span>
                </a>
            </nav>
            
            {{-- Logout Section --}}
            <div class="w-full flex items-center py-3 mt-auto">
                <a href="{{ route('logout') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover text-white hover:text-red-300 transition-all duration-200 w-full whitespace-nowrap" :class="open ? (active === 'logout' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'logout' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Logout</span>
                </a>
            </div>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 min-h-screen" style="background-color: var(--bg-primary);" :style="'padding-left:' + (sidebarOpen ? '16rem' : '4rem') + '; transition: padding-left 0.3s cubic-bezier(0.4,0,0.2,1);'">
        {{-- Top Header Bar --}}
        <div class="fixed-header" :style="'padding-left:' + (sidebarOpen ? '16rem' : '4rem') + ';'">
            <h1 class="text-white font-semibold text-lg">Kelola Produk</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('notifikasi') }}" class="relative">
                    <i class="far fa-bell text-white text-sm"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center font-medium">2</span>
                </a>
                <button class="focus:outline-none">
                    <i class="fas fa-search text-white text-sm"></i>
                </button>
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile') }}" class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center border-2 border-gray-300">
                        <img src="{{ asset('asset/img/user_profile.jpg') }}" alt="Profile" class="w-full h-full object-cover">
                    </a>
                    <i class="fas fa-chevron-down text-white text-xs"></i>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="p-8 w-full" style="padding-top: 60px;">
            <div x-data="productApp()">
                <!-- Header Section -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Dashboard Toko</h1>
                            <p class="text-gray-600 mt-2">Kelola produk, pesanan, dan analitik toko Anda</p>
                        </div>
                        <div class="flex gap-3">
                            <button @click="showAddProduct = true" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>Tambah Produk
                            </button>
                            <button @click="exportData()" class="btn-success">
                                <i class="fas fa-download mr-2"></i>Export Data
                            </button>
                            <button @click="showAnalytics = true" class="btn-warning">
                                <i class="fas fa-chart-bar mr-2"></i>Analitik
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="toko-card relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-blue-100 rounded-full -mr-10 -mt-10 opacity-20"></div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Produk</p>
                                <p class="text-3xl font-bold text-gray-900">247</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-green-600 flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>+12%
                                    </span>
                                    <span class="text-xs text-gray-500 ml-2">dari bulan lalu</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-box text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="toko-card relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -mr-10 -mt-10 opacity-20"></div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pesanan Hari Ini</p>
                                <p class="text-3xl font-bold text-gray-900">89</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-green-600 flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>+8%
                                    </span>
                                    <span class="text-xs text-gray-500 ml-2">dari kemarin</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-shopping-cart text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="toko-card relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-100 rounded-full -mr-10 -mt-10 opacity-20"></div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pendapatan Bulan Ini</p>
                                <p class="text-3xl font-bold text-gray-900">Rp 12.5M</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-green-600 flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>+15%
                                    </span>
                                    <span class="text-xs text-gray-500 ml-2">dari bulan lalu</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-dollar-sign text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="toko-card relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-purple-100 rounded-full -mr-10 -mt-10 opacity-20"></div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pelanggan Aktif</p>
                                <p class="text-3xl font-bold text-gray-900">1,247</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-green-600 flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>+23%
                                    </span>
                                    <span class="text-xs text-gray-500 ml-2">dari bulan lalu</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Quick Actions -->
                    <div class="toko-card">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <button @click="showAddProduct = true" class="w-full flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                <i class="fas fa-plus text-blue-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-900">Tambah Produk Baru</span>
                            </button>
                            <button @click="showBulkUpload = true" class="w-full flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                                <i class="fas fa-upload text-green-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-900">Upload Massal</span>
                            </button>
                            <button @click="showInventory = true" class="w-full flex items-center p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition-colors">
                                <i class="fas fa-boxes text-yellow-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-900">Kelola Stok</span>
                            </button>
                            <button @click="showReports = true" class="w-full flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                                <i class="fas fa-chart-line text-purple-600 mr-3"></i>
                                <span class="text-sm font-medium text-gray-900">Laporan Penjualan</span>
                            </button>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="toko-card">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pesanan Terbaru</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-green-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">#ORD-001</p>
                                        <p class="text-xs text-gray-500">2 menit yang lalu</p>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-green-600">Rp 45.000</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-blue-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">#ORD-002</p>
                                        <p class="text-xs text-gray-500">5 menit yang lalu</p>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-blue-600">Rp 32.000</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-shipping-fast text-yellow-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">#ORD-003</p>
                                        <p class="text-xs text-gray-500">10 menit yang lalu</p>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-yellow-600">Rp 78.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Top Products -->
                    <div class="toko-card">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Produk Terlaris</h3>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=40&q=80" 
                                     alt="Tas Kreasi" class="w-10 h-10 rounded-lg object-cover mr-3">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Tas Kreasi Daur Ulang</p>
                                    <p class="text-xs text-gray-500">156 terjual</p>
                                </div>
                                <span class="text-sm font-medium text-green-600">Rp 20.000</span>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=40&q=80" 
                                     alt="Botol Plastik" class="w-10 h-10 rounded-lg object-cover mr-3">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Botol Plastik Daur Ulang</p>
                                    <p class="text-xs text-gray-500">89 terjual</p>
                                </div>
                                <span class="text-sm font-medium text-green-600">Rp 15.000</span>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=40&q=80" 
                                     alt="Kertas Bekas" class="w-10 h-10 rounded-lg object-cover mr-3">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Kertas Bekas Premium</p>
                                    <p class="text-xs text-gray-500">67 terjual</p>
                                </div>
                                <span class="text-sm font-medium text-green-600">Rp 25.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Products Section -->
                <div class="toko-card">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Daftar Produk</h2>
                                <p class="text-sm text-gray-600">Kelola semua produk toko Anda</p>
                            </div>
                            <div class="flex gap-3">
                                <div class="relative">
                                    <input type="text" placeholder="Cari produk..." 
                                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Semua Kategori</option>
                                    <option value="aksesoris">Aksesoris</option>
                                    <option value="plastik">Plastik</option>
                                    <option value="kertas">Kertas</option>
                                    <option value="logam">Logam</option>
                                    <option value="elektronik">Elektronik</option>
                                </select>
                                <button @click="showAddProduct = true" class="btn-primary">
                                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Enhanced Products Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terjual</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=60&q=80" 
                                                 alt="Tas Kreasi" class="w-12 h-12 rounded-lg object-cover">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Tas Kreasi Daur Ulang</div>
                                                <div class="text-sm text-gray-500">@Wugis</div>
                                                <div class="text-xs text-gray-400">SKU: TK-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Aksesoris</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Rp 20.000</div>
                                        <div class="text-xs text-gray-500">Rp 18.000 (diskon)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">45</div>
                                        <div class="text-xs text-red-500">Stok menipis</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">156</div>
                                        <div class="text-xs text-green-600">+12% bulan ini</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-active">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <button @click="editProduct(1)" class="btn-warning text-xs px-3 py-1">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button @click="duplicateProduct(1)" class="btn-success text-xs px-3 py-1">
                                                <i class="fas fa-copy mr-1"></i>Duplikat
                                            </button>
                                            <button @click="deleteProduct(1)" class="btn-danger text-xs px-3 py-1">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=60&q=80" 
                                                 alt="Botol Plastik" class="w-12 h-12 rounded-lg object-cover">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Botol Plastik Daur Ulang</div>
                                                <div class="text-sm text-gray-500">@RecyclePro</div>
                                                <div class="text-xs text-gray-400">SKU: BP-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Plastik</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Rp 15.000</div>
                                        <div class="text-xs text-gray-500">Harga normal</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">120</div>
                                        <div class="text-xs text-green-600">Stok aman</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">89</div>
                                        <div class="text-xs text-green-600">+8% bulan ini</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-active">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <button @click="editProduct(2)" class="btn-warning text-xs px-3 py-1">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button @click="duplicateProduct(2)" class="btn-success text-xs px-3 py-1">
                                                <i class="fas fa-copy mr-1"></i>Duplikat
                                            </button>
                                            <button @click="deleteProduct(2)" class="btn-danger text-xs px-3 py-1">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=60&q=80" 
                                                 alt="Kertas Bekas" class="w-12 h-12 rounded-lg object-cover">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Kertas Bekas Premium</div>
                                                <div class="text-sm text-gray-500">@PaperCraft</div>
                                                <div class="text-xs text-gray-400">SKU: KB-003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Kertas</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Rp 25.000</div>
                                        <div class="text-xs text-gray-500">Harga normal</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">30</div>
                                        <div class="text-xs text-yellow-600">Stok sedang</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">67</div>
                                        <div class="text-xs text-green-600">+15% bulan ini</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-pending">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <button @click="editProduct(3)" class="btn-warning text-xs px-3 py-1">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button @click="duplicateProduct(3)" class="btn-success text-xs px-3 py-1">
                                                <i class="fas fa-copy mr-1"></i>Duplikat
                                            </button>
                                            <button @click="deleteProduct(3)" class="btn-danger text-xs px-3 py-1">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">247</span> produk
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="px-3 py-2 text-gray-500 hover:text-gray-700 disabled:opacity-50">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="px-3 py-2 bg-blue-600 text-white rounded-lg">1</button>
                                <button class="px-3 py-2 text-gray-500 hover:text-gray-700">2</button>
                                <button class="px-3 py-2 text-gray-500 hover:text-gray-700">3</button>
                                <button class="px-3 py-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Product Modal -->
                <div class="modal-overlay" :class="{ 'active': showAddProduct }" @click.away="showAddProduct = false">
                    <div class="modal-content max-w-2xl">
                        <button @click="showAddProduct = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Tambah Produk Baru</h3>
                            <p class="text-sm text-gray-600 mt-1">Lengkapi informasi produk untuk menambahkannya ke katalog</p>
                        </div>
                        
                        <form @submit.prevent="addProduct()">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk *</label>
                                        <input type="text" x-model="newProduct.name" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Masukkan nama produk">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">SKU *</label>
                                        <input type="text" x-model="newProduct.sku" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Kode produk unik">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                                        <select x-model="newProduct.category" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Pilih Kategori</option>
                                            <option value="Aksesoris">Aksesoris</option>
                                            <option value="Plastik">Plastik</option>
                                            <option value="Kertas">Kertas</option>
                                            <option value="Logam">Logam</option>
                                            <option value="Elektronik">Elektronik</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                        <input type="text" x-model="newProduct.brand"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Nama brand">
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                                            <input type="number" x-model="newProduct.price" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="0">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Diskon</label>
                                            <input type="number" x-model="newProduct.discountPrice"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="0">
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok *</label>
                                            <input type="number" x-model="newProduct.stock" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="0">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Berat (gram)</label>
                                            <input type="number" x-model="newProduct.weight"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="0">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                                        <input type="url" x-model="newProduct.image" placeholder="https://example.com/image.jpg"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                        <select x-model="newProduct.status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="active">Aktif</option>
                                            <option value="inactive">Nonaktif</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                                <textarea x-model="newProduct.description" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                          placeholder="Deskripsikan produk Anda..."></textarea>
                            </div>
                            
                            <div class="flex gap-3 mt-6">
                                <button type="submit" class="btn-primary flex-1">
                                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                                </button>
                                <button type="button" @click="showAddProduct = false" class="btn-danger flex-1">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Analytics Modal -->
                <div class="modal-overlay" :class="{ 'active': showAnalytics }" @click.away="showAnalytics = false">
                    <div class="modal-content max-w-4xl">
                        <button @click="showAnalytics = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Analitik Toko</h3>
                            <p class="text-sm text-gray-600 mt-1">Lihat performa toko Anda dalam 30 hari terakhir</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Sales Chart -->
                            <div class="toko-card">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Penjualan</h4>
                                <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-chart-line text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-600">Grafik penjualan</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Top Products -->
                            <div class="toko-card">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Produk Terlaris</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Tas Kreasi Daur Ulang</span>
                                        <span class="text-sm font-medium text-green-600">156 terjual</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Botol Plastik Daur Ulang</span>
                                        <span class="text-sm font-medium text-green-600">89 terjual</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Kertas Bekas Premium</span>
                                        <span class="text-sm font-medium text-green-600">67 terjual</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bulk Upload Modal -->
                <div class="modal-overlay" :class="{ 'active': showBulkUpload }" @click.away="showBulkUpload = false">
                    <div class="modal-content max-w-lg">
                        <button @click="showBulkUpload = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Upload Massal Produk</h3>
                            <p class="text-sm text-gray-600 mt-1">Upload file Excel/CSV untuk menambah produk secara massal</p>
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-sm text-gray-600 mb-4">Drag & drop file Excel/CSV di sini atau</p>
                            <button class="btn-primary">
                                <i class="fas fa-file-upload mr-2"></i>Pilih File
                            </button>
                        </div>
                        
                        <div class="mt-4">
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700">
                                <i class="fas fa-download mr-1"></i>Download template Excel
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Inventory Modal -->
                <div class="modal-overlay" :class="{ 'active': showInventory }" @click.away="showInventory = false">
                    <div class="modal-content max-w-4xl">
                        <button @click="showInventory = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Kelola Stok</h3>
                            <p class="text-sm text-gray-600 mt-1">Update stok produk secara massal</p>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok Saat Ini</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Update Stok</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=40&q=80" 
                                                     alt="Tas Kreasi" class="w-8 h-8 rounded object-cover mr-3">
                                                <span class="text-sm font-medium text-gray-900">Tas Kreasi Daur Ulang</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900">45</td>
                                        <td class="px-4 py-3">
                                            <input type="number" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm" value="45">
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Stok Menipis</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=40&q=80" 
                                                     alt="Botol Plastik" class="w-8 h-8 rounded object-cover mr-3">
                                                <span class="text-sm font-medium text-gray-900">Botol Plastik Daur Ulang</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900">120</td>
                                        <td class="px-4 py-3">
                                            <input type="number" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm" value="120">
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Stok Aman</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex gap-3 mt-6">
                            <button class="btn-primary flex-1">
                                <i class="fas fa-save mr-2"></i>Update Stok
                            </button>
                            <button @click="showInventory = false" class="btn-danger flex-1">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Reports Modal -->
                <div class="modal-overlay" :class="{ 'active': showReports }" @click.away="showReports = false">
                    <div class="modal-content max-w-4xl">
                        <button @click="showReports = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Laporan Penjualan</h3>
                            <p class="text-sm text-gray-600 mt-1">Generate laporan penjualan periode tertentu</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month" selected>Bulan Ini</option>
                                    <option value="quarter">Kuartal Ini</option>
                                    <option value="year">Tahun Ini</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="toko-card">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Total Penjualan</span>
                                        <span class="text-sm font-medium text-gray-900">Rp 12.5M</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Total Pesanan</span>
                                        <span class="text-sm font-medium text-gray-900">2,847</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Rata-rata Order</span>
                                        <span class="text-sm font-medium text-gray-900">Rp 4.3K</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Produk Terjual</span>
                                        <span class="text-sm font-medium text-gray-900">8,234</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="toko-card">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Export Laporan</h4>
                                <div class="space-y-3">
                                    <button class="w-full flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                        <i class="fas fa-file-excel text-blue-600 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-900">Export Excel</span>
                                    </button>
                                    <button class="w-full flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                                        <i class="fas fa-file-pdf text-green-600 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-900">Export PDF</span>
                                    </button>
                                    <button class="w-full flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                                        <i class="fas fa-chart-bar text-purple-600 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-900">Grafik Analitik</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Product Modal -->
                <div class="modal-overlay" :class="{ 'active': showEditProduct }" @click.away="showEditProduct = false">
                    <div class="modal-content">
                        <button @click="showEditProduct = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Edit Produk</h3>
                        </div>
                        
                        <form @submit.prevent="updateProduct()">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                                    <input type="text" x-model="editingProduct.name" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                    <select x-model="editingProduct.category" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Aksesoris">Aksesoris</option>
                                        <option value="Plastik">Plastik</option>
                                        <option value="Kertas">Kertas</option>
                                        <option value="Logam">Logam</option>
                                        <option value="Elektronik">Elektronik</option>
                                    </select>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                        <input type="number" x-model="editingProduct.price" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                        <input type="number" x-model="editingProduct.stock" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                    <textarea x-model="editingProduct.description" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                                    <input type="url" x-model="editingProduct.image" placeholder="https://example.com/image.jpg"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <div class="flex gap-3 mt-6">
                                <button type="submit" class="btn-primary flex-1">
                                    <i class="fas fa-save mr-2"></i>Update Produk
                                </button>
                                <button type="button" @click="showEditProduct = false" class="btn-danger flex-1">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function tokoApp() {
    return {
        sidebarOpen: false,
        init() {
            // Initialize sidebar state
            this.sidebarOpen = false;
        }
    }
}

function productApp() {
    return {
        // Modal States
        showAddProduct: false,
        showEditProduct: false,
        showAnalytics: false,
        showBulkUpload: false,
        showInventory: false,
        showReports: false,
        
        // Form Data
        newProduct: {
            name: '',
            sku: '',
            category: '',
            brand: '',
            price: '',
            discountPrice: '',
            stock: '',
            weight: '',
            status: 'active',
            description: '',
            image: ''
        },
        
        editingProduct: {
            id: null,
            name: '',
            sku: '',
            category: '',
            brand: '',
            price: '',
            discountPrice: '',
            stock: '',
            weight: '',
            status: 'active',
            description: '',
            image: ''
        },
        
        // Methods
        addProduct() {
            if (!this.newProduct.name || !this.newProduct.sku || !this.newProduct.price || !this.newProduct.stock) {
                alert('Mohon lengkapi semua field yang diperlukan!');
                return;
            }
            
            // Simulate adding product
            console.log('Adding product:', this.newProduct);
            alert('Produk berhasil ditambahkan!');
            this.showAddProduct = false;
            this.resetProductForm();
        },
        
        editProduct(productId) {
            // Simulate loading product data
            this.editingProduct = {
                id: productId,
                name: 'Produk ' + productId,
                sku: 'SKU-' + productId,
                category: 'Aksesoris',
                brand: 'Brand ' + productId,
                price: '20000',
                discountPrice: '18000',
                stock: '45',
                weight: '500',
                status: 'active',
                description: 'Deskripsi produk...',
                image: 'https://example.com/image.jpg'
            };
            this.showEditProduct = true;
        },
        
        duplicateProduct(productId) {
            if (confirm('Apakah Anda yakin ingin menduplikasi produk ini?')) {
                // Simulate duplicating product
                console.log('Duplicating product:', productId);
                alert('Produk berhasil diduplikasi!');
            }
        },
        
        updateProduct() {
            if (!this.editingProduct.name || !this.editingProduct.sku || !this.editingProduct.price || !this.editingProduct.stock) {
                alert('Mohon lengkapi semua field yang diperlukan!');
                return;
            }
            
            // Simulate updating product
            console.log('Updating product:', this.editingProduct);
            alert('Produk berhasil diperbarui!');
            this.showEditProduct = false;
            this.resetEditingForm();
        },
        
        deleteProduct(productId) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                // Simulate deleting product
                console.log('Deleting product:', productId);
                alert('Produk berhasil dihapus!');
            }
        },
        
        exportData() {
            // Simulate exporting data
            console.log('Exporting data...');
            alert('Data berhasil diexport!');
        },
        
        resetProductForm() {
            this.newProduct = {
                name: '',
                sku: '',
                category: '',
                brand: '',
                price: '',
                discountPrice: '',
                stock: '',
                weight: '',
                status: 'active',
                description: '',
                image: ''
            };
        },
        
        resetEditingForm() {
            this.editingProduct = {
                id: null,
                name: '',
                sku: '',
                category: '',
                brand: '',
                price: '',
                discountPrice: '',
                stock: '',
                weight: '',
                status: 'active',
                description: '',
                image: ''
            };
        }
    }
}
</script>
@endsection 