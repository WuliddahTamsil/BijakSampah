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
    .sales-card {
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
    .fab {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 60px;
        height: 60px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
    }
    .fab:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
    }
    
    /* Dark theme overrides for sales page */
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
    
    /* Enhanced card styling */
    .product-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        aspect-ratio: 1;
        position: relative;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border-color: rgba(59, 130, 246, 0.3);
    }
    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6, #06b6d4);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    .product-card:hover::before {
        transform: scaleX(1);
    }
    
    /* Status badge styling */
    .status-badge {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-weight: 600;
        letter-spacing: 0.5px;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    /* Button hover effects */
    .post-button {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6, #06b6d4);
        border: 2px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }
    .post-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    .post-button:hover::before {
        left: 100%;
    }
    .post-button:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #1e40af, #2563eb, #0891b2);
    }
    
    /* Enhanced typography */
    .page-title {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }
    .page-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        border-radius: 2px;
    }
    
    /* Product image styling */
    .product-image {
        transition: all 0.3s ease;
        aspect-ratio: 1;
        object-fit: cover;
    }
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    
    /* Stats card enhancement */
    .stats-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(59, 130, 246, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    .stats-card:hover::before {
        transform: scaleX(1);
    }
    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: rgba(59, 130, 246, 0.2);
    }
    
    /* Enhanced background */
    .main-bg {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
        position: relative;
    }
    .main-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e2e8f0' fill-opacity='0.4'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }
    
    /* Floating elements */
    .floating-shape {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.1), rgba(59, 130, 246, 0.1));
        animation: float 6s ease-in-out infinite;
    }
    .floating-shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 10%;
        right: 10%;
        animation-delay: 0s;
    }
    .floating-shape:nth-child(2) {
        width: 60px;
        height: 60px;
        top: 60%;
        right: 5%;
        animation-delay: 2s;
    }
    .floating-shape:nth-child(3) {
        width: 40px;
        height: 40px;
        top: 30%;
        right: 20%;
        animation-delay: 4s;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(120deg); }
        66% { transform: translateY(-10px) rotate(240deg); }
    }
    
    /* Enhanced section headers */
    .section-header {
        position: relative;
        display: inline-block;
    }
    .section-header::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        border-radius: 1px;
    }
    
    /* Memastikan teks sidebar konsisten */
    .sidebar-nav-item span,
    .sidebar-item-hover span {
        font-weight: 500 !important;
        font-size: 12px !important;
        line-height: 1.2 !important;
    }
    
    /* Memastikan tidak ada font-weight yang diwarisi */
    .sidebar-nav-item,
    .sidebar-item-hover {
        font-weight: normal !important;
    }
</style>

<div class="flex min-h-screen main-bg" x-data="salesApp()" x-init="init()">
    {{-- Floating Background Elements --}}
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    {{-- Floating Background Elements --}}
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'penjualan-sampah' }"
        x-ref="sidebar"
        @mouseenter="open = true; $root.sidebarOpen = true"
        @mouseleave="open = false; $root.sidebarOpen = false"
        class="fixed top-0 left-0 z-50 flex flex-col py-6 sidebar-hover overflow-hidden shadow-2xl group sidebar-gradient"
        :class="open ? 'w-64' : 'w-16'"
        style="transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); height: 100vh;"
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
                <a href="{{ route('dashboard-banksampah') }}" class="flex items-center gap-3 p-3 font-medium sidebar-nav-item whitespace-nowrap w-full" :class="open ? (active === 'dashboard-banksampah' ? 'active text-white' : 'text-white') : (active === 'dashboard-banksampah' ? 'active text-white justify-center' : 'text-white justify-center')">
                    <i class="fas fa-home text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Dashboard</span>
                </a>
                
                {{-- Nasabah Section --}}
                <div class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full cursor-pointer" :class="open ? (active === 'nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'nasabah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')" @click="active = active === 'nasabah' ? '' : 'nasabah'">
                    <i class="fas fa-users text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Nasabah</span>
                    <i x-show="open" class="fas fa-chevron-down text-xs ml-auto transition-transform" :class="active === 'nasabah' ? 'rotate-180' : ''"></i>
                </div>
                
                {{-- Sub-menu Nasabah --}}
                <div x-show="open && active === 'nasabah'" x-transition class="ml-4 space-y-1">
                    <a href="{{ route('verifikasi-nasabah') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm" :class="active === 'verifikasi-nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
                        <i class="fas fa-user-check text-sm"></i>
                        <span class="text-xs font-medium">Verifikasi Nasabah</span>
                    </a>
                    <a href="{{ route('data-nasabah-banksampah') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm" :class="active === 'data-nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
                        <i class="fas fa-database text-sm"></i>
                        <span class="text-xs font-medium">Data Nasabah</span>
                    </a>
                </div>
                
                {{-- Penjemputan Sampah Link --}}
                <a href="{{ route('penjemputan-sampah-banksampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'penjemputan-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penjemputan-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-truck text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Penjemputan Sampah</span>
                </a>
                
                {{-- Penimbangan Section --}}
                <div class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full cursor-pointer" :class="open ? (active === 'penimbangan' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penimbangan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')" @click="active = active === 'penimbangan' ? '' : 'penimbangan'">
                    <i class="fas fa-weight-hanging text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Penimbangan</span>
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
                    <span x-show="open" class="text-xs font-medium">Data Sampah</span>
                </a>
                
                {{-- Penjualan Sampah Link --}}
                <a href="{{ route('penjualan-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full active" :class="open ? (active === 'penjualan-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penjualan-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Penjualan Sampah</span>
                </a>
                
                {{-- Settings Link --}}
                <a href="{{ route('settings-banksampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'settings-banksampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'settings-banksampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-cog text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Setting</span>
                </a>
            </nav>
            
            {{-- Logout Section --}}
            <div class="w-full flex items-center py-3 mt-auto">
                <a href="{{ route('logout') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover text-white hover:text-red-300 transition-all duration-200 w-full whitespace-nowrap" :class="open ? (active === 'logout' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'logout' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Logout</span>
                </a>
            </div>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 min-h-screen relative" style="background-color: var(--bg-primary);" :style="'padding-left: 4rem; transition: padding-left 0.3s cubic-bezier(0.4,0,0.2,1);'">
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
        <div class="p-8 w-full relative" style="padding-top: 60px;">
            {{-- Page Title --}}
            <div class="mb-8">
                <h1 class="page-title text-4xl font-bold mb-3">Penjualan Sampah</h1>
                <p class="text-gray-600 mt-2 text-lg">Kelola penjualan dan transaksi sampah dengan mudah dan efisien</p>
            </div>

            {{-- Posting Penjualan Baru Button --}}
            <div class="flex justify-center mb-10">
                <a href="{{ route('input-penjualan-sampah') }}" class="post-button text-white px-10 py-5 rounded-xl text-xl font-bold flex items-center gap-4 hover:from-blue-600 hover:to-teal-600 transition-all duration-300 shadow-xl transform hover:scale-105">
                    <i class="fas fa-plus text-2xl"></i>
                    <span>Posting Penjualan Baru</span>
                </a>
            </div>

        
            {{-- Telah Diposting Section --}}
            <div class="mb-10">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <h2 class="section-header text-3xl font-bold text-gray-900">Telah Diposting</h2>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">Total: 9 item</span>
                            <span class="text-sm text-green-500">• 6 selesai</span>
                            <span class="text-sm text-orange-500">• 3 menunggu</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="text-gray-600 hover:text-gray-800 text-sm font-medium flex items-center gap-2 transition-colors">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </button>
                        <button class="text-blue-600 hover:text-blue-800 text-base font-semibold flex items-center gap-3 transition-all duration-300 hover:gap-4">
                            <span>Lihat Semua</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                {{-- Grid Layout: EXACTLY 3 cards per row --}}
                <div class="grid grid-cols-3 gap-8">
                    {{-- Card 1: Menunggu Pengambilan --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Botol Plastik" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-orange-500 text-white text-xs rounded-full font-bold">Menunggu</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">Hari Ini, 17.00</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Botol Plastik</h3>
                            <p class="text-xl font-bold text-blue-600">10Kg - Rp 20.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS001</span>
                                <div class="flex items-center gap-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm transition-colors" title="Lihat Detail" data-action="view-detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-800 text-sm transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 text-sm transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Selesai --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Sampah Campur" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-green-500 text-white text-xs rounded-full font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">14 Mei 2025</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Sampah Campur</h3>
                            <p class="text-xl font-bold text-blue-600">15Kg - Rp 50.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS002</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Card 3: Selesai --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Botol Plastik" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-green-500 text-white text-xs rounded-full font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">13 Mei 2025</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Botol Plastik</h3>
                            <p class="text-xl font-bold text-blue-600">5Kg - Rp 10.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS003</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Card 4: Selesai --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Sampah" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-green-500 text-white text-xs rounded-full font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">12 Mei 2025</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Sampah</h3>
                            <p class="text-xl font-bold text-blue-600">20Kg - Rp 40.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS004</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Card 5: Menunggu Pengambilan --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Kertas Bekas" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-orange-500 text-white text-xs rounded-full font-bold">Menunggu</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">Hari Ini, 14.30</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Kertas Bekas</h3>
                            <p class="text-xl font-bold text-blue-600">8Kg - Rp 16.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS005</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Card 6: Selesai --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Logam Bekas" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-green-500 text-white text-xs rounded-full font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">11 Mei 2025</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Logam Bekas</h3>
                            <p class="text-xl font-bold text-blue-600">12Kg - Rp 60.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS006</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Card 7: Selesai --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Kaca Bekas" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-green-500 text-white text-xs rounded-full font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">10 Mei 2025</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Kaca Bekas</h3>
                            <p class="text-xl font-bold text-blue-600">6Kg - Rp 18.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS007</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Card 8: Menunggu Pengambilan --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Elektronik Bekas" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-orange-500 text-white text-xs rounded-full font-bold">Menunggu</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">Hari Ini, 10.15</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Elektronik Bekas</h3>
                            <p class="text-xl font-bold text-blue-600">3Kg - Rp 45.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS008</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Card 9: Selesai --}}
                    <div class="product-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="mb-5 relative">
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Kardus Bekas" class="product-image w-full h-48 object-cover rounded-xl">
                            <div class="absolute top-3 right-3">
                                <span class="status-badge px-3 py-2 bg-green-500 text-white text-xs rounded-full font-bold">Selesai</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-sm font-medium">9 Mei 2025</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl">Kardus Bekas</h3>
                            <p class="text-xl font-bold text-blue-600">25Kg - Rp 75.000</p>
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 font-medium">ID: #PS009</span>
                                <button class="text-blue-600 hover:text-blue-800 text-base transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Total Penjualan --}}
                <div class="stats-card rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Total Penjualan</h3>
                            <p class="text-sm text-gray-600 font-medium">Bulan ini</p>
                        </div>
                    </div>
                    <div class="text-4xl font-bold text-green-600 mb-2">Rp 259.000</div>
                    <div class="text-sm text-green-500 font-semibold">+15% dari bulan lalu</div>
                </div>

                {{-- Total Item --}}
                <div class="stats-card rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-box text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Total Item</h3>
                            <p class="text-sm text-gray-600 font-medium">Yang diposting</p>
                        </div>
                    </div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">9 Item</div>
                    <div class="text-sm text-blue-500 font-semibold">+3 item baru</div>
                </div>

                {{-- Status --}}
                <div class="stats-card rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Menunggu</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengambilan</p>
                        </div>
                    </div>
                    <div class="text-4xl font-bold text-orange-600 mb-2">3 Item</div>
                    <div class="text-sm text-orange-500 font-semibold">Perlu tindakan</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Floating Action Button --}}
    <div class="fab" data-href="{{ route('input-penjualan-sampah') }}" onclick="window.location.href=this.getAttribute('data-href')">
        <i class="fas fa-plus"></i>
    </div>



    {{-- Modal Detail Penjualan --}}
    <div x-show="openDetailModal" x-transition class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Detail Penjualan</h3>
                                <p class="text-sm text-gray-600">Informasi lengkap penjualan sampah</p>
                            </div>
                        </div>
                        <button @click="openDetailModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <div class="bg-white px-6 py-6">
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <img src="{{ asset('asset/img/bijak1.jpg') }}" alt="Foto Sampah" class="w-full h-80 object-cover rounded-2xl shadow-lg">
                        </div>
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900 mb-2">Botol Plastik</h4>
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 text-orange-800">
                                        <i class="fas fa-clock mr-2"></i>
                                        Menunggu Pengambilan
                                    </span>
                                    <span class="text-sm text-gray-500">ID: #PS001</span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-sm text-gray-600 mb-1">Berat</p>
                                    <p class="text-xl font-bold text-gray-900">10 Kg</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-sm text-gray-600 mb-1">Harga per Kg</p>
                                    <p class="text-xl font-bold text-gray-900">Rp 2.000</p>
                                </div>
                                <div class="bg-blue-50 rounded-xl p-4">
                                    <p class="text-sm text-blue-600 mb-1">Total Harga</p>
                                    <p class="text-2xl font-bold text-blue-600">Rp 20.000</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-sm text-gray-600 mb-1">Kategori</p>
                                    <p class="text-xl font-bold text-gray-900">Plastik</p>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700 mb-1">Deskripsi</p>
                                    <p class="text-gray-600">Botol plastik bekas minuman dalam kondisi bersih dan layak jual. Sudah dibersihkan dan dikumpulkan dari berbagai sumber.</p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-600">Diposting</p>
                                        <p class="font-semibold text-gray-900">Hari Ini, 17.00</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Lokasi</p>
                                        <p class="font-semibold text-gray-900">Jakarta Selatan</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Kontak</p>
                                        <p class="font-semibold text-gray-900">08123456789</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Status</p>
                                        <p class="font-semibold text-orange-600">Menunggu Pembeli</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                    <div class="flex gap-3">
                        <button type="button" class="inline-flex justify-center items-center gap-2 rounded-xl border border-transparent shadow-sm px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-base font-semibold text-white hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                        <button type="button" class="inline-flex justify-center items-center gap-2 rounded-xl border border-transparent shadow-sm px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-base font-semibold text-white hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            <i class="fas fa-share"></i>
                            Bagikan
                        </button>
                    </div>
                    <button @click="openDetailModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-3 bg-white text-base font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function salesApp() {
            return {
                sidebarOpen: false,
                active: 'penjualan-sampah',
                openDetailModal: false,
                
                init() {
                    // Initialize sidebar state
                    this.sidebarOpen = false;
                    
                    // Add event listeners for card actions
                    this.$nextTick(() => {
                        // Handle card view buttons
                        document.querySelectorAll('[data-action="view-detail"]').forEach(button => {
                            button.addEventListener('click', () => {
                                this.openDetailModal = true;
                            });
                        });
                        
                        // Handle search functionality
                        const searchInput = document.querySelector('input[placeholder="Cari penjualan..."]');
                        if (searchInput) {
                            searchInput.addEventListener('input', (e) => {
                                this.filterSales(e.target.value);
                            });
                        }
                    });
                },
                
                filterSales(searchTerm) {
                    // Implementation for filtering sales
                    console.log('Filtering sales with term:', searchTerm);
                },
                
                exportData() {
                    // Implementation for exporting data
                    console.log('Exporting sales data...');
                },
                
                printReport() {
                    // Implementation for printing report
                    console.log('Printing sales report...');
                }
            }
        }
    </script>
</div>
@endsection 