@extends('layouts.app')

@section('content')
{{-- Alpine.js --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <style>
    html, body {
        overflow-x: hidden;
    }
    
    /* Admin Dashboard Styles */
    .admin-gradient {
        background: var(--sidebar-gradient);
    }
    
    .sidebar-gradient {
        background: var(--sidebar-gradient);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
    }
    
    .sidebar-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 50;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
    }
    
    .sidebar-item-hover {
        transition: all 0.2s ease-in-out;
    }
    
    .sidebar-item-hover:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: translateX(4px);
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
    
    .admin-card {
        background: var(--bg-primary) !important;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-primary) !important;
        color: var(--text-primary) !important;
        transition: all 0.3s ease;
    }
    
    .toko-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .toko-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
    
    .admin-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .stat-card {
        background: var(--sidebar-gradient);
        color: white;
        border-radius: 16px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: rotate(45deg);
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
    
    /* Button Styles */
    .btn-primary {
        background: var(--sidebar-gradient);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    
    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
        transform: translateY(-1px);
    }
    
    .btn-info {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
    }
    
    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
    }
    
    /* Interactive Button Styles */
    .btn-interactive {
        position: relative;
        overflow: hidden;
    }
    
    .btn-interactive::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-interactive:hover::before {
        left: 100%;
    }
    
    /* Enhanced Card Styles */
    .admin-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .admin-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    /* Interactive Table Rows */
    .table-row-interactive {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .table-row-interactive:hover {
        background-color: rgba(102, 126, 234, 0.05) !important;
        transform: scale(1.01);
    }
    
    /* Loading States */
    .btn-loading {
        position: relative;
        pointer-events: none;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    /* Status Badge Styles */
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-active { 
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #166534;
        border: 1px solid #86efac;
    }
    
    .status-inactive { 
        background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        color: #dc2626;
        border: 1px solid #fca5a5;
    }
    
    .status-pending { 
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border: 1px solid #fcd34d;
    }
    
    .status-low-stock {
        background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
        color: #ea580c;
        border: 1px solid #fdba74;
    }
    
    .status-delivered {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #166534;
        border: 1px solid #86efac;
    }
    
    .status-shipped {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border: 1px solid #93c5fd;
    }
    
    .status-processing {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border: 1px solid #fcd34d;
    }
    
    .status-cancelled {
        background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        color: #dc2626;
        border: 1px solid #fca5a5;
    }
    
    .status-vip {
        background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
        color: #7c3aed;
        border: 1px solid #c4b5fd;
    }
    
    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
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
        border-radius: 20px;
        padding: 2rem;
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(0.9);
        transition: all 0.3s ease;
        position: relative;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
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
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 1.2rem;
    }
    
    .modal-close:hover {
        background: #e5e7eb;
        transform: rotate(90deg);
    }
    
    /* Chart Container */
    .chart-container {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }
    
    /* Search and Filter */
    .search-filter {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        margin-bottom: 2rem;
    }
    
    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    
    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }
    
    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #e5e7eb;
    }
    
    /* Notification Badge */
    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
        
        .modal-content {
            margin: 1rem;
            padding: 1.5rem;
        }
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
    </style>

    <div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="adminApp()" x-init="init()">
    {{-- Sidebar --}}
        <aside
            x-data="{ open: false }"
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
                    {{-- Dashboard Link --}}
                    <a href="#" @click.prevent="$root.setActive('dashboard')" class="flex items-center gap-3 p-3 font-medium sidebar-nav-item whitespace-nowrap w-full" :class="open ? ($root.active === 'dashboard' ? 'active text-white' : 'text-white') : ($root.active === 'dashboard' ? 'active text-white justify-center' : 'text-white justify-center')">
                        <i class="fas fa-home text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Dashboard</span>
                    </a>
                    
                    {{-- Bank Sampah Link --}}
                    <a href="#" @click.prevent="$root.setActive('bank-sampah')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'bank-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'bank-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                        <i class="fas fa-tachometer-alt text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Bank Sampah</span>
                    </a>
                    
                    {{-- Toko Link --}}
                    <a href="#" @click.prevent="$root.setActive('toko')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'toko' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'toko' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                        <i class="fas fa-store text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Toko</span>
                    </a>
                    
                    {{-- Komunitas Link --}}
                    <a href="#" @click.prevent="$root.setActive('komunitas')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'komunitas' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'komunitas' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                        <i class="fas fa-users text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Komunitas</span>
                    </a>
                    
                    {{-- Berita Link --}}
                    <a href="#" @click.prevent="$root.setActive('berita')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'berita' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'berita' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                        <i class="fas fa-newspaper text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Berita</span>
                    </a>
                    
                    {{-- Keuangan Link --}}
                    <a href="#" @click.prevent="$root.setActive('keuangan')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'keuangan' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'keuangan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                        <i class="fas fa-file-invoice-dollar text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Keuangan</span>
                    </a>
                    
                    {{-- Pesan Link --}}
                    <a href="#" @click.prevent="$root.setActive('chat')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'chat' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'chat' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                        <i class="fas fa-comment-dots text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Pesan</span>
                    </a>
                    
                    {{-- Umpan Balik Link --}}
                    <a href="#" @click.prevent="$root.setActive('feedback')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'feedback' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'feedback' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                        <i class="fas fa-info-circle text-lg"></i>
                        <span x-show="open" class="text-sm font-medium">Umpan Balik</span>
                    </a>
                    
                    {{-- Settings Link --}}
                    <a href="#" @click.prevent="$root.setActive('settings')" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? ($root.active === 'settings' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : ($root.active === 'settings' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
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
            <h1 class="text-white font-semibold text-lg">BijakSampah</h1>
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
            <div x-data="adminApp()">
                                <!-- Dashboard Overview -->
                <div x-show="active === 'dashboard'">
                    <!-- Header Section -->
                <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                                <p class="text-gray-600 mt-2">Selamat datang di panel admin marketplace BijakSampah</p>
                            </div>
                            <div class="flex gap-3">
                                <button @click="showNewOrders = true" class="btn-warning btn-interactive" id="pesanan-masuk-btn">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesanan Masuk
                                </button>
                                <button @click="showShippingTracking = true" class="btn-info btn-interactive" id="tracking-btn">
                                    <i class="fas fa-truck mr-2"></i>Tracking
                                </button>
                                <button @click="exportReport()" class="btn-secondary btn-interactive">
                                    <i class="fas fa-download mr-2"></i>Export Laporan
                                </button>
                                <button @click="showAnalytics = true" class="btn-success btn-interactive" id="analitik-detail-btn">
                                    <i class="fas fa-chart-bar mr-2"></i>Analitik Detail
                                </button>
                                <button @click="setActive('catalog')" class="btn-primary btn-interactive">
                                    <i class="fas fa-th-large mr-2"></i>Lihat Katalog
                                </button>
                                <button @click="setActive('orders')" class="btn-warning btn-interactive">
                                    <i class="fas fa-shopping-bag mr-2"></i>Orders
                                </button>
                            </div>
                        </div>
                </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Total Produk</p>
                                    <p class="text-3xl font-bold">2,847</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+12%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">dari bulan lalu</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-box text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Total Pesanan</p>
                                    <p class="text-3xl font-bold">15,234</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+8%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">dari bulan lalu</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Total Pendapatan</p>
                                    <p class="text-3xl font-bold">Rp 2.5M</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+15%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">dari bulan lalu</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-dollar-sign text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Total Pengguna</p>
                                    <p class="text-3xl font-bold">45,678</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+23%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">dari bulan lalu</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-users text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div class="chart-container">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Grafik Penjualan</h3>
                            <div class="h-64 bg-gray-100 rounded-lg p-4">
                                <canvas id="salesChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        
                        <div class="chart-container">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori Terlaris</h3>
                            <div class="h-64 bg-gray-100 rounded-lg p-4">
                                <canvas id="categoryChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="admin-card">
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
                                    <span class="text-sm font-medium text-green-600">Rp 450.000</span>
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
                                    <span class="text-sm font-medium text-blue-600">Rp 320.000</span>
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
                                    <span class="text-sm font-medium text-yellow-600">Rp 780.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="admin-card">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Stok Menipis</h3>
                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=40&q=80" 
                                         alt="Produk" class="w-8 h-8 rounded object-cover mr-3">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Smartphone XYZ</p>
                                        <p class="text-xs text-red-600">Stok: 5 unit</p>
                                    </div>
                                    <span class="status-badge status-low-stock">Kritis</span>
                                </div>
                                <div class="flex items-center p-3 bg-orange-50 rounded-lg">
                                    <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=40&q=80" 
                                         alt="Produk" class="w-8 h-8 rounded object-cover mr-3">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Laptop ABC</p>
                                        <p class="text-xs text-orange-600">Stok: 12 unit</p>
                                    </div>
                                    <span class="status-badge status-low-stock">Menipis</span>
                                </div>
                            </div>
                        </div>

                        <div class="admin-card">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Penjual Top</h3>
                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-xs font-bold">T</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">TechStore</p>
                                        <p class="text-xs text-gray-500">1,234 produk terjual</p>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">Rp 45M</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-xs font-bold">F</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">FashionHub</p>
                                        <p class="text-xs text-gray-500">987 produk terjual</p>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">Rp 32M</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-xs font-bold">H</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">HomeDecor</p>
                                        <p class="text-xs text-gray-500">756 produk terjual</p>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">Rp 28M</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customers Management -->
                <div x-show="active === 'customers'">
                    <!-- Header Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Manajemen Pelanggan</h1>
                                <p class="text-gray-600 mt-2">Kelola data pelanggan dan analisis perilaku</p>
                            </div>
                            <div class="flex gap-3">
                                <button @click="exportCustomers()" class="btn-secondary">
                                    <i class="fas fa-download mr-2"></i>Export Data
                                </button>
                                <button @click="showCustomerAnalytics = true" class="btn-primary">
                                    <i class="fas fa-chart-pie mr-2"></i>Analisis
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Total Pelanggan</p>
                                    <p class="text-3xl font-bold">12,847</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+8%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">bulan ini</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-users text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Pelanggan Aktif</p>
                                    <p class="text-3xl font-bold">8,234</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+12%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">bulan ini</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user-check text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Rata-rata Order</p>
                                    <p class="text-3xl font-bold">Rp 450K</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+5%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">bulan ini</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-shopping-bag text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90">Retensi Rate</p>
                                    <p class="text-3xl font-bold">78%</p>
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs opacity-90 flex items-center">
                                            <i class="fas fa-arrow-up mr-1"></i>+3%
                                        </span>
                                        <span class="text-xs opacity-75 ml-2">bulan ini</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-chart-line text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customers Table -->
                    <div class="admin-card">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-900">Daftar Pelanggan</h2>
                                <div class="flex gap-2">
                                    <select x-model="customerFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                        <option value="">Semua Status</option>
                                        <option value="active">Aktif</option>
                                        <option value="inactive">Tidak Aktif</option>
                                        <option value="vip">VIP</option>
                                    </select>
                                    <input type="text" x-model="customerSearch" placeholder="Cari pelanggan..." 
                                           class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Order</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Spent</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terdaftar</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="customer in filteredCustomers" :key="customer.id">
                                        <tr class="hover:bg-gray-50 table-row-interactive">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <img :src="customer.avatar" :alt="customer.name" class="w-10 h-10 rounded-full object-cover mr-3">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900" x-text="customer.name"></div>
                                                        <div class="text-sm text-gray-500" x-text="customer.phone"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900" x-text="customer.email"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm font-medium text-gray-900" x-text="customer.totalOrders"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm font-medium text-gray-900" x-text="'Rp ' + formatNumber(customer.totalSpent)"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="status-badge" :class="'status-' + customer.status" x-text="customer.status"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900" x-text="customer.registeredDate"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex gap-2">
                                                    <button @click="viewCustomerDetail(customer)" class="btn-primary text-xs px-3 py-1 btn-interactive">
                                                        <i class="fas fa-eye mr-1"></i>Detail
                                                    </button>
                                                    <button @click="editCustomer(customer.id)" class="btn-warning text-xs px-3 py-1 btn-interactive">
                                                        <i class="fas fa-edit mr-1"></i>Edit
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Catalog Section -->
                <div x-show="active === 'catalog'">
                    <!-- Header Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Katalog Produk</h1>
                                <p class="text-gray-600 mt-2">Lihat semua produk dalam katalog marketplace</p>
                            </div>
                            <div class="flex gap-3">
                                <button @click="showCatalogAnalytics = true" class="btn-info btn-interactive">
                                    <i class="fas fa-chart-pie mr-2"></i>Analitik Katalog
                                </button>
                                <button @click="exportCatalog()" class="btn-secondary btn-interactive">
                                    <i class="fas fa-download mr-2"></i>Export Katalog
                                </button>
                                <button @click="showAddProduct = true" class="btn-primary btn-interactive">
                                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                                </button>
                                <button @click="showBulkUpload = true" class="btn-success btn-interactive">
                                    <i class="fas fa-upload mr-2"></i>Upload Massal
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter -->
                    <div class="search-filter">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="relative">
                                <input type="text" x-model="catalogSearch" placeholder="Cari produk..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <select x-model="catalogCategory" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Kategori</option>
                                <option value="Aksesoris">Aksesoris</option>
                                <option value="Plastik">Plastik</option>
                                <option value="Kertas">Kertas</option>
                                <option value="Logam">Logam</option>
                                <option value="Elektronik">Elektronik</option>
                            </select>
                            <select x-model="catalogStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Nonaktif</option>
                                <option value="pending">Pending</option>
                            </select>
                            <button @click="resetCatalogFilters()" class="btn-secondary btn-interactive">
                                <i class="fas fa-refresh mr-2"></i>Reset Filter
                            </button>
                        </div>
                    </div>

                    <!-- Catalog Grid -->
                    <div class="product-grid">
                        <template x-for="product in filteredCatalogProducts" :key="product.id">
                            <div class="product-card">
                                <img :src="product.image" :alt="product.name" class="product-image">
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs text-gray-500" x-text="product.seller"></span>
                                        <span class="status-badge" :class="'status-' + product.status" x-text="product.status"></span>
                                    </div>
                                    <h3 class="font-semibold text-gray-900 mb-2" x-text="product.name"></h3>
                                    <p class="text-sm text-gray-600 mb-3" x-text="product.description"></p>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-lg font-bold text-blue-600" x-text="'Rp ' + formatNumber(product.price)"></span>
                                        <span class="text-sm" :class="product.stock < 10 ? 'text-red-500' : 'text-gray-500'" x-text="'Stok: ' + product.stock"></span>
                                    </div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm text-green-600" x-text="product.sold + ' terjual'"></span>
                                        <span class="text-sm text-gray-500" x-text="'Rating: ' + product.rating"></span>
                                    </div>
                                    <div class="flex gap-2">
                                        <button @click="viewProductDetail(product)" class="btn-primary flex-1 text-sm btn-interactive">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </button>
                                        <button @click="editProduct(product.id)" class="btn-warning flex-1 text-sm btn-interactive">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        <button @click="deleteProduct(product.id)" class="btn-danger flex-1 text-sm btn-interactive">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between mt-8">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium" x-text="catalogStartIndex + 1"></span> sampai <span class="font-medium" x-text="catalogEndIndex"></span> dari <span class="font-medium" x-text="filteredCatalogProducts.length"></span> produk
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="catalogPrevPage()" class="px-3 py-2 text-gray-500 hover:text-gray-700 disabled:opacity-50" :disabled="catalogCurrentPage === 1">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <template x-for="page in catalogPages" :key="page">
                                <button @click="catalogGoToPage(page)" class="px-3 py-2" :class="page === catalogCurrentPage ? 'bg-blue-600 text-white rounded-lg' : 'text-gray-500 hover:text-gray-700'" x-text="page"></button>
                            </template>
                            <button @click="catalogNextPage()" class="px-3 py-2 text-gray-500 hover:text-gray-700 disabled:opacity-50" :disabled="catalogCurrentPage === catalogTotalPages">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Orders Management -->
                <div x-show="active === 'orders'">
                    <!-- Header Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Manajemen Pesanan</h1>
                                <p class="text-gray-600 mt-2">Kelola semua pesanan dari seluruh penjual</p>
                            </div>
                            <div class="flex gap-3">
                                <button @click="showPaymentTracking = true" class="btn-info btn-interactive" id="tracking-pembayaran-btn">
                                    <i class="fas fa-credit-card mr-2"></i>Tracking Pembayaran
                                </button>
                                <button @click="showOrderConfirmation = true" class="btn-warning btn-interactive" id="konfirmasi-pesanan-btn">
                                    <i class="fas fa-check-circle mr-2"></i>Konfirmasi Pesanan
                                </button>
                                <button @click="showShippingTracking = true" class="btn-success btn-interactive" id="tracking-pengiriman-btn">
                                    <i class="fas fa-truck mr-2"></i>Tracking Pengiriman
                                </button>
                                <button @click="exportOrders()" class="btn-secondary btn-interactive">
                                    <i class="fas fa-download mr-2"></i>Export Pesanan
                                </button>
                                <button @click="showBulkUpdate = true" class="btn-primary btn-interactive" id="update-massal-btn">
                                    <i class="fas fa-edit mr-2"></i>Update Massal
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="admin-card">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-900">Daftar Pesanan</h2>
                                <div class="flex gap-2">
                                    <select x-model="orderStatus" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                        <option value="">Semua Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="processing">Diproses</option>
                                        <option value="shipped">Dikirim</option>
                                        <option value="delivered">Terkirim</option>
                                        <option value="cancelled">Dibatalkan</option>
                                    </select>
                                    <input type="text" x-model="orderSearch" placeholder="Cari pesanan..." 
                                           class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="order in filteredOrders" :key="order.id">
                                        <tr class="hover:bg-gray-50 table-row-interactive">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm font-medium text-gray-900" x-text="order.orderId"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900" x-text="order.customerName"></div>
                                                    <div class="text-sm text-gray-500" x-text="order.customerEmail"></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <img :src="order.productImage" :alt="order.productName" class="w-10 h-10 rounded object-cover mr-3">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900" x-text="order.productName"></div>
                                                        <div class="text-sm text-gray-500" x-text="'Qty: ' + order.quantity"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm font-medium text-gray-900" x-text="'Rp ' + formatNumber(order.total)"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="status-badge" :class="'status-' + order.status" x-text="order.status"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900" x-text="order.date"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex gap-2">
                                                    <button @click="viewOrderDetail(order)" class="btn-primary text-xs px-3 py-1 btn-interactive">
                                                        <i class="fas fa-eye mr-1"></i>Detail
                                                    </button>
                                                    <button @click="updateOrderStatus(order.id)" class="btn-warning text-xs px-3 py-1 btn-interactive">
                                                        <i class="fas fa-edit mr-1"></i>Update
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Products Management -->
                <div x-show="active === 'products'">
                    <!-- Header Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Manajemen Produk</h1>
                                <p class="text-gray-600 mt-2">Kelola semua produk dari seluruh penjual</p>
                            </div>
                            <div class="flex gap-3">
                                <button @click="showAddProduct = true" class="btn-primary">
                                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                                </button>
                                <button @click="showBulkUpload = true" class="btn-success">
                                    <i class="fas fa-upload mr-2"></i>Upload Massal
                                </button>
                                <button @click="exportProducts()" class="btn-secondary">
                                    <i class="fas fa-download mr-2"></i>Export
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter -->
                    <div class="search-filter">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="relative">
                                <input type="text" x-model="productSearch" placeholder="Cari produk..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <select x-model="productCategory" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Kategori</option>
                                <option value="Aksesoris">Aksesoris</option>
                                <option value="Plastik">Plastik</option>
                                <option value="Kertas">Kertas</option>
                                <option value="Logam">Logam</option>
                                <option value="Elektronik">Elektronik</option>
                            </select>
                            <select x-model="productStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Nonaktif</option>
                                <option value="pending">Pending</option>
                            </select>
                            <button @click="resetProductFilters()" class="btn-secondary btn-interactive">
                                <i class="fas fa-refresh mr-2"></i>Reset Filter
                            </button>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="product-grid">
                        <!-- Product Card 1 -->
                        <div class="product-card">
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=400&q=80" 
                                 alt="Smartphone XYZ" class="product-image">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-gray-500">TechStore</span>
                                    <span class="status-badge status-active">Aktif</span>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">Smartphone XYZ Pro Max</h3>
                                <p class="text-sm text-gray-600 mb-3">Smartphone terbaru dengan kamera 108MP dan baterai 5000mAh</p>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-blue-600">Rp 2.500.000</span>
                                    <span class="text-sm text-gray-500">Stok: 45</span>
                                </div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-green-600">156 terjual</span>
                                    <span class="text-sm text-gray-500">Rating: 4.8</span>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="editProduct(1)" class="btn-warning flex-1 text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button @click="deleteProduct(1)" class="btn-danger flex-1 text-sm">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 2 -->
                        <div class="product-card">
                            <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=400&q=80" 
                                 alt="Laptop ABC" class="product-image">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-gray-500">TechStore</span>
                                    <span class="status-badge status-active">Aktif</span>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">Laptop ABC Ultra</h3>
                                <p class="text-sm text-gray-600 mb-3">Laptop gaming dengan RTX 4080 dan RAM 32GB</p>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-blue-600">Rp 15.000.000</span>
                                    <span class="text-sm text-red-500">Stok: 12</span>
                                </div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-green-600">89 terjual</span>
                                    <span class="text-sm text-gray-500">Rating: 4.9</span>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="editProduct(2)" class="btn-warning flex-1 text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button @click="deleteProduct(2)" class="btn-danger flex-1 text-sm">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 3 -->
                        <div class="product-card">
                            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=400&q=80" 
                                 alt="Tas Fashion" class="product-image">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-gray-500">FashionHub</span>
                                    <span class="status-badge status-pending">Pending</span>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">Tas Fashion Premium</h3>
                                <p class="text-sm text-gray-600 mb-3">Tas kulit asli dengan desain eksklusif</p>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-blue-600">Rp 850.000</span>
                                    <span class="text-sm text-gray-500">Stok: 67</span>
                                </div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-green-600">234 terjual</span>
                                    <span class="text-sm text-gray-500">Rating: 4.7</span>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="editProduct(3)" class="btn-warning flex-1 text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button @click="deleteProduct(3)" class="btn-danger flex-1 text-sm">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 4 -->
                        <div class="product-card">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=400&q=80" 
                                 alt="Sepatu Sport" class="product-image">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-gray-500">FashionHub</span>
                                    <span class="status-badge status-inactive">Nonaktif</span>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">Sepatu Sport Pro</h3>
                                <p class="text-sm text-gray-600 mb-3">Sepatu olahraga dengan teknologi cushioning</p>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-blue-600">Rp 450.000</span>
                                    <span class="text-sm text-gray-500">Stok: 0</span>
                                </div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-green-600">567 terjual</span>
                                    <span class="text-sm text-gray-500">Rating: 4.6</span>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="editProduct(4)" class="btn-warning flex-1 text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button @click="deleteProduct(4)" class="btn-danger flex-1 text-sm">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between mt-8">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">12</span> dari <span class="font-medium">2,847</span> produk
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
                                    <input type="text" x-model="productSearch" placeholder="Cari produk..." 
                                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <select x-model="productCategory" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Semua Kategori</option>
                                    <option value="Aksesoris">Aksesoris</option>
                                    <option value="Plastik">Plastik</option>
                                    <option value="Kertas">Kertas</option>
                                    <option value="Logam">Logam</option>
                                    <option value="Elektronik">Elektronik</option>
                                </select>
                                <button @click="showAddProduct = true" class="btn-primary">
                                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                                </button>
                                <button @click="showBulkUpload = true" class="btn-success">
                                    <i class="fas fa-upload mr-2"></i>Upload Massal
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
                                    <template x-for="product in filteredProducts" :key="product.id">
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <img :src="product.image" :alt="product.name" class="w-12 h-12 rounded-lg object-cover">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900" x-text="product.name"></div>
                                                        <div class="text-sm text-gray-500" x-text="'@' + product.seller"></div>
                                                        <div class="text-xs text-gray-400" x-text="'SKU: ' + product.sku"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full" x-text="product.category"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900" x-text="'Rp ' + formatNumber(product.price)"></div>
                                                <div class="text-xs text-gray-500" x-text="product.discountPrice ? 'Rp ' + formatNumber(product.discountPrice) + ' (diskon)' : ''"></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900" x-text="product.stock"></div>
                                                <div class="text-xs" :class="product.stock < 10 ? 'text-red-500' : 'text-gray-500'" x-text="product.stock < 10 ? 'Stok menipis' : 'Stok aman'"></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900" x-text="product.sold"></div>
                                                <div class="text-xs text-green-600" x-text="'+' + Math.floor(Math.random() * 20) + '% bulan ini'"></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="status-badge" :class="'status-' + product.status" x-text="product.status"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex gap-2">
                                                    <button @click="editProduct(product.id)" class="btn-warning text-xs px-3 py-1 btn-interactive">
                                                        <i class="fas fa-edit mr-1"></i>Edit
                                                    </button>
                                                    <button @click="duplicateProduct(product.id)" class="btn-success text-xs px-3 py-1 btn-interactive">
                                                        <i class="fas fa-copy mr-1"></i>Duplikat
                                                    </button>
                                                    <button @click="deleteProduct(product.id)" class="btn-danger text-xs px-3 py-1 btn-interactive">
                                                        <i class="fas fa-trash mr-1"></i>Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                

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

                    <!-- Edit Product Modal -->
                <div class="modal-overlay" :class="{ 'active': showEditProduct }" @click.away="showEditProduct = false">
                    <div class="modal-content max-w-2xl">
                        <button @click="showEditProduct = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Edit Produk</h3>
                            <p class="text-sm text-gray-600 mt-1">Edit informasi produk yang dipilih</p>
                        </div>
                        
                        <form @submit.prevent="updateProduct()">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk *</label>
                                        <input type="text" x-model="editingProduct.name" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Masukkan nama produk">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">SKU *</label>
                                        <input type="text" x-model="editingProduct.sku" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Masukkan SKU produk">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
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
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                        <input type="text" x-model="editingProduct.brand"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Masukkan brand produk">
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) *</label>
                                        <input type="number" x-model="editingProduct.price" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Masukkan harga produk">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Diskon (Rp)</label>
                                        <input type="number" x-model="editingProduct.discountPrice"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Masukkan harga diskon (opsional)">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok *</label>
                                        <input type="number" x-model="editingProduct.stock" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Masukkan jumlah stok">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                        <select x-model="editingProduct.status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="active">Aktif</option>
                                            <option value="inactive">Nonaktif</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea x-model="editingProduct.description" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                          placeholder="Masukkan deskripsi produk"></textarea>
                            </div>
                            
                            <div class="flex gap-3 mt-6">
                                <button type="submit" class="btn-primary flex-1 btn-interactive">
                                    <i class="fas fa-save mr-2"></i>Update Produk
                                </button>
                                <button type="button" @click="showEditProduct = false" class="btn-danger flex-1 btn-interactive">
                                    Batal
                                </button>
                            </div>
                        </form>
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
                                    <template x-for="product in products" :key="product.id">
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <img :src="product.image" :alt="product.name" class="w-8 h-8 rounded object-cover mr-3">
                                                    <span class="text-sm font-medium text-gray-900" x-text="product.name"></span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900" x-text="product.stock"></td>
                                            <td class="px-4 py-3">
                                                <input type="number" x-model="product.stock" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm">
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full" 
                                                      :class="product.stock < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'"
                                                      x-text="product.stock < 10 ? 'Stok Menipis' : 'Stok Aman'"></span>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                    </div>
                        
                        <div class="flex gap-3 mt-6">
                            <button @click="saveInventoryChanges()" class="btn-primary flex-1 btn-interactive">
                                <i class="fas fa-save mr-2"></i>Update Stok
                    </button>
                            <button @click="showInventory = false" class="btn-danger flex-1 btn-interactive">
                                Batal
                    </button>
            </div>
        </div>
    </div>

                <!-- Product Detail Modal -->
                <div class="modal-overlay" :class="{ 'active': showProductDetail }" @click.away="showProductDetail = false">
                    <div class="modal-content max-w-4xl">
                        <button @click="showProductDetail = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Detail Produk</h3>
                            <p class="text-sm text-gray-600 mt-1">Informasi lengkap produk</p>
                        </div>
                        
                        <div x-show="selectedProduct" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Image -->
                            <div>
                                <img :src="selectedProduct?.image || ''" :alt="selectedProduct?.name || ''" class="w-full h-64 object-cover rounded-lg">
                            </div>
                            
                            <!-- Product Info -->
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900" x-text="selectedProduct?.name || ''"></h4>
                                    <p class="text-sm text-gray-500" x-text="'SKU: ' + (selectedProduct?.sku || '')"></p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                                        <p class="text-sm text-gray-900" x-text="selectedProduct?.category || ''"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Brand</label>
                                        <p class="text-sm text-gray-900" x-text="selectedProduct?.brand || ''"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Harga</label>
                                        <p class="text-lg font-bold text-blue-600" x-text="'Rp ' + formatNumber(selectedProduct?.price || 0)"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Harga Diskon</label>
                                        <p class="text-sm text-gray-900" x-text="selectedProduct?.discountPrice ? 'Rp ' + formatNumber(selectedProduct.discountPrice) : '-'"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Stok</label>
                                        <p class="text-sm" :class="(selectedProduct?.stock || 0) < 10 ? 'text-red-600' : 'text-gray-900'" x-text="(selectedProduct?.stock || 0) + ' unit'"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Terjual</label>
                                        <p class="text-sm text-green-600" x-text="(selectedProduct?.sold || 0) + ' unit'"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Rating</label>
                                        <p class="text-sm text-gray-900" x-text="(selectedProduct?.rating || 0) + '/5'"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                        <span class="status-badge" :class="'status-' + (selectedProduct?.status || '')" x-text="selectedProduct?.status || ''"></span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <p class="text-sm text-gray-900" x-text="selectedProduct?.description || ''"></p>
                                </div>
                                
                                <div class="flex gap-3">
                                    <button @click="editProduct(selectedProduct?.id)" class="btn-warning flex-1 btn-interactive">
                                        <i class="fas fa-edit mr-2"></i>Edit Produk
                                    </button>
                                    <button @click="duplicateProduct(selectedProduct?.id)" class="btn-success flex-1">
                                        <i class="fas fa-copy mr-2"></i>Duplikat
                                    </button>
                                    <button @click="deleteProduct(selectedProduct?.id)" class="btn-danger flex-1">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Orders Modal -->
                <div class="modal-overlay" :class="{ 'active': showNewOrders }" @click.away="showNewOrders = false">
                    <div class="modal-content max-w-6xl">
                        <button @click="showNewOrders = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Pesanan Masuk</h3>
                            <p class="text-sm text-gray-600 mt-1">Kelola pesanan baru yang perlu diproses</p>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- New Orders List -->
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Pesanan Baru</h4>
                                <div class="space-y-3 max-h-96 overflow-y-auto">
                                    <template x-for="order in newOrders" :key="order.id">
                                        <div class="admin-card p-4 cursor-pointer hover:shadow-lg transition-shadow" 
                                             @click="selectOrder(order)" 
                                             :class="selectedOrder?.id === order.id ? 'ring-2 ring-blue-500' : ''">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm font-medium text-gray-900" x-text="order.orderId"></span>
                                                <span class="status-badge status-pending" x-text="order.status"></span>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <img :src="order.productImage" :alt="order.productName" class="w-12 h-12 rounded object-cover mr-3">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900" x-text="order.productName"></p>
                                                    <p class="text-xs text-gray-500" x-text="order.customerName"></p>
                                                </div>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-900" x-text="'Rp ' + formatNumber(order.total)"></span>
                                                <span class="text-xs text-gray-500" x-text="order.date"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            
                            <!-- Order Details -->
                            <div x-show="selectedOrder">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Detail Pesanan</h4>
                                <div class="admin-card p-4">
                                    <div class="space-y-4">
                                        <div>
                                                                        <h5 class="font-medium text-gray-900" x-text="selectedOrder?.orderId || ''"></h5>
                            <p class="text-sm text-gray-500" x-text="selectedOrder?.date || ''"></p>
                                        </div>
                                        
                                        <div class="border-t pt-4">
                                            <h6 class="font-medium text-gray-900 mb-2">Informasi Pelanggan</h6>
                                            <div class="space-y-1 text-sm">
                                                                                <p><span class="font-medium">Nama:</span> <span x-text="selectedOrder?.customerName || ''"></span></p>
                                <p><span class="font-medium">Email:</span> <span x-text="selectedOrder?.customerEmail || ''"></span></p>
                                <p><span class="font-medium">Telepon:</span> <span x-text="selectedOrder?.customerPhone || 'Tidak ada'"></span></p>
                                <p><span class="font-medium">Alamat:</span> <span x-text="selectedOrder?.customerAddress || 'Tidak ada'"></span></p>
                                            </div>
                                        </div>
                                        
                                        <div class="border-t pt-4">
                                            <h6 class="font-medium text-gray-900 mb-2">Produk</h6>
                                            <div class="flex items-center">
                                                <img :src="selectedOrder?.productImage || ''" :alt="selectedOrder?.productName || ''" class="w-16 h-16 rounded object-cover mr-3">
                                                <div>
                                                    <p class="font-medium text-gray-900" x-text="selectedOrder?.productName || ''"></p>
                                                    <p class="text-sm text-gray-500" x-text="'Qty: ' + (selectedOrder?.quantity || 0)"></p>
                                                    <p class="text-sm font-medium text-blue-600" x-text="'Rp ' + formatNumber(selectedOrder?.total || 0)"></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="border-t pt-4">
                                            <h6 class="font-medium text-gray-900 mb-2">Metode Pembayaran</h6>
                                            <div class="space-y-1 text-sm">
                                                <p><span class="font-medium">Metode:</span> <span x-text="selectedOrder?.paymentMethod || 'Transfer Bank'"></span></p>
                                                <p><span class="font-medium">Status:</span> <span class="status-badge status-active" x-text="selectedOrder?.paymentStatus || 'Lunas'"></span></p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex gap-3 pt-4">
                                            <button @click="processOrder(selectedOrder?.id)" class="btn-primary flex-1 btn-interactive">
                                                <i class="fas fa-box mr-2"></i>Proses Pesanan
                                            </button>
                                            <button @click="generateInvoice(selectedOrder?.id)" class="btn-success flex-1 btn-interactive">
                                                <i class="fas fa-file-invoice mr-2"></i>Generate Invoice
                                            </button>
                                            <button @click="completeOrder(selectedOrder?.id)" class="btn-warning flex-1 btn-interactive">
                                                <i class="fas fa-check-circle mr-2"></i>Selesaikan Pesanan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Shipping Tracking Modal -->
                <div class="modal-overlay" :class="{ 'active': showShippingTracking }" @click.away="showShippingTracking = false" x-init="initTracking()">
                    <div class="modal-content max-w-6xl">
                        <button @click="showShippingTracking = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Tracking Pengiriman</h3>
                            <p class="text-sm text-gray-600 mt-1">Lacak status pengiriman pesanan secara real-time</p>
                        </div>
                        
                        <!-- Real-time Tracking Dashboard -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                            <div class="admin-card p-4">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">Status Pengiriman</h4>
                                    <button @click="refreshTracking()" class="text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Terkirim</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600">1,247</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-shipping-fast text-blue-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Dalam Pengiriman</span>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">89</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-box text-yellow-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Dikemas</span>
                                        </div>
                                        <span class="text-sm font-medium text-yellow-600">156</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-clock text-gray-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Pending</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">23</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Kurir Terpopuler</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-truck text-blue-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">JNE</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">45%</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-shipping-fast text-green-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">SiCepat</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">30%</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-boxes text-yellow-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">J&T</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">25%</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Performa Pengiriman</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Rata-rata Waktu</span>
                                        <span class="text-sm font-medium text-gray-900">2.3 hari</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">On-time Delivery</span>
                                        <span class="text-sm font-medium text-green-600">94.5%</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Customer Rating</span>
                                        <span class="text-sm font-medium text-yellow-600">4.8/5</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Return Rate</span>
                                        <span class="text-sm font-medium text-red-600">1.2%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div x-show="selectedOrder && orders.length > 0" class="space-y-6">
                            <!-- Order Selection -->
                            <div class="admin-card p-4">
                                <h5 class="font-medium text-gray-900 mb-4">Pilih Pesanan untuk Tracking</h5>
                                <div x-show="orders.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-48 overflow-y-auto">
                                    <template x-for="order in orders" :key="order.id">
                                        <div class="p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors"
                                             :class="selectedOrder?.id === order.id ? 'border-blue-500 bg-blue-50' : 'border-gray-200'"
                                             @click="selectedOrder = order">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm font-medium text-gray-900" x-text="order.orderId"></span>
                                                <span class="status-badge" :class="'status-' + order.shippingStatus" x-text="order.shippingStatus"></span>
                                            </div>
                                            <p class="text-xs text-gray-500" x-text="order.customerName"></p>
                                            <p class="text-xs text-gray-500" x-text="order.productName"></p>
                                        </div>
                                    </template>
                                </div>
                                <div x-show="orders.length === 0" class="text-center py-8">
                                    <i class="fas fa-shipping-fast text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500">Tidak ada pesanan untuk di-track</p>
                                </div>

                                <h5 class="font-medium text-gray-900 mb-4">Pilih Pesanan untuk Tracking</h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-48 overflow-y-auto">
                                    <template x-for="order in orders" :key="order.id">
                                        <div class="p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors"
                                             :class="selectedOrder?.id === order.id ? 'border-blue-500 bg-blue-50' : 'border-gray-200'"
                                             @click="selectedOrder = order">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm font-medium text-gray-900" x-text="order.orderId"></span>
                                                <span class="status-badge" :class="'status-' + order.shippingStatus" x-text="order.shippingStatus"></span>
                                            </div>
                                            <p class="text-xs text-gray-500" x-text="order.customerName"></p>
                                            <p class="text-xs text-gray-500" x-text="order.productName"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <!-- Order Info -->
                            <div class="admin-card p-4">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h4 class="font-medium text-gray-900" x-text="selectedOrder?.orderId || ''"></h4>
                                        <p class="text-sm text-gray-500" x-text="selectedOrder?.customerName || ''"></p>
                                    </div>
                                    <span class="status-badge" :class="'status-' + (selectedOrder?.shippingStatus || '')" x-text="selectedOrder?.shippingStatus || ''"></span>
                                </div>
                                
                                <div class="flex items-center">
                                    <img :src="selectedOrder?.productImage || ''" :alt="selectedOrder?.productName || ''" class="w-12 h-12 rounded object-cover mr-3">
                                    <div>
                                        <p class="font-medium text-gray-900" x-text="selectedOrder?.productName || ''"></p>
                                        <p class="text-sm text-gray-500" x-text="'Qty: ' + (selectedOrder?.quantity || 0)"></p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tracking Timeline -->
                            <div class="admin-card p-4">
                                <h5 class="font-medium text-gray-900 mb-4">Timeline Pengiriman</h5>
                                <div class="space-y-4">
                                    <template x-for="(step, index) in shippingSteps" :key="index">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center" 
                                                     :class="step.completed ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600'">
                                                    <i :class="step.icon" x-text="step.completed ? '✓' : (index + 1)"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <p class="font-medium text-gray-900" x-text="step.title"></p>
                                                <p class="text-sm text-gray-500" x-text="step.description"></p>
                                                <p class="text-xs text-gray-400" x-text="step.time"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            
                            <!-- Update Status -->
                            <div class="admin-card p-4">
                                <h5 class="font-medium text-gray-900 mb-4">Update Status</h5>
                                <div class="flex gap-3">
                                    <button @click="updateShippingStatus('packed')" class="btn-primary btn-interactive">
                                        <i class="fas fa-box mr-2"></i>Dikemas
                                    </button>
                                    <button @click="updateShippingStatus('shipped')" class="btn-warning btn-interactive">
                                        <i class="fas fa-shipping-fast mr-2"></i>Dikirim
                                    </button>
                                    <button @click="updateShippingStatus('delivered')" class="btn-success btn-interactive">
                                        <i class="fas fa-check mr-2"></i>Terkirim
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- No Orders Message -->
                        <div x-show="!selectedOrder || orders.length === 0" class="text-center py-12">
                            <i class="fas fa-shipping-fast text-6xl text-gray-400 mb-4"></i>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Pesanan</h4>
                            <p class="text-gray-500">Belum ada pesanan yang dapat di-track</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Tracking Modal -->
                <div class="modal-overlay" :class="{ 'active': showPaymentTracking }" @click.away="showPaymentTracking = false">
                    <div class="modal-content max-w-6xl">
                        <button @click="showPaymentTracking = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Tracking Pembayaran</h3>
                            <p class="text-sm text-gray-600 mt-1">Lacak status pembayaran semua pesanan</p>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Payment Status Overview -->
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Status Pembayaran</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Lunas</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600">1,247</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-clock text-yellow-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Menunggu Konfirmasi</span>
                                        </div>
                                        <span class="text-sm font-medium text-yellow-600">89</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-times-circle text-red-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Gagal</span>
                                        </div>
                                        <span class="text-sm font-medium text-red-600">23</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-credit-card text-blue-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Pending</span>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">156</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Payment Methods -->
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Metode Pembayaran</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-university text-blue-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">Transfer Bank</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">45%</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-mobile-alt text-green-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">E-Wallet</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">35%</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-money-bill-wave text-yellow-600 mr-3"></i>
                                            <span class="text-sm font-medium text-gray-900">COD</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Details Table -->
                        <div class="admin-card">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-900">Detail Pembayaran</h4>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <template x-for="order in orders" :key="order.id">
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-sm font-medium text-gray-900" x-text="order.orderId"></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900" x-text="order.customerName"></div>
                                                        <div class="text-sm text-gray-500" x-text="order.customerEmail"></div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-university text-blue-600 mr-2"></i>
                                                        <span class="text-sm text-gray-900" x-text="order.paymentMethod"></span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-sm font-medium text-gray-900" x-text="'Rp ' + formatNumber(order.total)"></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="status-badge" :class="'status-' + (order.paymentStatus === 'Lunas' ? 'active' : 'pending')" x-text="order.paymentStatus"></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-sm text-gray-900" x-text="order.date"></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex gap-2">
                                                        <button @click="confirmPayment(order.id)" class="btn-success text-xs px-3 py-1">
                                                            <i class="fas fa-check mr-1"></i>Konfirmasi
                                                        </button>
                                                        <button @click="viewPaymentDetail(order.id)" class="btn-primary text-xs px-3 py-1">
                                                            <i class="fas fa-eye mr-1"></i>Detail
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Confirmation Modal -->
                <div class="modal-overlay" :class="{ 'active': showOrderConfirmation }" @click.away="showOrderConfirmation = false">
                    <div class="modal-content max-w-4xl">
                        <button @click="showOrderConfirmation = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Konfirmasi Pesanan</h3>
                            <p class="text-sm text-gray-600 mt-1">Konfirmasi pesanan yang menunggu approval</p>
                        </div>
                        
                        <div class="space-y-4">
                            <template x-for="order in pendingOrders" :key="order.id">
                                <div class="admin-card p-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h4 class="font-medium text-gray-900" x-text="order.orderId"></h4>
                                            <p class="text-sm text-gray-500" x-text="order.customerName"></p>
                                        </div>
                                        <span class="status-badge status-pending">Menunggu Konfirmasi</span>
                                    </div>
                                    
                                    <div class="flex items-center mb-4">
                                        <img :src="order.productImage" :alt="order.productName" class="w-16 h-16 rounded object-cover mr-4">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900" x-text="order.productName"></p>
                                            <p class="text-sm text-gray-500" x-text="'Qty: ' + order.quantity"></p>
                                            <p class="text-lg font-bold text-blue-600" x-text="'Rp ' + formatNumber(order.total)"></p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                                            <p class="text-sm text-gray-900" x-text="order.paymentMethod"></p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                                            <p class="text-sm text-gray-900" x-text="order.paymentStatus"></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex gap-3">
                                        <button @click="approveOrder(order.id)" class="btn-success flex-1">
                                            <i class="fas fa-check mr-2"></i>Setujui Pesanan
                                        </button>
                                        <button @click="rejectOrder(order.id)" class="btn-danger flex-1">
                                            <i class="fas fa-times mr-2"></i>Tolak Pesanan
                                        </button>
                                        <button @click="requestMoreInfo(order.id)" class="btn-warning flex-1">
                                            <i class="fas fa-question mr-2"></i>Minta Info Lebih
                                        </button>
                                    </div>
                                </div>
                            </template>
                            
                            <div x-show="pendingOrders.length === 0" class="text-center py-8">
                                <i class="fas fa-check-circle text-4xl text-green-400 mb-4"></i>
                                <p class="text-gray-500">Tidak ada pesanan yang menunggu konfirmasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bulk Update Modal -->
                <div class="modal-overlay" :class="{ 'active': showBulkUpdate }" @click.away="showBulkUpdate = false">
                    <div class="modal-content max-w-4xl">
                        <button @click="showBulkUpdate = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Update Massal Pesanan</h3>
                            <p class="text-sm text-gray-600 mt-1">Update status pesanan secara massal</p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Pilih Pesanan</h4>
                                <div class="space-y-2 max-h-64 overflow-y-auto">
                                    <template x-for="order in orders" :key="order.id">
                                        <div class="flex items-center p-3 border rounded-lg hover:bg-gray-50">
                                            <input type="checkbox" :value="order.id" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <div class="ml-3 flex-1">
                                                <p class="text-sm font-medium text-gray-900" x-text="order.orderId"></p>
                                                <p class="text-xs text-gray-500" x-text="order.customerName"></p>
                                            </div>
                                            <span class="status-badge" :class="'status-' + order.status" x-text="order.status"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="processing">Diproses</option>
                                            <option value="shipped">Dikirim</option>
                                            <option value="delivered">Terkirim</option>
                                            <option value="cancelled">Dibatalkan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Pengiriman</label>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="packed">Dikemas</option>
                                            <option value="shipped">Dikirim</option>
                                            <option value="delivered">Terkirim</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-3">
                                <button @click="updateBulkOrders()" class="btn-primary flex-1 btn-interactive">
                                    <i class="fas fa-save mr-2"></i>Update Pesanan
                                </button>
                                <button @click="showBulkUpdate = false" class="btn-danger flex-1 btn-interactive">
                                    Batal
                                </button>
                            </div>
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

                <!-- Catalog Analytics Modal -->
                <div class="modal-overlay" :class="{ 'active': showCatalogAnalytics }" @click.away="showCatalogAnalytics = false">
                    <div class="modal-content max-w-4xl">
                        <button @click="showCatalogAnalytics = false" class="modal-close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Analitik Katalog</h3>
                            <p class="text-sm text-gray-600 mt-1">Analisis performa produk dalam katalog</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category Performance -->
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Performa Kategori</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Aksesoris</span>
                                        <div class="flex items-center">
                                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-blue-600 h-2 rounded-full" style="width: 35%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">35%</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Plastik</span>
                                        <div class="flex items-center">
                                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-green-600 h-2 rounded-full" style="width: 28%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">28%</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Kertas</span>
                                        <div class="flex items-center">
                                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-yellow-600 h-2 rounded-full" style="width: 22%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">22%</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Logam</span>
                                        <div class="flex items-center">
                                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-red-600 h-2 rounded-full" style="width: 10%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">10%</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-900">Elektronik</span>
                                        <div class="flex items-center">
                                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-purple-600 h-2 rounded-full" style="width: 5%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">5%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Top Products -->
                            <div class="admin-card p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Produk Terlaris</h4>
                                <div class="space-y-3">
                                    <template x-for="product in topProducts" :key="product.id">
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div class="flex items-center">
                                                <img :src="product.image" :alt="product.name" class="w-10 h-10 rounded object-cover mr-3">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900" x-text="product.name"></p>
                                                    <p class="text-xs text-gray-500" x-text="product.category"></p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-medium text-green-600" x-text="product.sold + ' terjual'"></p>
                                                <p class="text-xs text-gray-500" x-text="'Rating: ' + product.rating"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Inventory Status -->
                        <div class="admin-card mt-6">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-900">Status Inventori</h4>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="text-center p-4 bg-green-50 rounded-lg">
                                        <i class="fas fa-check-circle text-green-600 text-2xl mb-2"></i>
                                        <p class="text-sm font-medium text-gray-900">Stok Aman</p>
                                        <p class="text-2xl font-bold text-green-600">189</p>
                                        <p class="text-xs text-gray-500">Produk</p>
                                    </div>
                                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl mb-2"></i>
                                        <p class="text-sm font-medium text-gray-900">Stok Menipis</p>
                                        <p class="text-2xl font-bold text-yellow-600">45</p>
                                        <p class="text-xs text-gray-500">Produk</p>
                                    </div>
                                    <div class="text-center p-4 bg-red-50 rounded-lg">
                                        <i class="fas fa-times-circle text-red-600 text-2xl mb-2"></i>
                                        <p class="text-sm font-medium text-gray-900">Stok Habis</p>
                                        <p class="text-2xl font-bold text-red-600">13</p>
                                        <p class="text-xs text-gray-500">Produk</p>
                                    </div>
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
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                                        <input type="text" x-model="editingProduct.sku" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                        <input type="text" x-model="editingProduct.brand" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
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
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Diskon</label>
                                        <input type="number" x-model="editingProduct.discountPrice" placeholder="Opsional"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                        <input type="number" x-model="editingProduct.stock" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Berat (gram)</label>
                                        <input type="number" x-model="editingProduct.weight" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </div>
                                
                    <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                    <textarea x-model="editingProduct.description" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                        <select x-model="editingProduct.status" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="active">Aktif</option>
                                            <option value="inactive">Nonaktif</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Seller</label>
                                        <input type="text" x-model="editingProduct.seller" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                                    <input type="url" x-model="editingProduct.image" placeholder="https://example.com/image.jpg"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
    </div>

                            <div class="flex gap-3 mt-6">
                                <button type="submit" class="btn-primary flex-1 btn-interactive">
                                    <i class="fas fa-save mr-2"></i>Update Produk
                </button>
                                <button type="button" @click="showEditProduct = false" class="btn-danger flex-1 btn-interactive">
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
        function adminApp() {
            return {
                sidebarOpen: false,
                active: 'dashboard',
                
                // Modal States - All set to false initially
                showAddProduct: false,
                showEditProduct: false,
                showProductDetail: false,
                showAnalytics: false,
                showBulkUpload: false,
                showInventory: false,
                showReports: false,
                showVouchers: false,
                showReviews: false,
                showShipping: false,
                showSettings: false,
                showNewOrders: false,
                showShippingTracking: false,
                showPaymentTracking: false,
                showOrderConfirmation: false,
                showCatalogAnalytics: false,
                showBulkUpdate: false,
                
                // Initialize tracking with first order
                initTracking() {
                    if (this.orders.length > 0 && !this.selectedOrder) {
                        this.selectedOrder = this.orders[0];
                    }
                },
                
                // Catalog States
                catalogSearch: '',
                catalogCategory: '',
                catalogStatus: '',
                catalogCurrentPage: 1,
                catalogPerPage: 12,
                selectedProduct: {
                    id: 1,
                    name: 'Tas Kreasi Daur Ulang',
                    sku: 'TK-001',
                    category: 'Aksesoris',
                    brand: 'Wugis',
                    price: 20000,
                    discountPrice: 18000,
                    stock: 45,
                    sold: 156,
                    rating: 4.5,
                    status: 'active',
                    description: 'Tas kreasi daur ulang yang ramah lingkungan',
                    image: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=60&q=80',
                    seller: 'Wugis'
                },
                
                // Orders States
                orderSearch: '',
                orderStatus: '',
                
                // Customers States
                customerSearch: '',
                customerFilter: '',
                
                // Product States
                productSearch: '',
                productCategory: '',
                productStatus: '',
                
                // Order Management States
                selectedOrder: {
                    id: 1,
                    orderId: 'ORD-001',
                    date: '2024-01-15',
                    customerName: 'John Doe',
                    customerEmail: 'john@example.com',
                    customerPhone: '+628123456789',
                    customerAddress: 'Jl. Contoh No. 123, Jakarta',
                    productImage: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=60&q=80',
                    productName: 'Tas Kreasi Daur Ulang',
                    quantity: 2,
                    total: 36000,
                    paymentMethod: 'Transfer Bank',
                    paymentStatus: 'Lunas',
                    status: 'pending',
                    shippingStatus: 'packed'
                },
                
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
                    image: '',
                    seller: ''
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
                    image: '',
                    seller: ''
                },
                
                // Sample Products Data
                products: [
                    {
                        id: 1,
                        name: 'Tas Kreasi Daur Ulang',
                        sku: 'TK-001',
                        category: 'Aksesoris',
                        brand: 'EcoCraft',
                        price: 20000,
                        discountPrice: 18000,
                        stock: 45,
                        sold: 156,
                        rating: 4.8,
                        status: 'active',
                        description: 'Tas cantik hasil daur ulang plastik dengan desain unik',
                        image: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=400&q=80',
                        seller: 'Wugis',
                        weight: 250
                    },
                    {
                        id: 2,
                        name: 'Botol Plastik Daur Ulang',
                        sku: 'BP-002',
                        category: 'Plastik',
                        brand: 'RecyclePro',
                        price: 15000,
                        discountPrice: null,
                        stock: 120,
                        sold: 89,
                        rating: 4.9,
                        status: 'active',
                        description: 'Botol minuman hasil daur ulang plastik berkualitas tinggi',
                        image: 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=400&q=80',
                        seller: 'RecyclePro',
                        weight: 500
                    },
                    {
                        id: 3,
                        name: 'Kertas Bekas Premium',
                        sku: 'KB-003',
                        category: 'Kertas',
                        brand: 'PaperCraft',
                        price: 25000,
                        discountPrice: null,
                        stock: 30,
                        sold: 67,
                        rating: 4.7,
                        status: 'pending',
                        description: 'Kertas berkualitas tinggi hasil daur ulang kertas bekas',
                        image: 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=400&q=80',
                        seller: 'PaperCraft',
                        weight: 1000
                    },
                    {
                        id: 4,
                        name: 'Sepatu Sport Pro',
                        sku: 'SS-004',
                        category: 'Aksesoris',
                        brand: 'SportRecycle',
                        price: 450000,
                        discountPrice: null,
                        stock: 0,
                        sold: 567,
                        rating: 4.6,
                        status: 'inactive',
                        description: 'Sepatu olahraga hasil daur ulang dengan teknologi cushioning',
                        image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=400&q=80',
                        seller: 'FashionHub',
                        weight: 800
                    }
                ],
                
                // Sample Orders Data
                orders: [
                    {
                        id: 1,
                        orderId: 'ORD-001',
                        customerName: 'Ahmad Rahman',
                        customerEmail: 'ahmad@email.com',
                        customerPhone: '+62 812-3456-7890',
                        customerAddress: 'Jl. Sudirman No. 123, Jakarta Pusat',
                        productName: 'Tas Kreasi Daur Ulang',
                        productImage: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=40&q=80',
                        quantity: 2,
                        total: 36000,
                        status: 'delivered',
                        shippingStatus: 'delivered',
                        paymentMethod: 'Transfer Bank BCA',
                        paymentStatus: 'Lunas',
                        date: '2024-01-15'
                    },
                    {
                        id: 2,
                        orderId: 'ORD-002',
                        customerName: 'Siti Nurhaliza',
                        customerEmail: 'siti@email.com',
                        customerPhone: '+62 813-4567-8901',
                        customerAddress: 'Jl. Thamrin No. 45, Jakarta Selatan',
                        productName: 'Botol Plastik Daur Ulang',
                        productImage: 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=40&q=80',
                        quantity: 1,
                        total: 15000,
                        status: 'shipped',
                        shippingStatus: 'shipped',
                        paymentMethod: 'E-Wallet OVO',
                        paymentStatus: 'Lunas',
                        date: '2024-01-14'
                    },
                    {
                        id: 3,
                        orderId: 'ORD-003',
                        customerName: 'Budi Santoso',
                        customerEmail: 'budi@email.com',
                        customerPhone: '+62 814-5678-9012',
                        customerAddress: 'Jl. Gatot Subroto No. 67, Jakarta Barat',
                        productName: 'Kertas Bekas Premium',
                        productImage: 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=40&q=80',
                        quantity: 3,
                        total: 75000,
                        status: 'processing',
                        shippingStatus: 'packed',
                        paymentMethod: 'Transfer Bank Mandiri',
                        paymentStatus: 'Lunas',
                        date: '2024-01-13'
                    },
                    {
                        id: 4,
                        orderId: 'ORD-004',
                        customerName: 'Dewi Sartika',
                        customerEmail: 'dewi@email.com',
                        customerPhone: '+62 815-6789-0123',
                        customerAddress: 'Jl. Sudirman No. 89, Jakarta Utara',
                        productName: 'Sepatu Sport Pro',
                        productImage: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=40&q=80',
                        quantity: 1,
                        total: 450000,
                        status: 'pending',
                        shippingStatus: 'pending',
                        paymentMethod: 'COD (Cash on Delivery)',
                        paymentStatus: 'Menunggu Pembayaran',
                        date: '2024-01-12'
                    }
                ],
                
                // Sample Customers Data
                customers: [
                    {
                        id: 1,
                        name: 'Ahmad Rahman',
                        email: 'ahmad@email.com',
                        phone: '+62 812-3456-7890',
                        avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=40&q=80',
                        totalOrders: 15,
                        totalSpent: 1250000,
                        status: 'active',
                        registeredDate: '2023-06-15'
                    },
                    {
                        id: 2,
                        name: 'Siti Nurhaliza',
                        email: 'siti@email.com',
                        phone: '+62 813-4567-8901',
                        avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?auto=format&fit=crop&w=40&q=80',
                        totalOrders: 8,
                        totalSpent: 890000,
                        status: 'vip',
                        registeredDate: '2023-08-22'
                    },
                    {
                        id: 3,
                        name: 'Budi Santoso',
                        email: 'budi@email.com',
                        phone: '+62 814-5678-9012',
                        avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=40&q=80',
                        totalOrders: 23,
                        totalSpent: 2100000,
                        status: 'active',
                        registeredDate: '2023-04-10'
                    },
                    {
                        id: 4,
                        name: 'Dewi Sartika',
                        email: 'dewi@email.com',
                        phone: '+62 815-6789-0123',
                        avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=40&q=80',
                        totalOrders: 5,
                        totalSpent: 450000,
                        status: 'inactive',
                        registeredDate: '2023-11-05'
                    }
                ],
                
                init() {
                    // Initialize sidebar state
                    this.sidebarOpen = false;
                    this.initPage();
                    
                    // Ensure all modals are closed on page load
                    this.showReports = false;
                    this.showNewOrders = false;
                    this.showShippingTracking = false;
                    this.showPaymentTracking = false;
                    this.showOrderConfirmation = false;
                    this.showAnalytics = false;
                    this.showAddProduct = false;
                    this.showEditProduct = false;
                    this.showProductDetail = false;
                    this.showBulkUpload = false;
                    this.showInventory = false;
                    this.showCatalogAnalytics = false;
                    this.showBulkUpdate = false;
                },
                
                // Computed Properties
                get filteredCatalogProducts() {
                    let filtered = this.products;
                    
                    // Search filter
                    if (this.catalogSearch) {
                        filtered = filtered.filter(product => 
                            product.name.toLowerCase().includes(this.catalogSearch.toLowerCase()) ||
                            product.sku.toLowerCase().includes(this.catalogSearch.toLowerCase()) ||
                            product.description.toLowerCase().includes(this.catalogSearch.toLowerCase())
                        );
                    }
                    
                    // Category filter
                    if (this.catalogCategory) {
                        filtered = filtered.filter(product => product.category === this.catalogCategory);
                    }
                    
                    // Status filter
                    if (this.catalogStatus) {
                        filtered = filtered.filter(product => product.status === this.catalogStatus);
                    }
                    
                    return filtered;
                },
                
                get catalogTotalPages() {
                    return Math.ceil(this.filteredCatalogProducts.length / this.catalogPerPage);
                },
                
                get catalogPages() {
                    const pages = [];
                    for (let i = 1; i <= this.catalogTotalPages; i++) {
                        pages.push(i);
                    }
                    return pages;
                },
                
                get catalogStartIndex() {
                    return (this.catalogCurrentPage - 1) * this.catalogPerPage;
                },
                
                get catalogEndIndex() {
                    return Math.min(this.catalogStartIndex + this.catalogPerPage, this.filteredCatalogProducts.length);
                },
                
                get filteredOrders() {
                    let filtered = this.orders;
                    
                    // Search filter
                    if (this.orderSearch) {
                        filtered = filtered.filter(order => 
                            order.orderId.toLowerCase().includes(this.orderSearch.toLowerCase()) ||
                            order.customerName.toLowerCase().includes(this.orderSearch.toLowerCase()) ||
                            order.productName.toLowerCase().includes(this.orderSearch.toLowerCase())
                        );
                    }
                    
                    // Status filter
                    if (this.orderStatus) {
                        filtered = filtered.filter(order => order.status === this.orderStatus);
                    }
                    
                    return filtered;
                },
                
                get filteredCustomers() {
                    let filtered = this.customers;
                    
                    // Search filter
                    if (this.customerSearch) {
                        filtered = filtered.filter(customer => 
                            customer.name.toLowerCase().includes(this.customerSearch.toLowerCase()) ||
                            customer.email.toLowerCase().includes(this.customerSearch.toLowerCase())
                        );
                    }
                    
                    // Status filter
                    if (this.customerFilter) {
                        filtered = filtered.filter(customer => customer.status === this.customerFilter);
                    }
                    
                    return filtered;
                },
                
                get newOrders() {
                    return this.orders.filter(order => order.status === 'pending' || order.status === 'processing');
                },
                
                get pendingOrders() {
                    return this.orders.filter(order => order.status === 'pending');
                },
                
                get filteredProducts() {
                    let filtered = this.products;
                    
                    // Search filter
                    if (this.productSearch) {
                        filtered = filtered.filter(product => 
                            product.name.toLowerCase().includes(this.productSearch.toLowerCase()) ||
                            product.sku.toLowerCase().includes(this.productSearch.toLowerCase()) ||
                            product.description.toLowerCase().includes(this.productSearch.toLowerCase())
                        );
                    }
                    
                    // Category filter
                    if (this.productCategory) {
                        filtered = filtered.filter(product => product.category === this.productCategory);
                    }
                    
                    // Status filter
                    if (this.productStatus) {
                        filtered = filtered.filter(product => product.status === this.productStatus);
                    }
                    
                    return filtered;
                },
                
                get topProducts() {
                    return this.products
                        .sort((a, b) => b.sold - a.sold)
                        .slice(0, 5);
                },
                
                get filteredCatalogProducts() {
                    let filtered = this.products;
                    
                    // Search filter
                    if (this.catalogSearch) {
                        filtered = filtered.filter(product => 
                            product.name.toLowerCase().includes(this.catalogSearch.toLowerCase()) ||
                            product.sku.toLowerCase().includes(this.catalogSearch.toLowerCase()) ||
                            product.description.toLowerCase().includes(this.catalogSearch.toLowerCase())
                        );
                    }
                    
                    // Category filter
                    if (this.catalogCategory) {
                        filtered = filtered.filter(product => product.category === this.catalogCategory);
                    }
                    
                    // Status filter
                    if (this.catalogStatus) {
                        filtered = filtered.filter(product => product.status === this.catalogStatus);
                    }
                    
                    return filtered;
                },
                
                get catalogTotalPages() {
                    return Math.ceil(this.filteredCatalogProducts.length / this.catalogPerPage);
                },
                
                get catalogStartIndex() {
                    return (this.catalogCurrentPage - 1) * this.catalogPerPage;
                },
                
                get catalogEndIndex() {
                    return Math.min(this.catalogStartIndex + this.catalogPerPage, this.filteredCatalogProducts.length);
                },
                
                get catalogPages() {
                    const pages = [];
                    for (let i = 1; i <= this.catalogTotalPages; i++) {
                        pages.push(i);
                    }
                    return pages;
                },
                
                get shippingSteps() {
                    if (!this.selectedOrder) return [];
                    
                    const steps = [
                        {
                            title: 'Pesanan Diterima',
                            description: 'Pesanan telah diterima dan sedang diproses',
                            time: this.selectedOrder?.date || '',
                            completed: true,
                            icon: 'fas fa-check'
                        },
                        {
                            title: 'Pembayaran Dikonfirmasi',
                            description: 'Pembayaran telah dikonfirmasi',
                            time: this.selectedOrder?.date || '',
                            completed: this.selectedOrder?.paymentStatus === 'Lunas',
                            icon: 'fas fa-credit-card'
                        },
                        {
                            title: 'Produk Dikemas',
                            description: 'Produk sedang dikemas untuk pengiriman',
                            time: this.selectedOrder?.shippingStatus === 'packed' ? 'Hari ini' : '-',
                            completed: ['packed', 'shipped', 'delivered'].includes(this.selectedOrder?.shippingStatus || ''),
                            icon: 'fas fa-box'
                        },
                        {
                            title: 'Produk Dikirim',
                            description: 'Produk telah dikirim ke pelanggan',
                            time: this.selectedOrder?.shippingStatus === 'shipped' ? 'Hari ini' : '-',
                            completed: ['shipped', 'delivered'].includes(this.selectedOrder?.shippingStatus || ''),
                            icon: 'fas fa-shipping-fast'
                        },
                        {
                            title: 'Produk Diterima',
                            description: 'Produk telah diterima pelanggan',
                            time: this.selectedOrder?.shippingStatus === 'delivered' ? 'Hari ini' : '-',
                            completed: this.selectedOrder?.shippingStatus === 'delivered',
                            icon: 'fas fa-home'
                        }
                    ];
                    
                    return steps;
                },
                
                // Navigation Methods
                setActive(page) {
                    this.active = page;
                },
                
                // Initialize page based on URL or default to dashboard
                initPage() {
                    const urlParams = new URLSearchParams(window.location.search);
                    const page = urlParams.get('page') || 'dashboard';
                    this.active = page;
                },
                
                // Catalog Methods
                viewProductDetail(product) {
                    this.selectedProduct = product;
                    this.showProductDetail = true;
                },
                
                resetCatalogFilters() {
                    this.catalogSearch = '';
                    this.catalogCategory = '';
                    this.catalogStatus = '';
                    this.catalogCurrentPage = 1;
                },
                
                resetProductFilters() {
                    this.productSearch = '';
                    this.productCategory = '';
                    this.productStatus = '';
                },
                
                catalogPrevPage() {
                    if (this.catalogCurrentPage > 1) {
                        this.catalogCurrentPage--;
                    }
                },
                
                catalogNextPage() {
                    if (this.catalogCurrentPage < this.catalogTotalPages) {
                        this.catalogCurrentPage++;
                    }
                },
                
                catalogGoToPage(page) {
                    this.catalogCurrentPage = page;
                },
                
                // Utility Methods
                formatNumber(num) {
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
                
                // Orders Methods
                selectOrder(order) {
                    this.selectedOrder = order;
                },
                
                viewOrderDetail(order) {
                    this.selectedOrder = order;
                    this.showNewOrders = true;
                },
                
                selectOrder(order) {
                    this.selectedOrder = order;
                },
                
                processOrder(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        // Add loading state
                        const button = event.target.closest('button');
                        const originalText = button.innerHTML;
                        button.classList.add('btn-loading');
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                        
                        // Simulate processing
                        setTimeout(() => {
                            order.status = 'processing';
                            order.shippingStatus = 'packed';
                            button.classList.remove('btn-loading');
                            button.innerHTML = originalText;
                            
                            // Show success notification
                            this.showNotification('Pesanan berhasil diproses!', 'success');
                        }, 1500);
                    }
                },
                
                generateInvoice(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const invoiceData = {
                            invoiceNumber: 'INV-' + order.orderId,
                            orderId: order.orderId,
                            customerName: order.customerName,
                            customerEmail: order.customerEmail,
                            customerAddress: order.customerAddress,
                            productName: order.productName,
                            quantity: order.quantity,
                            total: order.total,
                            paymentMethod: order.paymentMethod,
                            date: order.date
                        };
                        
                        const dataStr = JSON.stringify(invoiceData, null, 2);
                        const dataBlob = new Blob([dataStr], {type: 'application/json'});
                        const url = URL.createObjectURL(dataBlob);
                        
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'invoice_' + order.orderId + '.json';
                        link.click();
                        
                        this.showNotification('Invoice berhasil di-generate!', 'success');
                    }
                },
                
                completeOrder(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const button = event.target.closest('button');
                        const originalText = button.innerHTML;
                        button.classList.add('btn-loading');
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyelesaikan...';
                        
                        setTimeout(() => {
                            order.status = 'delivered';
                            order.shippingStatus = 'delivered';
                            order.paymentStatus = 'Lunas';
                            
                            // Update product stock
                            const product = this.products.find(p => p.name === order.productName);
                            if (product) {
                                product.stock = Math.max(0, product.stock - order.quantity);
                                product.sold += order.quantity;
                            }
                            
                            button.classList.remove('btn-loading');
                            button.innerHTML = originalText;
                            this.showNotification('Pesanan berhasil diselesaikan!', 'success');
                        }, 2000);
                    }
                },
                

                
                updateShippingStatus(status) {
                    if (this.selectedOrder) {
                        const button = event.target.closest('button');
                        const originalText = button.innerHTML;
                        button.classList.add('btn-loading');
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
                        
                        setTimeout(() => {
                            this.selectedOrder.shippingStatus = status;
                            if (status === 'delivered') {
                                this.selectedOrder.status = 'delivered';
                            }
                            button.classList.remove('btn-loading');
                            button.innerHTML = originalText;
                            
                            this.showNotification('Status pengiriman berhasil diupdate!', 'success');
                        }, 1000);
                    }
                },
                
                initTracking() {
                    // Initialize tracking with first order
                    if (this.orders.length > 0 && !this.selectedOrder) {
                        this.selectedOrder = this.orders[0];
                    }
                },
                
                refreshTracking() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('animate-spin');
                    
                    setTimeout(() => {
                        button.classList.remove('animate-spin');
                        this.showNotification('Data tracking berhasil diperbarui!', 'success');
                    }, 1000);
                },
                
                exportReport() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
                    
                    setTimeout(() => {
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showNotification('Laporan berhasil di-export!', 'success');
                    }, 2000);
                },
                
                exportCatalog() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
                    
                    setTimeout(() => {
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showNotification('Katalog berhasil di-export!', 'success');
                    }, 2000);
                },
                
                // Notification System
                showNotification(message, type = 'info') {
                    // Create notification element
                    const notification = document.createElement('div');
                    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
                    
                    // Set notification styles based on type
                    switch(type) {
                        case 'success':
                            notification.className += ' bg-green-500 text-white';
                            break;
                        case 'error':
                            notification.className += ' bg-red-500 text-white';
                            break;
                        case 'warning':
                            notification.className += ' bg-yellow-500 text-white';
                            break;
                        default:
                            notification.className += ' bg-blue-500 text-white';
                    }
                    
                    notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'} mr-2"></i>
                            <span>${message}</span>
                        </div>
                    `;
                    
                    // Add to page
                    document.body.appendChild(notification);
                    
                    // Animate in
                    setTimeout(() => {
                        notification.classList.remove('translate-x-full');
                    }, 100);
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        notification.classList.add('translate-x-full');
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 300);
                    }, 3000);
                },
                
                updateOrderStatus(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const button = event.target.closest('button');
                        const originalText = button.innerHTML;
                        button.classList.add('btn-loading');
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Updating...';
                        
                        setTimeout(() => {
                            const statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                            const currentIndex = statuses.indexOf(order.status);
                            const nextStatus = statuses[(currentIndex + 1) % statuses.length];
                            order.status = nextStatus;
                            
                            button.classList.remove('btn-loading');
                            button.innerHTML = originalText;
                            this.showNotification('Status pesanan berhasil diupdate!', 'success');
                        }, 1000);
                    }
                },
                
                exportOrders() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
                    
                    setTimeout(() => {
                        const ordersData = {
                            timestamp: new Date().toISOString(),
                            totalOrders: this.orders.length,
                            orders: this.filteredOrders
                        };
                        
                        const dataStr = JSON.stringify(ordersData, null, 2);
                        const dataBlob = new Blob([dataStr], {type: 'application/json'});
                        const url = URL.createObjectURL(dataBlob);
                        
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'orders_' + new Date().toISOString().split('T')[0] + '.json';
                        link.click();
                        
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showNotification('Data pesanan berhasil diexport!', 'success');
                    }, 1000);
                },
                
                // Customers Methods
                viewCustomerDetail(customer) {
                    alert('Detail pelanggan: ' + customer.name);
                },
                
                editCustomer(customerId) {
                    const customer = this.customers.find(c => c.id === customerId);
                    if (customer) {
                        alert('Edit pelanggan: ' + customer.name);
                    }
                },
                
                exportCustomers() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
                    
                    setTimeout(() => {
                        const customersData = {
                            timestamp: new Date().toISOString(),
                            totalCustomers: this.customers.length,
                            customers: this.filteredCustomers
                        };
                        
                        const dataStr = JSON.stringify(customersData, null, 2);
                        const dataBlob = new Blob([dataStr], {type: 'application/json'});
                        const url = URL.createObjectURL(dataBlob);
                        
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'customers_' + new Date().toISOString().split('T')[0] + '.json';
                        link.click();
                        
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showNotification('Data pelanggan berhasil diexport!', 'success');
                    }, 1000);
                },
                
                // Product Methods
                addProduct() {
                    if (!this.newProduct.name || !this.newProduct.sku || !this.newProduct.price || !this.newProduct.stock) {
                        alert('Mohon lengkapi semua field yang diperlukan!');
                        return;
                    }
                    
                    // Generate new ID
                    const newId = Math.max(...this.products.map(p => p.id)) + 1;
                    
                    // Add new product to the products array
                    const newProductData = {
                        id: newId,
                        name: this.newProduct.name,
                        sku: this.newProduct.sku,
                        category: this.newProduct.category,
                        brand: this.newProduct.brand,
                        price: parseInt(this.newProduct.price),
                        discountPrice: this.newProduct.discountPrice ? parseInt(this.newProduct.discountPrice) : null,
                        stock: parseInt(this.newProduct.stock),
                        sold: 0,
                        rating: 0,
                        status: this.newProduct.status,
                        description: this.newProduct.description,
                        image: this.newProduct.image || 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=400&q=80',
                        seller: this.newProduct.seller || 'Admin',
                        weight: parseInt(this.newProduct.weight) || 0
                    };
                    
                    this.products.push(newProductData);
                    this.showNotification('Produk berhasil ditambahkan!', 'success');
                    this.showAddProduct = false;
                    this.resetProductForm();
                },
                
                editProduct(productId) {
                    // Find product in the products array
                    const product = this.products.find(p => p.id === productId);
                    if (product) {
                        this.editingProduct = {
                            id: product.id,
                            name: product.name,
                            sku: product.sku,
                            category: product.category,
                            brand: product.brand,
                            price: product.price.toString(),
                            discountPrice: product.discountPrice ? product.discountPrice.toString() : '',
                            stock: product.stock.toString(),
                            weight: product.weight.toString(),
                            status: product.status,
                            description: product.description,
                            image: product.image,
                            seller: product.seller
                        };
                        this.showEditProduct = true;
                    }
                },
                
                duplicateProduct(productId) {
                    if (confirm('Apakah Anda yakin ingin menduplikasi produk ini?')) {
                        console.log('Duplicating product:', productId);
                        alert('Produk berhasil diduplikasi!');
                    }
                },
                
                updateProduct() {
                    if (!this.editingProduct.name || !this.editingProduct.sku || !this.editingProduct.price || !this.editingProduct.stock) {
                        this.showNotification('Mohon lengkapi semua field yang diperlukan!', 'error');
                        return;
                    }
                    
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
                    
                    setTimeout(() => {
                        // Update product in the products array
                        const index = this.products.findIndex(p => p.id === this.editingProduct.id);
                        if (index !== -1) {
                            this.products[index] = {
                                ...this.products[index],
                                name: this.editingProduct.name,
                                sku: this.editingProduct.sku,
                                category: this.editingProduct.category,
                                brand: this.editingProduct.brand,
                                price: parseInt(this.editingProduct.price),
                                discountPrice: this.editingProduct.discountPrice ? parseInt(this.editingProduct.discountPrice) : null,
                                stock: parseInt(this.editingProduct.stock),
                                weight: parseInt(this.editingProduct.weight),
                                status: this.editingProduct.status,
                                description: this.editingProduct.description,
                                image: this.editingProduct.image,
                                seller: this.editingProduct.seller
                            };
                            
                            button.classList.remove('btn-loading');
                            button.innerHTML = originalText;
                            this.showNotification('Produk berhasil diperbarui!', 'success');
                            this.showEditProduct = false;
                            this.resetEditingForm();
                        }
                    }, 1500);
                },
                
                deleteProduct(productId) {
                    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                        const button = event.target.closest('button');
                        const originalText = button.innerHTML;
                        button.classList.add('btn-loading');
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menghapus...';
                        
                        setTimeout(() => {
                            const index = this.products.findIndex(p => p.id === productId);
                            if (index !== -1) {
                                this.products.splice(index, 1);
                                button.classList.remove('btn-loading');
                                button.innerHTML = originalText;
                                this.showNotification('Produk berhasil dihapus!', 'success');
                            }
                        }, 1000);
                    }
                },
                
                // Export Methods
                exportReport() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
                    
                    setTimeout(() => {
                        const reportData = {
                            timestamp: new Date().toISOString(),
                            dashboard: {
                                totalProducts: this.products.length,
                                totalOrders: this.orders.length,
                                totalCustomers: this.customers.length,
                                revenue: this.orders.reduce((sum, order) => sum + order.total, 0)
                            },
                            products: this.products,
                            orders: this.orders,
                            customers: this.customers
                        };
                        
                        const dataStr = JSON.stringify(reportData, null, 2);
                        const dataBlob = new Blob([dataStr], {type: 'application/json'});
                        const url = URL.createObjectURL(dataBlob);
                        
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'dashboard_report_' + new Date().toISOString().split('T')[0] + '.json';
                        link.click();
                        
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showNotification('Laporan berhasil diexport!', 'success');
                    }, 1500);
                },
                
                exportProducts() {
                    console.log('Exporting products...');
                    alert('Data produk berhasil diexport!');
                },
                
                exportCatalog() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
                    
                    setTimeout(() => {
                        const catalogData = {
                            timestamp: new Date().toISOString(),
                            totalProducts: this.products.length,
                            products: this.filteredCatalogProducts
                        };
                        
                        const dataStr = JSON.stringify(catalogData, null, 2);
                        const dataBlob = new Blob([dataStr], {type: 'application/json'});
                        const url = URL.createObjectURL(dataBlob);
                        
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'catalog_' + new Date().toISOString().split('T')[0] + '.json';
                        link.click();
                        
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showNotification('Katalog berhasil diexport!', 'success');
                    }, 1000);
                },
                
                // Analytics Methods
                showAnalytics() {
                    this.showAnalytics = true;
                },
                
                // Bulk Upload Methods
                showBulkUpload() {
                    this.showBulkUpload = true;
                },
                
                // Inventory Methods
                showInventory() {
                    this.showInventory = true;
                },
                
                saveInventoryChanges() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                    
                    setTimeout(() => {
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showInventory = false;
                        this.showNotification('Stok berhasil diupdate!', 'success');
                    }, 1500);
                },
                
                // Reports Methods
                showReports() {
                    this.showReports = true;
                },
                
                // Bulk Update Methods
                showBulkUpdate() {
                    this.showBulkUpdate = true;
                },
                
                updateBulkOrders() {
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.classList.add('btn-loading');
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
                    
                    setTimeout(() => {
                        button.classList.remove('btn-loading');
                        button.innerHTML = originalText;
                        this.showBulkUpdate = false;
                        this.showNotification('Pesanan berhasil diupdate secara massal!', 'success');
                    }, 2000);
                },
                
                // Payment Tracking Methods
                confirmPayment(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const button = event.target.closest('button');
                        const originalText = button.innerHTML;
                        button.classList.add('btn-loading');
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Konfirmasi...';
                        
                        setTimeout(() => {
                            order.paymentStatus = 'Lunas';
                            button.classList.remove('btn-loading');
                            button.innerHTML = originalText;
                            this.showNotification('Pembayaran berhasil dikonfirmasi!', 'success');
                        }, 1000);
                    }
                },
                
                viewPaymentDetail(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const paymentDetail = {
                            orderId: order.orderId,
                            customerName: order.customerName,
                            customerEmail: order.customerEmail,
                            paymentMethod: order.paymentMethod,
                            amount: order.total,
                            status: order.paymentStatus,
                            date: order.date,
                            transactionId: 'TXN-' + Math.random().toString(36).substr(2, 9).toUpperCase()
                        };
                        
                        alert('Detail Pembayaran:\n' + JSON.stringify(paymentDetail, null, 2));
                    }
                },
                
                // Order Confirmation Methods
                approveOrder(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const button = event.target.closest('button');
                        const originalText = button.innerHTML;
                        button.classList.add('btn-loading');
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyetujui...';
                        
                        setTimeout(() => {
                            order.status = 'processing';
                            order.shippingStatus = 'packed';
                            button.classList.remove('btn-loading');
                            button.innerHTML = originalText;
                            this.showNotification('Pesanan berhasil disetujui!', 'success');
                        }, 1500);
                    }
                },
                
                rejectOrder(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const reason = prompt('Alasan penolakan:');
                        if (reason) {
                            const button = event.target.closest('button');
                            const originalText = button.innerHTML;
                            button.classList.add('btn-loading');
                            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menolak...';
                            
                            setTimeout(() => {
                                order.status = 'cancelled';
                                button.classList.remove('btn-loading');
                                button.innerHTML = originalText;
                                this.showNotification('Pesanan berhasil ditolak!', 'error');
                            }, 1000);
                        }
                    }
                },
                
                requestMoreInfo(orderId) {
                    const order = this.orders.find(o => o.id === orderId);
                    if (order) {
                        const info = prompt('Informasi yang diperlukan:');
                        if (info) {
                            this.showNotification('Permintaan informasi telah dikirim ke pelanggan!', 'info');
                        }
                    }
                },
                
                // Enhanced Tracking Methods
                refreshTracking() {
                    const button = event.target.closest('button');
                    button.classList.add('animate-spin');
                    
                    setTimeout(() => {
                        button.classList.remove('animate-spin');
                        this.showNotification('Data tracking berhasil diperbarui!', 'success');
                    }, 1000);
                },
                
                // Form Reset Methods
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
                        image: '',
                        seller: ''
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
                        image: '',
                        seller: ''
                    };
                }
            }
        }
        
        // Initialize Charts
        function initCharts() {
            // Sales Chart
            const salesCtx = document.getElementById('salesChart');
            if (salesCtx) {
                const salesChart = new Chart(salesCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Penjualan (Juta)',
                            data: [2.5, 3.2, 4.1, 3.8, 4.5, 5.2],
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            tension: 0.4,
                            fill: true
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
            }
            
            // Category Chart
            const categoryCtx = document.getElementById('categoryChart');
            if (categoryCtx) {
                const categoryChart = new Chart(categoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Aksesoris', 'Plastik', 'Kertas', 'Logam', 'Elektronik'],
                        datasets: [{
                            data: [35, 28, 22, 10, 5],
                            backgroundColor: [
                                '#667eea',
                                '#10b981',
                                '#f59e0b',
                                '#ef4444',
                                '#8b5cf6'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true
                                }
                            }
                        }
                    }
                });
            }
        }
        
        // Initialize charts when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Load Chart.js from CDN
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
            script.onload = function() {
                setTimeout(initCharts, 1000);
            };
            document.head.appendChild(script);
        });
            </script>
        
        <script>
            // Direct button event listeners
            document.addEventListener('DOMContentLoaded', function() {
                // Wait for Alpine.js to be ready
                setTimeout(() => {
                    // Get Alpine component
                    const alpineComponent = document.querySelector('[x-data="adminApp()"]');
                    
                    if (alpineComponent && alpineComponent.__x) {
                        const alpineData = alpineComponent.__x.$data;
                        
                        // Direct event listeners for specific buttons
                        const pesananBtn = document.getElementById('pesanan-masuk-btn');
                        if (pesananBtn) {
                            pesananBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                alpineData.showNewOrders = true;
                            });
                        }
                        
                        const trackingBtn = document.getElementById('tracking-btn');
                        if (trackingBtn) {
                            trackingBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                alpineData.showShippingTracking = true;
                            });
                        }
                        
                        const analitikBtn = document.getElementById('analitik-detail-btn');
                        if (analitikBtn) {
                            analitikBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                alpineData.showAnalytics = true;
                            });
                        }
                        
                        // Orders page buttons
                        const trackingPembayaranBtn = document.getElementById('tracking-pembayaran-btn');
                        if (trackingPembayaranBtn) {
                            trackingPembayaranBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                alpineData.showPaymentTracking = true;
                            });
                        }
                        
                        const konfirmasiPesananBtn = document.getElementById('konfirmasi-pesanan-btn');
                        if (konfirmasiPesananBtn) {
                            konfirmasiPesananBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                alpineData.showOrderConfirmation = true;
                            });
                        }
                        
                        const trackingPengirimanBtn = document.getElementById('tracking-pengiriman-btn');
                        if (trackingPengirimanBtn) {
                            trackingPengirimanBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                alpineData.showShippingTracking = true;
                            });
                        }
                        
                        const updateMassalBtn = document.getElementById('update-massal-btn');
                        if (updateMassalBtn) {
                            updateMassalBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                alpineData.showBulkUpdate = true;
                            });
                        }
                        
                        // Generic click handler for other buttons
                        document.addEventListener('click', function(e) {
                            if (e.target.closest('button')) {
                                const button = e.target.closest('button');
                                const buttonText = button.textContent.trim();
                                
                                // Tambah Produk button
                                if (buttonText.includes('Tambah Produk')) {
                                    alpineData.showAddProduct = true;
                                }
                                
                                // Upload Massal button
                                if (buttonText.includes('Upload Massal')) {
                                    alpineData.showBulkUpload = true;
                                }
                                
                                // Orders button
                                if (buttonText.includes('Orders')) {
                                    alpineData.setActive('orders');
                                }
                            }
                        });
                    }
                }, 1000);
            });
        </script>
    @endsection 