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
    .settings-card {
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
    
    /* Dark theme overrides for data sampah page */
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

    /* Chart styles */
    .chart-container {
        position: relative;
        height: 200px;
        margin: 20px 0;
    }
    
    .bar-chart {
        display: flex;
        align-items: end;
        justify-content: space-between;
        height: 150px;
        padding: 0 20px;
    }
    
    .bar-group {
        display: flex;
        gap: 2px;
        align-items: end;
    }
    
    .bar {
        width: 8px;
        background: linear-gradient(to top, #3B82F6, #60A5FA);
        border-radius: 2px 2px 0 0;
    }
    
    .bar-dark {
        background: linear-gradient(to top, #1E40AF, #3B82F6);
    }
    
    .pie-chart {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: conic-gradient(
            #1E40AF 0deg 140deg,
            #3B82F6 140deg 250deg,
            #60A5FA 250deg 320deg,
            #93C5FD 320deg 360deg
        );
        margin: 0 auto;
    }
    
    .chart-legend {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 20px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
    }
    
    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
</style>

<div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="dataSampahApp()" x-init="init()">
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'data-sampah' }"
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
                <a href="{{ route('data-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full active" :class="open ? (active === 'data-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'data-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
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
                <div class="flex items-center gap-3">
                    <i class="fas fa-search text-gray-400"></i>
                    <input type="text" placeholder="Search" class="bg-transparent border-none outline-none text-white placeholder-gray-300">
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-white text-sm">Sort by:</span>
                    <select class="bg-transparent text-white text-sm border-none outline-none">
                        <option>April 2025</option>
                    </select>
                </div>
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
            {{-- Page Title --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Data Setoran Sampah</h1>
            </div>

            {{-- Content Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left Column - Table --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Setoran Sampah Bulan April 2025</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">No</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-700">Jenis Sampah</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Satuan</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Total Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">1</td>
                                        <td class="py-3 px-4">Plastik Botol Bening</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">20</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">2</td>
                                        <td class="py-3 px-4">Plastik Botol Warna</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">7.5</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">3</td>
                                        <td class="py-3 px-4">Plastik Gelas Kecil</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">13</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">4</td>
                                        <td class="py-3 px-4">Plastik Kerasan</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0.7</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">5</td>
                                        <td class="py-3 px-4">Plastik Emberan</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">6</td>
                                        <td class="py-3 px-4">Plastik Kaca</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">7</td>
                                        <td class="py-3 px-4">Kertas Koran</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">8</td>
                                        <td class="py-3 px-4">Kertas HVS</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">9</td>
                                        <td class="py-3 px-4">Kertas Duplex</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">2</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">10</td>
                                        <td class="py-3 px-4">Aluminium Kaleng</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">11</td>
                                        <td class="py-3 px-4">Aluminium Biasa</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">12</td>
                                        <td class="py-3 px-4">Besi Putih</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                                    </tr>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">13</td>
                                        <td class="py-3 px-4">Baut Motor</td>
                                        <td class="py-3 px-4">Kg</td>
                                        <td class="py-3 px-4">0</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">14</td>
                                        <td class="py-3 px-4">Kaca Botol</td>
                                        <td class="py-3 px-4">Pcs</td>
                                        <td class="py-3 px-4">0</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                                        <td class="py-3 px-4">15</td>
                                        <td class="py-3 px-4">Minyak Jelantah</td>
                                        <td class="py-3 px-4">Liter</td>
                                        <td class="py-3 px-4">6</td>
                                    </tr>
                                    <tr class="bg-blue-50 font-semibold">
                                        <td class="py-3 px-4" colspan="2">TOTAL</td>
                                        <td class="py-3 px-4"></td>
                                        <td class="py-3 px-4">43.2 Kg, 6 Liter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                {{-- Right Column - Statistics --}}
                <div class="space-y-6">
                    {{-- Bar Chart Card --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik April 2025</h3>
                        <div class="chart-container">
                            <div class="bar-chart">
                                <div class="bar-group">
                                    <div class="bar" style="height: 30px;"></div>
                                    <div class="bar bar-dark" style="height: 20px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 45px;"></div>
                                    <div class="bar bar-dark" style="height: 25px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 60px;"></div>
                                    <div class="bar bar-dark" style="height: 35px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 80px;"></div>
                                    <div class="bar bar-dark" style="height: 50px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 65px;"></div>
                                    <div class="bar bar-dark" style="height: 40px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 90px;"></div>
                                    <div class="bar bar-dark" style="height: 55px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 75px;"></div>
                                    <div class="bar bar-dark" style="height: 45px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 100px;"></div>
                                    <div class="bar bar-dark" style="height: 60px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 85px;"></div>
                                    <div class="bar bar-dark" style="height: 50px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 70px;"></div>
                                    <div class="bar bar-dark" style="height: 40px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 55px;"></div>
                                    <div class="bar bar-dark" style="height: 30px;"></div>
                                </div>
                                <div class="bar-group">
                                    <div class="bar" style="height: 40px;"></div>
                                    <div class="bar bar-dark" style="height: 25px;"></div>
                                </div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>JAN</span>
                                <span>FEB</span>
                                <span>MAR</span>
                                <span>APR</span>
                                <span>MAY</span>
                                <span>JUN</span>
                                <span>JUL</span>
                                <span>AUG</span>
                                <span>SEP</span>
                                <span>OCT</span>
                                <span>NOV</span>
                                <span>DEC</span>
                            </div>
                        </div>
                    </div>

                    {{-- Pie Chart Card --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Distribusi Sampah</h3>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="pie-chart"></div>
                            <div class="chart-legend">
                                <div class="legend-item">
                                    <div class="legend-dot bg-blue-800"></div>
                                    <span>Botol: 39.11% (+2.98%)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot bg-blue-600"></div>
                                    <span>HVS: 28.02% (-3.25%)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot bg-blue-400"></div>
                                    <span>Duplex: 23.13% (+0.14%)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot bg-blue-200"></div>
                                    <span>Kaca: 5.03% (-1.11%)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Product Detail Card --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-wine-bottle text-gray-600 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Botol Plastik</h3>
                                <p class="text-sm text-gray-600">Sampah botol Plastik menjadi setoran paling banyak di bulan ini, yaitu sebanyak 20Kg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function dataSampahApp() {
    return {
        sidebarOpen: false,
        init() {
            // Initialize the data sampah app
            console.log('Data Sampah App initialized');
        }
    };
}
</script>
@endsection 