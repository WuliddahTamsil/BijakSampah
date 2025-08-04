@extends('layouts.app')

@section('content')
{{-- Lazy load Chart.js and XLSX --}}
<script>
// Lazy load Chart.js
function loadChartJS() {
    return new Promise((resolve) => {
        if (window.Chart) {
            resolve(window.Chart);
            return;
        }
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
        script.onload = () => resolve(window.Chart);
        document.head.appendChild(script);
    });
}

// Lazy load XLSX
function loadXLSX() {
    return new Promise((resolve) => {
        if (window.XLSX) {
            resolve(window.XLSX);
            return;
        }
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js';
        script.onload = () => resolve(window.XLSX);
        document.head.appendChild(script);
    });
}
</script>
<style>
    html, body {
        overflow-x: hidden;
    }
    .sidebar-gradient {
        background: linear-gradient(135deg, #75E6DA 0%, #05445E 63%);
    }
    .sidebar-hover {
        transition: width 0.2s ease;
    }
    .sidebar-item-hover {
        transition: background-color 0.1s ease;
    }
    .sidebar-item-hover:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
    .sidebar-logo {
        transition: opacity 0.2s ease;
    }
    .sidebar-nav-item {
        transition: background-color 0.1s ease;
        border-radius: 8px;
    }
    .sidebar-nav-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    .sidebar-nav-item.active {
        background-color: rgba(255, 255, 255, 0.2);
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
        background: linear-gradient(135deg, #75E6DA 0%, #05445E 63%);
        transition: padding-left 0.2s ease;
    }
    .chart-bar { 
        position: relative;
    }
    .chart-bar:hover { 
        transform: scaleY(1.02); 
    }
    .progress-ring {
        transform: rotate(-90deg);
    }
    .progress-ring-circle {
        transition: stroke-dasharray 0.2s;
        transform-origin: 50% 50%;
    }
    .stat-card {
        transition: transform 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-1px);
    }
    .gradient-bg {
        background: #667eea;
    }
    .gradient-bg-green {
        background: #4facfe;
    }
    .gradient-bg-orange {
        background: #fa709a;
    }
    .gradient-bg-purple {
        background: #a8edea;
    }
</style>

<div class="flex min-h-screen bg-gradient-to-br from-blue-50 via-white to-teal-50" x-data="{ sidebarOpen: false, activeTab: 'pemasukan' }">
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'keuangan' }"
        x-ref="sidebar"
        @mouseenter="open = true; $root.sidebarOpen = true"
        @mouseleave="open = false; $root.sidebarOpen = false"
        class="fixed top-0 left-0 z-20 flex flex-col py-6 sidebar-hover overflow-hidden shadow-2xl group sidebar-gradient"
        :class="open ? 'w-64' : 'w-16'"
        style="transition: width 0.2s ease; margin-top: 48px; height: calc(100vh - 48px);"
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
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 font-medium sidebar-nav-item whitespace-nowrap w-full" :class="open ? (active === 'dashboard' ? 'active text-white' : 'text-white') : (active === 'dashboard' ? 'active text-white justify-center' : 'text-white justify-center')">
                    <i class="fas fa-home text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Dashboard</span>
                </a>
                
                {{-- Bank Sampah Link --}}
                <a href="{{ route('bank-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'bank-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'bank-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-tachometer-alt text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Bank Sampah</span>
                </a>
                
                {{-- Toko Link --}}
                <a href="{{ route('toko') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'toko' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'toko' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-store text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Toko</span>
                </a>
                
                {{-- Komunitas Link --}}
                <a href="{{ route('komunitas') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'komunitas' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'komunitas' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-users text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Komunitas</span>
                </a>
                
                {{-- Berita Link --}}
                <a href="{{ route('berita') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'berita' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'berita' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-newspaper text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Berita</span>
                </a>
                
                {{-- Keuangan Link --}}
                <a href="{{ route('keuangan') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'keuangan' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'keuangan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-file-invoice-dollar text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Keuangan</span>
                </a>
                
                {{-- Pesan Link --}}
                <a href="{{ route('chat') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'chat' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'pesan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-comment-dots text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Pesan</span>
                </a>
                
                {{-- Umpan Balik Link --}}
                <a href="{{ route('feedback') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'feedback' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'umpan-balik' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-info-circle text-lg"></i>
                    <span x-show="open" class="text-sm font-medium">Umpan Balik</span>
                </a>
                
                {{-- Settings Link --}}
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
    <div class="flex-1 min-h-screen" :style="'padding-left:' + (sidebarOpen ? '16rem' : '4rem') + '; transition: padding-left 0.2s ease;'">
        {{-- Top Header Bar --}}
        <div class="fixed-header" :style="'padding-left:' + (sidebarOpen ? '16rem' : '4rem') + '; transition: padding-left 0.2s ease;'">
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
            <div class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">Keuangan</h1>
                        <p class="text-gray-600 text-lg">Kelola dan pantau keuangan Anda dengan mudah</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-white rounded-xl shadow-lg px-6 py-3 border border-gray-100">
                            <i class="fas fa-calendar text-blue-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700">23 Maret 2025</span>
                        </div>
                    </div>
                </div>
                
                {{-- Statistics Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Saldo -->
                    <div class="stat-card bg-white rounded-2xl shadow-2xl p-6 border-2 border-green-200 hover:border-green-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-700 text-sm font-bold uppercase tracking-wide mb-2">Total Saldo</p>
                                <p class="text-3xl font-black text-gray-900 mb-2">Rp202.000</p>
                                <p class="text-green-700 text-sm font-bold flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +327718 Koin
                                </p>
                            </div>
                            <div class="bg-green-600 rounded-full p-4 shadow-xl">
                                <i class="fas fa-wallet text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Transaksi -->
                    <div class="stat-card bg-white rounded-2xl shadow-2xl p-6 border-2 border-purple-200 hover:border-purple-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-700 text-sm font-bold uppercase tracking-wide mb-2">Total Transaksi</p>
                                <p class="text-3xl font-black text-gray-900 mb-2">24</p>
                                <p class="text-purple-700 text-sm font-bold flex items-center">
                                    <i class="fas fa-plus mr-1"></i>
                                    +5 transaksi hari ini
                                </p>
                            </div>
                            <div class="bg-purple-600 rounded-full p-4 shadow-xl">
                                <i class="fas fa-exchange-alt text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pengeluaran Bulan Ini -->
                    <div class="stat-card bg-white rounded-2xl shadow-2xl p-6 border-2 border-red-200 hover:border-red-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-700 text-sm font-bold uppercase tracking-wide mb-2">Pengeluaran</p>
                                <p class="text-3xl font-black text-gray-900 mb-2">Rp45.000</p>
                                <p class="text-red-700 text-sm font-bold flex items-center">
                                    <i class="fas fa-arrow-down mr-1"></i>
                                    -3.1% dari bulan lalu
                                </p>
                            </div>
                            <div class="bg-red-600 rounded-full p-4 shadow-xl">
                                <i class="fas fa-arrow-down text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pemasukan Bulan Ini -->
                    <div class="stat-card bg-white rounded-2xl shadow-2xl p-6 border-2 border-blue-200 hover:border-blue-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-700 text-sm font-bold uppercase tracking-wide mb-2">Pemasukan</p>
                                <p class="text-3xl font-black text-gray-900 mb-2">Rp156.000</p>
                                <p class="text-blue-700 text-sm font-bold flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +8.2% dari bulan lalu
                                </p>
                            </div>
                            <div class="bg-blue-600 rounded-full p-4 shadow-xl">
                                <i class="fas fa-arrow-up text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Charts Section --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Bar Chart -->
                    <div class="bg-white rounded-2xl shadow-2xl p-6 border-2 border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-black text-gray-900 mb-2">Tren Keuangan 7 Hari Terakhir</h3>
                                <p class="text-gray-700 font-medium">Analisis keuangan harian</p>
                            </div>
                            <div class="flex items-center gap-3 bg-blue-100 px-4 py-2 rounded-full border border-blue-300">
                                <span class="w-4 h-4 bg-blue-600 rounded-full"></span>
                                <span class="text-sm font-bold text-blue-800">Keuangan</span>
                            </div>
                        </div>
                        <div class="h-64">
                            <canvas id="barChart" width="400" height="200"></canvas>
                        </div>
                    </div>

                    <!-- Doughnut Chart -->
                    <div class="bg-white rounded-2xl shadow-2xl p-6 border-2 border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-black text-gray-900 mb-2">Distribusi Kategori</h3>
                                <p class="text-gray-700 font-medium">Persentase berdasarkan jenis sampah</p>
                            </div>
                            <div class="flex items-center gap-3 bg-green-100 px-4 py-2 rounded-full border border-green-300">
                                <span class="w-4 h-4 bg-green-600 rounded-full"></span>
                                <span class="text-sm font-bold text-green-800">Kategori</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center mb-4">
                            <div class="relative w-48 h-48">
                                <canvas id="doughnutChart" width="200" height="200"></canvas>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="flex items-center gap-3 p-3 bg-green-100 rounded-xl border border-green-300">
                                <div class="w-4 h-4 bg-green-600 rounded-full"></div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">Organik</div>
                                    <div class="text-xs text-green-700 font-bold">70%</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-blue-100 rounded-xl border border-blue-300">
                                <div class="w-4 h-4 bg-blue-600 rounded-full"></div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">Anorganik</div>
                                    <div class="text-xs text-blue-700 font-bold">20%</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-yellow-100 rounded-xl border border-yellow-300">
                                <div class="w-4 h-4 bg-yellow-600 rounded-full"></div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">B3</div>
                                    <div class="text-xs text-yellow-700 font-bold">10%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Line Chart -->
                <div class="bg-white rounded-2xl shadow-2xl p-6 border-2 border-gray-200 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 mb-2">Tren Keuangan 30 Hari Terakhir</h3>
                            <p class="text-gray-700 font-medium">Analisis tren keuangan</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-3 bg-green-100 px-4 py-2 rounded-full border border-green-300">
                                <span class="w-4 h-4 bg-green-600 rounded-full"></span>
                                <span class="text-sm font-bold text-green-800">Keuangan</span>
                            </div>
                            <div class="flex items-center gap-3 bg-red-100 px-4 py-2 rounded-full border border-red-300">
                                <span class="w-4 h-4 bg-red-600 rounded-full"></span>
                                <span class="text-sm font-bold text-red-800">Transaksi</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="lineChart" width="400" height="200"></canvas>
                    </div>
                    <div class="flex justify-between mt-4 text-sm text-gray-700 font-bold">
                        <span>1 Mar</span>
                        <span>15 Mar</span>
                        <span>30 Mar</span>
                    </div>
                </div>
                
                {{-- Toggle Buttons --}}
                <div class="flex items-center justify-center mb-8">
                    <div class="bg-gray-100 rounded-2xl p-1 shadow-lg border-2 border-gray-200">
                        <div class="flex relative">
                            <!-- Active Background Slider -->
                            <div 
                                class="absolute top-1 bottom-1 rounded-xl transition-all duration-200 ease-in-out"
                                :class="activeTab === 'pemasukan' ? 'bg-green-500' : 'bg-red-500'"
                                :style="activeTab === 'pemasukan' ? 'transform: translateX(0); width: 8rem;' : 'transform: translateX(8rem); width: 8rem;'">
                            </div>
                            
                            <!-- Pemasukan Button -->
                            <button 
                                @click="activeTab = 'pemasukan'" 
                                class="relative px-8 py-3 rounded-xl font-medium text-lg transition-all duration-200 z-10 min-w-[8rem]"
                                :class="activeTab === 'pemasukan' ? 'text-white' : 'text-gray-600 hover:text-gray-800'">
                                <i class="fas fa-arrow-up mr-2"></i>Pemasukan
                            </button>
                            
                            <!-- Pengeluaran Button -->
                            <button 
                                @click="activeTab = 'pengeluaran'" 
                                class="relative px-8 py-3 rounded-xl font-medium text-lg transition-all duration-200 z-10 min-w-[8rem]"
                                :class="activeTab === 'pengeluaran' ? 'text-white' : 'text-gray-600 hover:text-gray-800'">
                                <i class="fas fa-arrow-down mr-2"></i>Pengeluaran
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Tabel Riwayat -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 border-2 border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <div class="text-gray-900 text-2xl font-medium mb-2" x-text="activeTab === 'pemasukan' ? 'Riwayat Pemasukan' : 'Riwayat Pengeluaran'"></div>
                            <div class="text-gray-700 text-lg font-medium" x-text="activeTab === 'pemasukan' ? 'Cek riwayat pemasukan dari Top Up BSPay dan Toko!' : 'Cek riwayat pengeluaran untuk beli sampah!'"></div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button onclick="exportToExcel()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium shadow-lg">
                                <i class="fas fa-download mr-2"></i>Export Excel
                            </button>
                            <button onclick="showFilterModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium shadow-lg">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-300 bg-gray-50">
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900">No. Invoice</th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900" x-text="activeTab === 'pemasukan' ? 'Sumber' : 'Pembeli'"></th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900" x-text="activeTab === 'pemasukan' ? 'Jenis Transaksi' : 'Jenis Sampah'"></th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900">Kategori</th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900">Harga (Rp)</th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900">Koin</th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900">Status</th>
                                    <th class="px-4 py-3 text-left font-medium text-lg text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Pemasukan Data -->
                                <template x-if="activeTab === 'pemasukan'">
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-100">
                                        <td class="px-4 py-3 font-medium text-gray-900">1#TOP{{ $i+3 }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900">16/06/25</td>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $i % 2 == 0 ? 'BSPay' : 'Toko BijakSampah' }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $i % 2 == 0 ? 'Top Up Koin' : 'Penjualan Produk' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-3 py-2 rounded-full text-sm font-medium {{ $i % 2 == 0 ? 'bg-blue-100 text-blue-800 border-2 border-blue-300' : 'bg-green-100 text-green-800 border-2 border-green-300' }}">
                                                {{ $i % 2 == 0 ? 'Top Up' : 'Toko' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 font-medium text-lg text-gray-900">Rp{{ number_format(50000 + ($i * 10000)) }}</td>
                                        <td class="px-4 py-3 font-medium text-lg text-gray-900">{{ 50 + ($i * 10) }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-3 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border-2 border-green-300">
                                                Selesai
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <button onclick="viewTransaction('{{ $i+3 }}')" class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                                    <i class="fas fa-eye text-lg"></i>
                                                </button>
                                                <button onclick="downloadInvoice('{{ $i+3 }}')" class="text-green-600 hover:text-green-800" title="Download Invoice">
                                                    <i class="fas fa-download text-lg"></i>
                                                </button>
                                                <button onclick="showTransactionMenu('{{ $i+3 }}')" class="text-purple-600 hover:text-purple-800" title="Menu">
                                                    <i class="fas fa-ellipsis-v text-lg"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endfor
                                </template>
                                
                                <!-- Pengeluaran Data -->
                                <template x-if="activeTab === 'pengeluaran'">
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-100">
                                        <td class="px-4 py-3 font-medium text-gray-900">1#BELI{{ $i+3 }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900">16/06/25</td>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $i % 2 == 0 ? 'Wugis' : 'BS' }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $i % 3 == 0 ? 'Sampah Organik' : ($i % 3 == 1 ? 'Sampah Anorganik' : 'Sampah B3') }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-3 py-2 rounded-full text-sm font-medium {{ $i % 3 == 0 ? 'bg-green-100 text-green-800 border-2 border-green-300' : ($i % 3 == 1 ? 'bg-blue-100 text-blue-800 border-2 border-blue-300' : 'bg-yellow-100 text-yellow-800 border-2 border-yellow-300') }}">
                                                {{ $i % 3 == 0 ? 'Organik' : ($i % 3 == 1 ? 'Anorganik' : 'B3') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 font-medium text-lg text-gray-900">Rp{{ number_format(10000 + ($i * 5000)) }}</td>
                                        <td class="px-4 py-3 font-medium text-lg text-gray-900">{{ 10 + ($i * 5) }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-3 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border-2 border-green-300">
                                                Selesai
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <button onclick="viewTransaction('{{ $i+3 }}')" class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                                    <i class="fas fa-eye text-lg"></i>
                                                </button>
                                                <button onclick="downloadInvoice('{{ $i+3 }}')" class="text-green-600 hover:text-green-800" title="Download Invoice">
                                                    <i class="fas fa-download text-lg"></i>
                                                </button>
                                                <button onclick="showTransactionMenu('{{ $i+3 }}')" class="text-purple-600 hover:text-purple-800" title="Menu">
                                                    <i class="fas fa-ellipsis-v text-lg"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endfor
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="text-gray-700 text-lg font-medium">
                            Menampilkan 1-5 dari 24 transaksi
                        </div>
                        <div class="flex items-center gap-3">
                            <button onclick="previousPage()" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium border-2 border-gray-300">
                                <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                            </button>
                            <span class="text-gray-900 px-4 py-2 font-medium text-lg bg-blue-100 rounded-lg border-2 border-blue-300">1</span>
                            <button onclick="nextPage()" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium border-2 border-gray-300">
                                Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Filter Modal -->
 <div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
     <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 shadow-2xl">
         <div class="flex items-center justify-between mb-6">
             <h3 class="text-xl font-bold text-gray-900">Filter Transaksi</h3>
             <button onclick="hideFilterModal()" class="text-gray-500 hover:text-gray-700">
                 <i class="fas fa-times text-lg"></i>
             </button>
         </div>
         <div class="space-y-6">
             <div>
                 <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                 <input type="date" id="filterTanggal" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none">
             </div>
             <div>
                 <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                 <select id="filterKategori" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none">
                     <option value="">Semua Kategori</option>
                     <option value="Top Up">Top Up</option>
                     <option value="Toko">Toko</option>
                     <option value="Organik">Organik</option>
                     <option value="Anorganik">Anorganik</option>
                     <option value="B3">B3</option>
                 </select>
             </div>
             <div>
                 <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                 <select id="filterStatus" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none">
                     <option value="">Semua Status</option>
                     <option value="Selesai">Selesai</option>
                     <option value="Pending">Pending</option>
                     <option value="Batal">Batal</option>
                 </select>
             </div>
             <div class="flex gap-3 pt-4">
                 <button onclick="applyFilter()" class="flex-1 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-medium">
                     Terapkan Filter
                 </button>
                 <button onclick="resetFilter()" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-xl hover:bg-gray-300 transition-colors duration-200 font-medium">
                     Reset
                 </button>
             </div>
         </div>
     </div>
 </div>

 <!-- Transaction Detail Modal -->
 <div id="transactionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
     <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 shadow-2xl">
         <div class="flex items-center justify-between mb-6">
             <h3 class="text-xl font-bold text-gray-900">Detail Transaksi</h3>
             <button onclick="hideTransactionModal()" class="text-gray-500 hover:text-gray-700">
                 <i class="fas fa-times text-lg"></i>
             </button>
         </div>
         <div id="transactionDetails" class="space-y-4">
             <!-- Transaction details will be populated here -->
         </div>
         <div class="mt-6 flex justify-end">
             <button onclick="hideTransactionModal()" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium">
                 Tutup
             </button>
         </div>
     </div>
 </div>

 <script>
 // Lazy load charts when needed
 let chartsLoaded = false;
 
 function loadCharts() {
     if (chartsLoaded) return;
     
     loadChartJS().then(() => {
         try {
             // Simple Bar Chart
             const barCtx = document.getElementById('barChart');
             if (barCtx) {
                 new Chart(barCtx.getContext('2d'), {
                     type: 'bar',
                     data: {
                         labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                         datasets: [{
                             label: 'Pemasukan',
                             data: [15000, 22000, 18000, 25000, 30000, 35000, 40000],
                             backgroundColor: 'rgba(59, 130, 246, 0.8)'
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         plugins: { legend: { display: false } },
                         animation: { duration: 1000 }
                     }
                 });
             }

             // Simple Doughnut Chart
             const doughnutCtx = document.getElementById('doughnutChart');
             if (doughnutCtx) {
                 new Chart(doughnutCtx.getContext('2d'), {
                     type: 'doughnut',
                     data: {
                         labels: ['Organik', 'Anorganik', 'B3'],
                         datasets: [{
                             data: [70, 20, 10],
                             backgroundColor: ['#10b981', '#3b82f6', '#f59e0b']
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         plugins: { legend: { display: false } },
                         animation: { duration: 1000 }
                     }
                 });
             }

             // Simple Line Chart
             const lineCtx = document.getElementById('lineChart');
             if (lineCtx) {
                 new Chart(lineCtx.getContext('2d'), {
                     type: 'line',
                     data: {
                         labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                         datasets: [{
                             label: 'Pemasukan',
                             data: [15000, 22000, 18000, 25000, 30000, 35000, 40000, 45000, 50000, 55000],
                             borderColor: '#10b981',
                             backgroundColor: 'rgba(16, 185, 129, 0.1)',
                             fill: true
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         plugins: { legend: { display: true } },
                         animation: { duration: 1000 }
                     }
                 });
             }
             chartsLoaded = true;
         } catch (error) {
             console.error('Chart error:', error);
         }
     });
 }
 
 // Load charts when user scrolls to them
 document.addEventListener('DOMContentLoaded', function() {
     const observer = new IntersectionObserver((entries) => {
         entries.forEach(entry => {
             if (entry.isIntersecting) {
                 loadCharts();
                 observer.disconnect();
             }
         });
     });
     
     const chartSection = document.querySelector('.grid.grid-cols-1.lg\\:grid-cols-2');
     if (chartSection) {
         observer.observe(chartSection);
     }
     
     // Event delegation for better performance
     document.addEventListener('click', function(e) {
         if (e.target.matches('[onclick*="viewTransaction"]')) {
             e.preventDefault();
             const id = e.target.getAttribute('onclick').match(/\d+/)[0];
             viewTransaction(id);
         }
     });
 });

 // Function implementations
 async function exportToExcel() {
     try {
         // Show loading state
         const button = event.target;
         const originalText = button.innerHTML;
         button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
         button.disabled = true;
         
         // Load XLSX library
         const XLSX = await loadXLSX();
         
         // Create workbook and worksheet
         const workbook = XLSX.utils.book_new();
         
         // Simple approach - just use pemasukan data
         let data = [];
     
         data = [
             ['No. Invoice', 'Tanggal', 'Sumber', 'Jenis Transaksi', 'Kategori', 'Harga (Rp)', 'Koin', 'Status'],
             ['1#TOP3', '16/06/25', 'BSPay', 'Top Up Point', 'Top Up', '50,000', '50', 'Selesai'],
             ['1#TOP4', '16/06/25', 'Toko BijakSampah', 'Penjualan Produk', 'Toko', '60,000', '60', 'Selesai'],
             ['1#TOP5', '16/06/25', 'BSPay', 'Top Up Point', 'Top Up', '70,000', '70', 'Selesai'],
             ['1#TOP6', '16/06/25', 'Toko BijakSampah', 'Penjualan Produk', 'Toko', '80,000', '80', 'Selesai'],
             ['1#TOP7', '16/06/25', 'BSPay', 'Top Up Point', 'Top Up', '90,000', '90', 'Selesai']
         ];
         
         const worksheet = XLSX.utils.aoa_to_sheet(data);
         XLSX.utils.book_append_sheet(workbook, worksheet, 'Pemasukan');
         
         const fileName = `riwayat_pemasukan_${new Date().toISOString().split('T')[0]}.xlsx`;
         XLSX.writeFile(workbook, fileName);
         
         alert(`Data berhasil diexport ke ${fileName}`);
     } catch (error) {
         console.error('Export error:', error);
         alert('Error saat export data');
     } finally {
         // Restore button state
         const button = event.target;
         button.innerHTML = originalText;
         button.disabled = false;
     }
 }

 function showFilterModal() {
     document.getElementById('filterModal').classList.remove('hidden');
 }

 function hideFilterModal() {
     document.getElementById('filterModal').classList.add('hidden');
 }

 // Debounce function for performance
 function debounce(func, wait) {
     let timeout;
     return function executedFunction(...args) {
         const later = () => {
             clearTimeout(timeout);
             func(...args);
         };
         clearTimeout(timeout);
         timeout = setTimeout(later, wait);
     };
 }

 function applyFilter() {
     const tanggal = document.getElementById('filterTanggal').value;
     const kategori = document.getElementById('filterKategori').value;
     const status = document.getElementById('filterStatus').value;
     
     // Use requestAnimationFrame for smooth filtering
     requestAnimationFrame(() => {
         const rows = document.querySelectorAll('tbody tr');
         let visibleCount = 0;
         
         rows.forEach(row => {
             let show = true;
             
             // Filter by date (if selected)
             if (tanggal) {
                 const rowDate = row.querySelector('td:nth-child(2)').textContent;
                 if (rowDate !== tanggal) show = false;
             }
             
             // Filter by category (if selected)
             if (kategori && show) {
                 const rowCategory = row.querySelector('td:nth-child(5) span').textContent;
                 if (rowCategory !== kategori) show = false;
             }
             
             // Filter by status (if selected)
             if (status && show) {
                 const rowStatus = row.querySelector('td:nth-child(8) span').textContent;
                 if (rowStatus !== status) show = false;
             }
             
             row.style.display = show ? '' : 'none';
             if (show) visibleCount++;
         });
         
         // Update pagination info
         const paginationInfo = document.querySelector('.text-gray-700.text-lg.font-medium');
         if (paginationInfo) {
             paginationInfo.textContent = `Menampilkan ${visibleCount} dari ${rows.length} transaksi`;
         }
     });
     
     hideFilterModal();
 }

 function resetFilter() {
     // Reset form
     document.getElementById('filterTanggal').value = '';
     document.getElementById('filterKategori').value = '';
     document.getElementById('filterStatus').value = '';
     
     // Show all rows
     const rows = document.querySelectorAll('tbody tr');
     rows.forEach(row => {
         row.style.display = '';
     });
     
     alert('Filter berhasil direset!');
     hideFilterModal();
 }

 // Cache for transaction details
 const transactionCache = new Map();
 
 function viewTransaction(id) {
     // Check cache first
     if (transactionCache.has(id)) {
         showTransactionModal(transactionCache.get(id));
         return;
     }
     
     // Get current tab
     const currentTab = document.querySelector('[x-data]').__x.$data.activeTab || 'pemasukan';
     
     // Prepare transaction data
     let details = {};
     
     if (currentTab === 'pemasukan') {
         details = {
             '3': { invoice: '1#TOP3', date: '16/06/25', source: 'BSPay', type: 'Top Up Point', amount: 'Rp50.000', point: '50', status: 'Selesai' },
             '4': { invoice: '1#TOP4', date: '16/06/25', source: 'Toko BijakSampah', type: 'Penjualan Produk', amount: 'Rp60.000', point: '60', status: 'Selesai' },
             '5': { invoice: '1#TOP5', date: '16/06/25', source: 'BSPay', type: 'Top Up Point', amount: 'Rp70.000', point: '70', status: 'Selesai' },
             '6': { invoice: '1#TOP6', date: '16/06/25', source: 'Toko BijakSampah', type: 'Penjualan Produk', amount: 'Rp80.000', point: '80', status: 'Selesai' },
             '7': { invoice: '1#TOP7', date: '16/06/25', source: 'BSPay', type: 'Top Up Point', amount: 'Rp90.000', point: '90', status: 'Selesai' }
         };
     } else {
         details = {
             '3': { invoice: '1#BELI3', date: '16/06/25', buyer: 'Wugis', type: 'Sampah Organik', amount: 'Rp10.000', point: '10', status: 'Selesai' },
             '4': { invoice: '1#BELI4', date: '16/06/25', buyer: 'BS', type: 'Sampah Anorganik', amount: 'Rp15.000', point: '15', status: 'Selesai' },
             '5': { invoice: '1#BELI5', date: '16/06/25', buyer: 'Wugis', type: 'Sampah B3', amount: 'Rp20.000', point: '20', status: 'Selesai' },
             '6': { invoice: '1#BELI6', date: '16/06/25', buyer: 'BS', type: 'Sampah Organik', amount: 'Rp25.000', point: '25', status: 'Selesai' },
             '7': { invoice: '1#BELI7', date: '16/06/25', buyer: 'Wugis', type: 'Sampah Anorganik', amount: 'Rp30.000', point: '30', status: 'Selesai' }
         };
     }
     
     const transaction = details[id];
     if (transaction) {
         // Cache the transaction data
         transactionCache.set(id, { transaction, currentTab });
         showTransactionModal({ transaction, currentTab });
     } else {
         alert('Error: Transaksi tidak ditemukan');
     }
 }
 
 function showTransactionModal({ transaction, currentTab }) {
     const label1 = currentTab === 'pemasukan' ? 'Sumber' : 'Pembeli';
     const label2 = currentTab === 'pemasukan' ? 'Jenis Transaksi' : 'Jenis Sampah';
     const value1 = currentTab === 'pemasukan' ? transaction.source : transaction.buyer;
     const value2 = currentTab === 'pemasukan' ? transaction.type : transaction.type;
     
     const modal = document.getElementById('transactionModal');
     const detailsElement = document.getElementById('transactionDetails');
     
     if (modal && detailsElement) {
         detailsElement.innerHTML = `
             <div class="space-y-3">
                 <div class="flex justify-between">
                     <span class="font-medium text-gray-700">No. Invoice:</span>
                     <span class="font-semibold">${transaction.invoice}</span>
                 </div>
                 <div class="flex justify-between">
                     <span class="font-medium text-gray-700">Tanggal:</span>
                     <span class="font-semibold">${transaction.date}</span>
                 </div>
                 <div class="flex justify-between">
                     <span class="font-medium text-gray-700">${label1}:</span>
                     <span class="font-semibold">${value1}</span>
                 </div>
                 <div class="flex justify-between">
                     <span class="font-medium text-gray-700">${label2}:</span>
                     <span class="font-semibold">${value2}</span>
                 </div>
                 <div class="flex justify-between">
                     <span class="font-medium text-gray-700">Jumlah:</span>
                     <span class="font-semibold text-green-600">${transaction.amount} (${transaction.point} Koin)</span>
                 </div>
                 <div class="flex justify-between">
                     <span class="font-medium text-gray-700">Status:</span>
                     <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">${transaction.status}</span>
                 </div>
             </div>
         `;
         modal.classList.remove('hidden');
     } else {
         alert('Error: Modal tidak ditemukan');
     }
 }

 function hideTransactionModal() {
     document.getElementById('transactionModal').classList.add('hidden');
 }

 function downloadInvoice(id) {
     // Show loading state
     const button = event.target;
     const originalText = button.innerHTML;
     button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
     button.disabled = true;
     
     // Simulate download delay
     setTimeout(() => {
         alert(`Mengunduh invoice ${id}...`);
         button.innerHTML = originalText;
         button.disabled = false;
     }, 500);
 }

 function showTransactionMenu(id) {
     alert(`Menu untuk transaksi ${id}`);
     // Implement dropdown menu functionality
 }

 function previousPage() {
     alert('Halaman sebelumnya');
     // Implement pagination
 }

 function nextPage() {
     alert('Halaman berikutnya');
     // Implement pagination
 }
 </script>
 @endsection 