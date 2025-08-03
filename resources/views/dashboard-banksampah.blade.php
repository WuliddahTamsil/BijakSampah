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
    
    /* Notifikasi Cards - Diperbagus */
    .notif-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #75E6DA, #05445E);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .card:hover::before {
        opacity: 1;
    }

    .card h4 {
        color: #0a3a60;
        font-weight: 600;
        font-size: 17px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card h4 i {
        color: #05445E;
        font-size: 20px;
    }

    .card p {
        font-size: 15px;
        color: #555;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: #777;
    }

    .card-actions {
        display: flex;
        gap: 10px;
    }

    .card-btn {
        background: none;
        border: none;
        color: #05445E;
        cursor: pointer;
        font-size: 14px;
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s;
    }

    .card-btn:hover {
        background: rgba(5, 68, 94, 0.1);
    }

    .card-btn.delete:hover {
        color: #FF5A5F;
    }

    /* Grafik dengan Animasi */
    .chart-section {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .chart-title {
        color: #0a3a60;
        font-weight: 700;
        font-size: 22px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chart-title i {
        color: #05445E;
        font-size: 24px;
    }

    .chart-sub {
        font-size: 15px;
        color: #777;
        margin-bottom: 30px;
    }
    
    .chart-content {
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        position: relative;
        height: 220px;
        padding-top: 40px;
        padding-bottom: 30px;
    }

    .chart-content::before {
        content: '';
        position: absolute;
        bottom: 30px;
        left: 0;
        width: 100%;
        height: 2px;
        background: #eee;
    }

    .chart-bar-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        min-width: 0;
        position: relative;
        height: var(--height);
        transition: height 0.3s ease;
    }

    .bar {
        width: 100%;
        max-width: 50px;
        background: linear-gradient(to top, #05445E, #189AB4);
        border-radius: 8px 8px 0 0;
        position: relative;
        height: 100%;
        transform: scaleY(0);
        transform-origin: bottom;
        animation: grow-scale 1.5s ease-out forwards;
        animation-delay: calc(var(--order) * 0.2s);
    }

    @keyframes grow-scale {
        from { transform: scaleY(0); }
        to { transform: scaleY(1); }
    }

    .bar-label {
        position: absolute;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 13px;
        font-weight: 600;
        background: white;
        padding: 6px 12px;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        white-space: nowrap;
        opacity: 0;
        animation: fadeIn 0.5s ease-out forwards;
        animation-delay: calc(var(--order) * 0.2s + 1s);
        color: #05445E;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(-50%) translateY(10px); }
        to { opacity: 1; transform: translateX(-50%) translateY(0); }
    }
    
    .day {
        position: absolute;
        bottom: -40px;
        width: 100%;
        text-align: center;
        font-size: 12px;
        color: #555;
    }

    /* Modal untuk CRUD */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        width: 90%;
        max-width: 500px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 22px;
        color: #05445E;
        font-weight: 700;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #777;
        transition: all 0.2s;
    }

    .close-modal:hover {
        color: #05445E;
        transform: rotate(90deg);
    }

    .modal-body {
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
    }

    .form-group input, 
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
    }

    .form-group input:focus, 
    .form-group textarea:focus {
        border-color: #75E6DA;
        outline: none;
        box-shadow: 0 0 0 3px rgba(117, 230, 218, 0.2);
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #05445E 0%, #0A3A60 100%);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0A3A60 0%, #05445E 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 68, 94, 0.3);
    }

    .btn-outline {
        background: white;
        border: 1px solid #ddd;
        color: #555;
    }

    .btn-outline:hover {
        background: #f5f5f5;
    }

    .btn-danger {
        background: #FF5A5F;
        color: white;
    }

    .btn-danger:hover {
        background: #e04a50;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 90, 95, 0.3);
    }

    /* Footer */
    .footer {
        text-align: center;
        margin-top: 50px;
        font-size: 14px;
        color: #666;
    }

    .footer strong {
        font-weight: 700;
        color: #05445E;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .notif-cards {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .notif-cards {
            grid-template-columns: 1fr;
        }
    }

    /* Enhanced Dashboard Styles */
    .stats-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }

    .activity-item {
        transition: all 0.2s ease;
    }

    .activity-item:hover {
        background-color: #f1f5f9;
        transform: translateX(4px);
    }

    .chart-container {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .chart-container:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    /* Animated progress bars */
    .progress-bar {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
        position: relative;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        border-radius: 2px;
        transition: width 1s ease;
        animation: progress-animation 2s ease-out;
    }

    @keyframes progress-animation {
        from { width: 0%; }
        to { width: var(--progress-width); }
    }

    /* Enhanced notifications */
    .notification-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }

    .notification-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .notification-card.urgent {
        border-left-color: #ef4444;
        background: linear-gradient(135deg, #fef2f2 0%, #ffffff 100%);
    }

    .notification-card.info {
        border-left-color: #3b82f6;
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
    }

    .notification-card.success {
        border-left-color: #10b981;
        background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%);
    }

    /* Floating action button */
    .fab {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .fab:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
    }
</style>

<div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="bankSampahApp()" x-init="init()">
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'dashboard-banksampah' }"
        x-ref="sidebar"
        @mouseenter="open = true; $root.sidebarOpen = true"
        @mouseleave="open = false; $root.sidebarOpen = false"
        class="fixed top-0 left-0 z-50 flex flex-col py-6 sidebar-hover overflow-hidden shadow-2xl group sidebar-gradient"
        :class="open ? 'w-64' : 'w-16'"
        style="transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); margin-top: 48px; height: calc(100vh - 48px);"
    >
        <div class="relative flex flex-col h-full w-full px-4">
            {{-- Logo Section --}}
            <div class="flex items-center justify-center mb-8 mt-2 sidebar-logo">
                <div x-show="open" class="flex items-center justify-center">
                    <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="w-16 h-auto">
                </div>
                <div x-show="!open" class="flex items-center justify-center">
                    <img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="w-6 h-6">
                </div>
            </div>
            
            {{-- Navigation Menu --}}
            <nav class="flex flex-col gap-2 w-full flex-1">
                {{-- Dashboard Link --}}
                <a href="{{ route('dashboard-banksampah') }}" class="flex items-center gap-3 p-3 font-medium sidebar-nav-item whitespace-nowrap w-full active" :class="open ? 'text-white' : 'text-white justify-center'">
                    <i class="fas fa-home text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Dashboard</span>
                </a>
                
                {{-- Nasabah Section --}}
                <div class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full cursor-pointer" :class="open ? (active === 'nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'nasabah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')" @click="active = active === 'nasabah' ? '' : 'nasabah'">
                    <i class="fas fa-users text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Nasabah</span>
                    <i x-show="open" class="fas fa-chevron-down text-xs ml-auto transition-transform" :class="active === 'nasabah' ? 'rotate-180' : ''"></i>
                </div>
                
                {{-- Sub-menu Nasabah --}}
                <div x-show="open && active === 'nasabah'" x-transition class="ml-4 space-y-1">
                    <a href="{{ route('verifikasi-nasabah') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm" :class="active === 'verifikasi-nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
                        <i class="fas fa-user-check text-sm"></i>
                        <span class="text-xs font-medium">Verifikasi Nasabah</span>
                    </a>
                    <a href="{{ route('data-nasabah') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm" :class="active === 'data-nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
                        <i class="fas fa-database text-sm"></i>
                        <span class="text-xs font-medium">Data Nasabah</span>
                    </a>
                </div>
                
                {{-- Penjemputan Sampah Link --}}
                <a href="{{ route('penjemputan-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'penjemputan-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penjemputan-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-truck text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Penjemputan Sampah</span>
                </a>
                
                {{-- Penimbangan Section --}}
                <div class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full cursor-pointer" :class="open ? (active === 'penimbangan' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penimbangan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')" @click="active = active === 'penimbangan' ? '' : 'penimbangan'">
                    <i class="fas fa-weight-hanging text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Penimbangan</span>
                    <i x-show="open" class="fas fa-chevron-down text-xs ml-auto transition-transform" :class="active === 'penimbangan' ? 'rotate-180' : ''"></i>
                </div>
                
                {{-- Sub-menu Penimbangan --}}
                <div x-show="open && active === 'penimbangan'" x-transition class="ml-4 space-y-1">
                    <a href="{{ route('input-setoran') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm" :class="active === 'input-setoran' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
                        <i class="fas fa-plus-circle text-sm"></i>
                        <span class="text-xs font-medium">Input Setoran</span>
                    </a>
                </div>
                
                {{-- Data Sampah Link --}}
                <a href="{{ route('data-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'data-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'data-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-trash-alt text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Data Sampah</span>
                </a>
                
                {{-- Penjualan Sampah Link --}}
                <a href="{{ route('penjualan-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'penjualan-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penjualan-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Penjualan Sampah</span>
                </a>
                
                {{-- Settings Link --}}
                <a href="{{ route('settings-banksampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'settings-banksampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'settings-banksampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-cog text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Setting</span>
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
    <div class="flex-1 min-h-screen" style="background-color: var(--bg-primary);" :style="'padding-left: 4rem; transition: padding-left 0.3s cubic-bezier(0.4,0,0.2,1);'">
        {{-- Top Header Bar --}}
        <div class="fixed-header" :style="'padding-left: 4rem;'">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="text-white font-semibold text-lg">BijakSampah</h1>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('notif-banksampah') }}" class="relative">
                    <i class="far fa-bell text-white text-sm"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center font-medium">2</span>
                </a>
                <button class="focus:outline-none">
                    <i class="fas fa-search text-white text-sm"></i>
                </button>
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile-banksampah') }}" class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center border-2 border-white/20">
                        <img src="{{ asset('asset/img/user_profile.jpg') }}" alt="Profile" class="w-full h-full object-cover">
                    </a>
                    <i class="fas fa-chevron-down text-white text-xs"></i>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="p-8 w-full" style="padding-top: 60px;">
            {{-- Dashboard Title --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Bank Sampah</h1>
                <p class="text-gray-600 mt-2">Aktivitas bank sampah</p>
            </div>

            {{-- Notifications Section --}}
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Notifikasi Terbaru</h2>
                    <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</button>
                </div>
                <div class="notif-cards" id="notifContainer">
                    <!-- Notifikasi akan dimuat di sini -->
                </div>
            </div>

            {{-- Quick Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stats-card rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Nasabah</p>
                            <p class="text-2xl font-bold text-gray-900">1,247</p>
                            <p class="text-xs text-green-600 mt-1">+12% dari bulan lalu</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stats-card rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Sampah Hari Ini</p>
                            <p class="text-2xl font-bold text-gray-900">156 kg</p>
                            <p class="text-xs text-green-600 mt-1">+8% dari kemarin</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-weight-hanging text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stats-card rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Penjemputan</p>
                            <p class="text-2xl font-bold text-gray-900">23</p>
                            <p class="text-xs text-orange-600 mt-1">5 menunggu konfirmasi</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-truck text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="stats-card rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pendapatan</p>
                            <p class="text-2xl font-bold text-gray-900">Rp 2.4M</p>
                            <p class="text-xs text-green-600 mt-1">+15% dari bulan lalu</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                {{-- Chart 1 --}}
                <div class="chart-container rounded-xl shadow-sm p-6">
                    <div class="chart-title">
                        <i class="fas fa-chart-line"></i> Data Penimbangan Sampah
                    </div>
                    <div class="chart-sub">Minggu Lalu</div>

                    <div class="chart-content" id="chart-content">
                        <!-- Grafik akan dimuat di sini -->
                    </div>
                </div>

                {{-- Chart 2 --}}
                <div class="chart-container rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Top 5 Jenis Sampah</h3>
                        <i class="fas fa-chart-pie text-gray-400"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">Plastik</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">45%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">Kertas</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">28%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">Logam</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">15%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">Kaca</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">8%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">Lainnya</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">4%</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activities --}}
            <div class="chart-container rounded-xl shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                    <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</button>
                </div>
                <div class="space-y-4">
                    <div class="activity-item flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-plus text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Nasabah baru terdaftar</p>
                            <p class="text-xs text-gray-500">Ahmad Fauzi - 2 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="activity-item flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-truck text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Penjemputan selesai</p>
                            <p class="text-xs text-gray-500">Jl. Sudirman No. 45 - 15 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="activity-item flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-weight-hanging text-orange-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Penimbangan sampah</p>
                            <p class="text-xs text-gray-500">25 kg plastik - 1 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                Created by <strong>TEK(G)</strong> | All Right Reserved!
            </div>
        </div>
    </div>

    {{-- Floating Action Button --}}
    <div class="fab" title="Tambah Aktivitas">
        <i class="fas fa-plus"></i>
    </div>

    <div class="modal" id="notifModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Kelola Notifikasi</h3>
                <button class="close-modal" id="closeNotifModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="notifInput">Tambah Notifikasi Baru</label>
                    <input type="text" id="notifInput" placeholder="Masukkan pesan notifikasi">
                </div>
                <div id="notifList">
                    <!-- Daftar notifikasi akan dimuat di sini -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelNotif">Batal</button>
                <button class="btn btn-primary" id="saveNotif">Simpan</button>
            </div>
        </div>
    </div>

    <div class="modal" id="searchModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Cari</h3>
                <button class="close-modal" id="closeSearchModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="searchInput" placeholder="Masukkan kata kunci...">
                </div>
                <div id="searchResults">
                    <!-- Hasil pencarian akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="profileModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Profil Saya</h3>
                <button class="close-modal" id="closeProfileModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group" style="text-align: center;">
                    <img id="profileImage" src="https://ui-avatars.com/api/?name=Nasabah&background=75E6DA&color=05445E" alt="Profile" style="width: 120px; height: 120px; border-radius: 50%; border: 4px solid #05445E; margin-bottom: 15px; cursor: pointer;">
                    <input type="file" id="profileUpload" accept="image/*" style="display: none;">
                    <button class="btn btn-outline" id="changeProfileBtn" style="margin-top: 10px;">Ganti Foto Profil</button>
                </div>
                <div class="form-group">
                    <label for="profileName">Nama Lengkap</label>
                    <input type="text" id="profileName" value="Nasabah Bijak Sampah">
                </div>
                <div class="form-group">
                    <label for="profileEmail">Email</label>
                    <input type="email" id="profileEmail" value="nasabah@bijaksampah.com">
                </div>
                <div class="form-group">
                    <label for="profilePhone">No. Telepon</label>
                    <input type="tel" id="profilePhone" value="+6281234567890">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelProfile">Batal</button>
                <button class="btn btn-primary" id="saveProfile">Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <script>
        function bankSampahApp() {
            return {
                sidebarOpen: false,
                active: 'dashboard-banksampah',
                
                init() {
                    // Initialize sidebar state
                    this.sidebarOpen = false;
                }
            }
        }

        // Data Notifikasi yang sudah diubah
        let notifications = [
            { 
                id: 1,
                title: "Sampah Penuh",
                icon: "fas fa-exclamation-circle",
                message: "Notif sampah penuh di bak sampah dengan ID SR78388. Tempat sampah Nasabah Suyatno telah penuh, segera ambil sampah untuk penimbangan.",
                date: "22 Juni 2025",
                time: "20:45"
            },
            { 
                id: 2,
                title: "UMKM Ingin Mengambil Sampah",
                icon: "fas fa-store",
                message: "UMKM Sumber Rezeki sudah melakukan pembelian dan ingin mengambil sampah.",
                date: "23 Juni 2025",
                time: "14:14"
            },
            { 
                id: 3,
                title: "Penjemputan Sampah",
                icon: "fas fa-truck",
                message: "Petugas bank sampah akan menjemput sampah Anda hari ini. Mohon siapkan ya!",
                date: "23 Juni 2025",
                time: "16:14"
            }
        ];

        // Data untuk grafik penimbangan (dalam kg)
        const chartData = [
            { height: 20, value: '20 kg', isGreen: true }, 
            { height: 45, value: '45 kg', isGreen: true }, 
            { height: 60, value: '60 kg', isGreen: true },
            { height: 35, value: '35 kg', isGreen: true }, 
            { height: 25, value: '25 kg', isGreen: true }, 
            { height: 50, value: '50 kg', isGreen: true }, 
            { height: 40, value: '40 kg', isGreen: true }  
        ];

        // DOM Elements
        const notifContainer = document.getElementById('notifContainer');
        const notifList = document.getElementById('notifList');
        const notifInput = document.getElementById('notifInput');
        const saveNotif = document.getElementById('saveNotif');
        const profileImage = document.getElementById('profileImage');
        const profileUpload = document.getElementById('profileUpload');
        const changeProfileBtn = document.getElementById('changeProfileBtn');
        const saveProfile = document.getElementById('saveProfile');
        const chartContent = document.getElementById('chart-content');

        // Load Notifications
        function loadNotifications() {
            notifContainer.innerHTML = '';
            notifications.forEach(notif => {
                const card = document.createElement('div');
                card.className = 'card notification-card';
                
                // Add specific classes based on notification type
                if (notif.title.includes('Sampah Penuh')) {
                    card.classList.add('urgent');
                } else if (notif.title.includes('UMKM')) {
                    card.classList.add('info');
                } else if (notif.title.includes('Penjemputan')) {
                    card.classList.add('success');
                }
                
                card.innerHTML = `
                    <h4><i class="${notif.icon}"></i> ${notif.title}</h4>
                    <p>${notif.message}</p>
                    <div class="card-footer">
                        <span>${notif.date} • ${notif.time}</span>
                        <div class="card-actions">
                            <button class="card-btn delete" data-id="${notif.id}"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `;
                notifContainer.appendChild(card);
            });

            // Add delete event listeners
            document.querySelectorAll('.card-btn.delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    notifications = notifications.filter(n => n.id !== id);
                    loadNotifications();
                    loadNotifModal();
                });
            });
        }

        // Load Notifications in Modal
        function loadNotifModal() {
            notifList.innerHTML = '';
            notifications.forEach(notif => {
                const item = document.createElement('div');
                item.className = 'card';
                item.style.marginBottom = '10px';
                item.innerHTML = `
                    <h4 style="font-size: 16px;">${notif.title}</h4>
                    <p style="font-size: 14px;">${notif.message}</p>
                    <div class="card-footer" style="font-size: 12px;">
                        <span>${notif.date} • ${notif.time}</span>
                        <button class="card-btn delete" data-id="${notif.id}"><i class="fas fa-trash"></i></button>
                    </div>
                `;
                notifList.appendChild(item);
            });
        }

        // Generate Chart
        function generateChart() {
            chartContent.innerHTML = '';
            const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const today = new Date();
            const currentDay = today.getDay();

            const daysSinceMonday = currentDay === 0 ? 6 : currentDay - 1;
            const thisMonday = new Date(today);
            thisMonday.setDate(today.getDate() - daysSinceMonday);

            const lastMonday = new Date(thisMonday);
            lastMonday.setDate(thisMonday.getDate() - 7);

            for (let i = 0; i < 7; i++) {
                const date = new Date(lastMonday);
                date.setDate(lastMonday.getDate() + i);

                const dayOfWeek = dayNames[date.getDay()];
                const dayOfMonth = date.getDate();
                const month = monthNames[date.getMonth()];
                const year = date.getFullYear();

                const data = chartData[i];
                const chartBarItem = document.createElement('div');
                chartBarItem.className = 'chart-bar-item';
                chartBarItem.style.setProperty('--height', `${data.height}%`);
                chartBarItem.innerHTML = `
                    <div class="bar" style="--order: ${i + 1};">
                        <span class="bar-label">${data.value}</span>
                    </div>
                    <div class="day">${dayOfWeek}<br/>${dayOfMonth} ${month} ${year}</div>
                `;
                chartContent.appendChild(chartBarItem);
            }
        }

        // Add New Notification
        saveNotif.addEventListener('click', function() {
            if (notifInput.value.trim()) {
                const newId = notifications.length > 0 ? Math.max(...notifications.map(n => n.id)) + 1 : 1;
                const now = new Date();
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                const date = now.toLocaleDateString('id-ID', options);
                const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                
                notifications.unshift({
                    id: newId,
                    title: "Notifikasi Baru",
                    icon: "fas fa-info-circle",
                    message: notifInput.value.trim(),
                    date: date,
                    time: time
                });
                
                notifInput.value = '';
                loadNotifications();
                loadNotifModal();
            }
        });

        // Change Profile Image
        changeProfileBtn.addEventListener('click', function() {
            profileUpload.click();
        });

        profileUpload.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = function(event) {
                    profileImage.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Save Profile Changes
        saveProfile.addEventListener('click', function() {
            alert('Perubahan profil berhasil disimpan!');
            document.getElementById('profileModal').style.display = 'none';
        });

        // Initialize
        loadNotifications();
        generateChart();
    </script>
</div>
@endsection