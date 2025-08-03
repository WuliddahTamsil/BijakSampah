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
    .form-card {
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
    
    /* Dark theme overrides for form page */
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

<div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="inputPenjualanApp()" x-init="init()">
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'input-penjualan-sampah' }"
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
                <a href="{{ route('penjualan-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'penjualan-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penjualan-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
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
    <div class="flex-1 min-h-screen" style="background-color: var(--bg-primary);" :style="'padding-left: 4rem; transition: padding-left 0.3s cubic-bezier(0.4,0,0.2,1);'">
        {{-- Top Header Bar --}}
        <div class="fixed-header" :style="'padding-left: 4rem;'">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="text-white font-semibold text-lg">BijakSampah</h1>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('notifikasi') }}" class="relative">
                    <i class="far fa-bell text-white text-sm"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center font-medium">2</span>
                </a>
                <button class="focus:outline-none">
                    <i class="fas fa-search text-white text-sm"></i>
                </button>
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile') }}" class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center border-2 border-white/20">
                        <img src="{{ asset('asset/img/user_profile.jpg') }}" alt="Profile" class="w-full h-full object-cover">
                    </a>
                    <i class="fas fa-chevron-down text-white text-xs"></i>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="p-8 w-full" style="padding-top: 60px;">
            {{-- Form Title --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Input Penjualan Sampah</h1>
            </div>

            {{-- Form Content --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <form @submit.prevent="submitForm()" class="space-y-8">
                    {{-- Waste Categories Grid --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Plastik Section --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Plastik</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.plastik.botolBening" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Plastik Botol Bening</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.plastik.botolBeningBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.plastik.botolWarna" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Plastik Botol Warna</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.plastik.botolWarnaBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.plastik.gelasKecil" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Plastik Gelas Kecil</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.plastik.gelasKecilBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.plastik.kerasan" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Plastik Kerasan</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.plastik.kerasanBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.plastik.emberan" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Plastik Emberan</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.plastik.emberanBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.plastik.kaca" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Plastik Kaca</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.plastik.kacaBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Logam Section --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Logam</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.logam.aluminiumKaleng" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Aluminium Kaleng Minuman</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.logam.aluminiumKalengBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.logam.aluminiumBiasa" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Aluminium Biasa</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.logam.aluminiumBiasaBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.logam.besiPutih" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Besi Putih</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.logam.besiPutihBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.logam.bautMotor" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Baut Motor</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.logam.bautMotorBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kertas Section --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Kertas</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.kertas.koran" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Kertas Koran</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.kertas.koranBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.kertas.hvs" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Kertas HVS</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.kertas.hvsBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" x-model="formData.kertas.duplex" class="w-4 h-4 text-blue-600 rounded">
                                        <span class="text-sm text-gray-700">Kertas Duplex</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" x-model="formData.kertas.duplexBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Lain-lain Section --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4">Lain-lain</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" x-model="formData.lainLain.botolKaca" class="w-4 h-4 text-blue-600 rounded">
                                    <span class="text-sm text-gray-700">Botol Kaca</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="number" x-model="formData.lainLain.botolKacaBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                    <span class="text-xs text-gray-500">gram</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" x-model="formData.lainLain.minyakJelantah" class="w-4 h-4 text-blue-600 rounded">
                                    <span class="text-sm text-gray-700">Minyak Jelantah</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="number" x-model="formData.lainLain.minyakJelantahBerat" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded bg-gray-50" placeholder="berat">
                                    <span class="text-xs text-gray-500">gram</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Summary Section --}}
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="text-center space-y-6">
                            <div class="flex justify-center items-center space-x-16">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 mb-2">Total Setoran Sampah</p>
                                    <p class="text-3xl font-bold text-gray-900" x-text="calculateTotalWeight() + ' gr'">00,0 gr</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 mb-2">Nominal Harga Setoran</p>
                                    <p class="text-3xl font-bold text-gray-900" x-text="'Rp ' + calculateTotalPrice()">Rp 00,00</p>
                                </div>
                            </div>
                            
                            {{-- Action Button --}}
                            <div class="pt-6">
                                <button type="submit" class="px-16 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors text-lg">
                                    Jual
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sales Data Table --}}
        <div class="mt-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Penjualan Sampah</h2>
                        <p class="text-sm text-gray-600">12 Mei 2025</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                        </div>
                        <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            <option>Short by: April 2025</option>
                            <option>March 2025</option>
                            <option>February 2025</option>
                        </select>
                        {{-- Test Button --}}
                        <button @click="testModal()" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm">
                            Test Modal
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-700">No</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Jenis Sampah</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Satuan</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Total Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 1 clicked'); openSaleDetail({name: 'Plastik Botol Bening', quantity: 1, unit: 'Kg', price: 5000})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">1</td>
                                <td class="px-4 py-3 text-gray-900">Plastik Botol Bening</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">1</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 2 clicked'); openSaleDetail({name: 'Plastik Botol Warna', quantity: 5, unit: 'Kg', price: 30000})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">2</td>
                                <td class="px-4 py-3 text-gray-900">Plastik Botol Warna</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">5</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 3 clicked'); openSaleDetail({name: 'Plastik Gelas Kecil', quantity: 6, unit: 'Kg', price: 6000})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">3</td>
                                <td class="px-4 py-3 text-gray-900">Plastik Gelas Kecil</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">6</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 4 clicked'); openSaleDetail({name: 'Plastik Kerasan', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">4</td>
                                <td class="px-4 py-3 text-gray-900">Plastik Kerasan</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 5 clicked'); openSaleDetail({name: 'Plastik Emberan', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">5</td>
                                <td class="px-4 py-3 text-gray-900">Plastik Emberan</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 6 clicked'); openSaleDetail({name: 'Plastik Kaca', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">6</td>
                                <td class="px-4 py-3 text-gray-900">Plastik Kaca</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 7 clicked'); openSaleDetail({name: 'Kertas Koran', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">7</td>
                                <td class="px-4 py-3 text-gray-900">Kertas Koran</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 8 clicked'); openSaleDetail({name: 'Kertas HVS', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">8</td>
                                <td class="px-4 py-3 text-gray-900">Kertas HVS</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 9 clicked'); openSaleDetail({name: 'Kertas Duplex', quantity: 2, unit: 'Kg', price: 12000})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">9</td>
                                <td class="px-4 py-3 text-gray-900">Kertas Duplex</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">2</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 10 clicked'); openSaleDetail({name: 'Aluminium Kaleng', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">10</td>
                                <td class="px-4 py-3 text-gray-900">Aluminium Kaleng</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 11 clicked'); openSaleDetail({name: 'Aluminium Biasa', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">11</td>
                                <td class="px-4 py-3 text-gray-900">Aluminium Biasa</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 12 clicked'); openSaleDetail({name: 'Besi Putih', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">12</td>
                                <td class="px-4 py-3 text-gray-900">Besi Putih</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 13 clicked'); openSaleDetail({name: 'Baut Motor', quantity: 0, unit: 'Kg', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">13</td>
                                <td class="px-4 py-3 text-gray-900">Baut Motor</td>
                                <td class="px-4 py-3 text-gray-900">Kg</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 14 clicked'); openSaleDetail({name: 'Kaca Botol', quantity: 0, unit: 'Pcs', price: 0})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">14</td>
                                <td class="px-4 py-3 text-gray-900">Kaca Botol</td>
                                <td class="px-4 py-3 text-gray-900">Pcs</td>
                                <td class="px-4 py-3 text-gray-900">0</td>
                            </tr>
                            <tr class="hover:bg-gray-50 cursor-pointer" 
                                @click="console.log('Row 15 clicked'); openSaleDetail({name: 'Minyak Jelantah', quantity: 6, unit: 'Liter', price: 36000})"
                                style="cursor: pointer;">
                                <td class="px-4 py-3 text-gray-900">15</td>
                                <td class="px-4 py-3 text-gray-900">Minyak Jelantah</td>
                                <td class="px-4 py-3 text-gray-900">Liter</td>
                                <td class="px-4 py-3 text-gray-900">6</td>
                            </tr>
                            <tr class="bg-blue-50 font-semibold">
                                <td class="px-4 py-3 text-gray-900" colspan="2">TOTAL</td>
                                <td class="px-4 py-3 text-gray-900">14 Kg</td>
                                <td class="px-4 py-3 text-gray-900">6 Liter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Sales Detail Modal --}}
        <div x-show="showDetailModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" 
             @click.self="closeModal()"
             @keydown.escape.window="closeModal()">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    {{-- Close Button --}}
                    <div class="flex justify-end mb-4">
                        <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    {{-- Product Image --}}
                    <div class="mb-6">
                        <div class="bg-gray-100 rounded-lg p-4 flex justify-center">
                            <div class="flex space-x-2">
                                <div class="w-8 h-16 bg-transparent border-2 border-gray-300 rounded-t-full"></div>
                                <div class="w-8 h-16 bg-transparent border-2 border-gray-300 rounded-t-full"></div>
                                <div class="w-8 h-16 bg-transparent border-2 border-gray-300 rounded-t-full"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Sales Details --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Penjualan</h3>
                        
                        {{-- Itemized List --}}
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Botol Warna</span>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600">5 Kg</div>
                                    <div class="font-semibold text-gray-900">Rp 30.000</div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Duplex</span>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600">2 Kg</div>
                                    <div class="font-semibold text-gray-900">Rp 12.000</div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Minyak</span>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600">6 Liter</div>
                                    <div class="font-semibold text-gray-900">Rp 36.000</div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Gelas</span>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600">6 Kg</div>
                                    <div class="font-semibold text-gray-900">Rp 6.000</div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Botol Bening</span>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600">1 Kg</div>
                                    <div class="font-semibold text-gray-900">Rp 5.000</div>
                                </div>
                            </div>
                            
                            <div class="border-t pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-gray-900">Total</span>
                                    <span class="font-bold text-lg text-gray-900">Rp 94.000</span>
                                </div>
                            </div>
                        </div>

                        {{-- Summary Section --}}
                        <div class="mt-6 space-y-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-1">Kuantitas Sampah</p>
                                <p class="text-xl font-bold text-gray-900">14 Kg, 6 L</p>
                            </div>
                            
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-1">Total Harga Jual</p>
                                <p class="text-3xl font-bold text-blue-600">Rp 94.000</p>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <div class="mt-6">
                            <button class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                                Posting
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function inputPenjualanApp() {
            return {
                sidebarOpen: false,
                showDetailModal: false,
                selectedSaleData: null,
                formData: {
                    plastik: {
                        botolBening: false, botolBeningBerat: '', botolBeningGram: '',
                        botolWarna: false, botolWarnaBerat: '', botolWarnaGram: '',
                        gelasKecil: false, gelasKecilBerat: '', gelasKecilGram: '',
                        kerasan: false, kerasanBerat: '', kerasanGram: '',
                        emberan: false, emberanBerat: '', emberanGram: '',
                        kaca: false, kacaBerat: '', kacaGram: ''
                    },
                    logam: {
                        aluminiumKaleng: false, aluminiumKalengBerat: '', aluminiumKalengGram: '',
                        aluminiumBiasa: false, aluminiumBiasaBerat: '', aluminiumBiasaGram: '',
                        besiPutih: false, besiPutihBerat: '', besiPutihGram: '',
                        bautMotor: false, bautMotorBerat: '', bautMotorGram: ''
                    },
                    kertas: {
                        koran: false, koranBerat: '', koranGram: '',
                        hvs: false, hvsBerat: '', hvsGram: '',
                        duplex: false, duplexBerat: '', duplexGram: ''
                    },
                    lainLain: {
                        botolKaca: false, botolKacaBerat: '', botolKacaGram: '',
                        minyakJelantah: false, minyakJelantahBerat: '', minyakJelantahGram: ''
                    }
                },
                init() {
                    console.log('Input Penjualan Sampah initialized');
                    // Test modal functionality
                    window.testModal = () => {
                        console.log('Testing modal...');
                        this.showDetailModal = true;
                        console.log('Modal should be visible:', this.showDetailModal);
                    };
                },
                openSaleDetail(saleData) {
                    console.log('Opening sale detail:', saleData);
                    this.selectedSaleData = saleData;
                    this.showDetailModal = true;
                    console.log('Modal state:', this.showDetailModal);
                },
                closeModal() {
                    console.log('Closing modal');
                    this.showDetailModal = false;
                },
                calculateTotalWeight() {
                    let totalWeight = 0;
                    for (let key in this.formData) {
                        if (typeof this.formData[key] === 'object') {
                            for (let subKey in this.formData[key]) {
                                if (this.formData[key][subKey] === true && this.formData[key][subKey + 'Berat']) {
                                    totalWeight += parseFloat(this.formData[key][subKey + 'Berat']) || 0;
                                }
                            }
                        }
                    }
                    return totalWeight.toFixed(1);
                },
                calculateTotalPrice() {
                    let totalPrice = 0;
                    for (let key in this.formData) {
                        if (typeof this.formData[key] === 'object') {
                            for (let subKey in this.formData[key]) {
                                if (this.formData[key][subKey] === true && this.formData[key][subKey + 'Berat']) {
                                    const weight = parseFloat(this.formData[key][subKey + 'Berat']) || 0;
                                    totalPrice += weight;
                                }
                            }
                        }
                    }
                    return totalPrice.toLocaleString('id-ID');
                },
                submitForm() {
                    let hasSelectedItems = false;
                    for (let key in this.formData) {
                        if (typeof this.formData[key] === 'object') {
                            for (let subKey in this.formData[key]) {
                                if (this.formData[key][subKey] === true) {
                                    hasSelectedItems = true;
                                    break;
                                }
                            }
                        }
                    }
                    
                    if (!hasSelectedItems) {
                        alert('Pilih minimal satu jenis sampah');
                        return;
                    }
                    
                    console.log('Form data:', this.formData);
                    alert('Penjualan sampah berhasil disimpan!');
                    window.location.href = '{{ route("penjualan-sampah") }}';
                }
            };
        }
    </script>
</div>
@endsection
