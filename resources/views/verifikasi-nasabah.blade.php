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
    .notification-badge {
        background: white;
        color: #1e40af;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 600;
    }
    .review-button {
        background: #dc2626;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .review-button:hover {
        background: #b91c1c;
    }
    .pagination-button {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
        border-radius: 6px;
        margin: 0 2px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .pagination-button:hover {
        background: #f3f4f6;
    }
    .pagination-button.active {
        background: #1e40af;
        color: white;
        border-color: #1e40af;
    }
    
    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }
    
    .modal-content {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
    }
    
    .modal-title {
        color: #1e40af;
        font-size: 1.5rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background-color: #f9fafb;
        color: #374151;
        font-size: 0.875rem;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #1e40af;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }
    
    .next-button {
        background: #1e40af;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s;
        display: block;
        margin: 0 auto;
        margin-top: 1rem;
    }
    
    .next-button:hover {
        background: #1e3a8a;
    }
    
    /* Action Buttons */
    .action-button {
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .reject-button {
        background: #dc2626;
        color: white;
    }
    
    .reject-button:hover {
        background: #b91c1c;
    }
    
    .accept-button {
        background: #16a34a;
        color: white;
    }
    
    .accept-button:hover {
        background: #15803d;
    }
    
    /* Verification Button */
    .verify-button {
        background: #1e40af;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s;
        display: block;
        margin: 0 auto;
        margin-top: 1rem;
    }
    
    .verify-button:hover {
        background: #1e3a8a;
    }
    
    /* Dark theme overrides for settings page */
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

<div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="verifikasiNasabahApp()" x-init="init()">
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'verifikasi-nasabah' }"
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
                    <a href="{{ route('verifikasi-nasabah') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm active" :class="active === 'verifikasi-nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
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
                    <h1 class="text-white font-semibold text-lg">Verifikasi Nasabah</h1>
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
            {{-- Page Title and Controls --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Verifikasi</h1>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Sort by: Terbaru</option>
                        <option>Sort by: Terlama</option>
                        <option>Sort by: A-Z</option>
                    </select>
                </div>
            </div>

            {{-- Verification Table --}}
            <div class="settings-card">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Nasabah</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Tanggal Pengajuan</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Email</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Jane Cooper</td>
                                <td class="py-3 px-4 text-gray-600">12-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">jane@microsoft.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Jane Cooper', 'jane@microsoft.com', '+62 85725517237', 'Jl. Golf Perum Citra Sari', 'RT 33 RW 07')">Tinjau</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Floyd Miles</td>
                                <td class="py-3 px-4 text-gray-600">12-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">floyd@yahoo.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Floyd Miles', 'floyd@yahoo.com', '+62 85725517238', 'Jl. Sudirman No. 123', 'RT 15 RW 03')">Tinjau</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Ronald Richards</td>
                                <td class="py-3 px-4 text-gray-600">12-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">ronald@adobe.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Ronald Richards', 'ronald@adobe.com', '+62 85725517239', 'Jl. Thamrin No. 45', 'RT 22 RW 08')">Tinjau</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Marvin McKinney</td>
                                <td class="py-3 px-4 text-gray-600">11-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">marvin@tesla.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Marvin McKinney', 'marvin@tesla.com', '+62 85725517240', 'Jl. Gatot Subroto No. 67', 'RT 11 RW 05')">Tinjau</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Cody Fisher</td>
                                <td class="py-3 px-4 text-gray-600">11-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">cody@netflix.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Cody Fisher', 'cody@netflix.com', '+62 85725517241', 'Jl. Sudirman No. 89', 'RT 44 RW 12')">Tinjau</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Esther Howard</td>
                                <td class="py-3 px-4 text-gray-600">10-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">esther@spotify.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Esther Howard', 'esther@spotify.com', '+62 85725517242', 'Jl. Thamrin No. 12', 'RT 18 RW 06')">Tinjau</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Annette Black</td>
                                <td class="py-3 px-4 text-gray-600">10-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">annette@uber.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Annette Black', 'annette@uber.com', '+62 85725517243', 'Jl. Gatot Subroto No. 34', 'RT 25 RW 09')">Tinjau</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">Darlene Robertson</td>
                                <td class="py-3 px-4 text-gray-600">09-05-2025</td>
                                <td class="py-3 px-4 text-gray-600">darlene@airbnb.com</td>
                                <td class="py-3 px-4">
                                    <button class="review-button" @click="openReviewModal('Darlene Robertson', 'darlene@airbnb.com', '+62 85725517244', 'Jl. Sudirman No. 78', 'RT 31 RW 11')">Tinjau</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination --}}
                <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100">
                    <div class="text-sm text-gray-600">
                        Showing data 1 to 8 of 256K entries
                    </div>
                    <div class="flex items-center gap-1">
                        <button class="pagination-button">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </button>
                        <button class="pagination-button active">1</button>
                        <button class="pagination-button">2</button>
                        <button class="pagination-button">3</button>
                        <button class="pagination-button">4</button>
                        <span class="px-2 text-gray-500">...</span>
                        <button class="pagination-button">40</button>
                        <button class="pagination-button">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Review Modal --}}
    <div x-show="showReviewModal" x-transition class="modal-overlay" @click.self="closeReviewModal()">
        <div class="modal-content">
            <h2 class="modal-title">Data Alamat</h2>
            
            <form @submit.prevent="submitReviewForm()">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" x-model="reviewData.email" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" x-model="reviewData.namaLengkap" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-input" x-model="reviewData.nomorTelepon" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-input" x-model="reviewData.alamat" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">RT/RW</label>
                    <input type="text" class="form-input" x-model="reviewData.rtRw" readonly>
                </div>
                
                <button type="button" class="next-button" @click="openPersonalDataModal()">Berikutnya</button>
            </form>
        </div>
    </div>

    {{-- Personal Data Modal --}}
    <div x-show="showPersonalDataModal" x-transition class="modal-overlay" @click.self="closePersonalDataModal()">
        <div class="modal-content">
            <h2 class="modal-title">Data Pribadi</h2>
            
            <form @submit.prevent="submitPersonalDataForm()">
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="text" class="form-input" x-model="personalData.tanggalLahir" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-input" x-model="personalData.jenisKelamin" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-input" x-model="personalData.nik" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">No KK</label>
                    <input type="text" class="form-input" x-model="personalData.noKk" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Posisi Dalam Keluarga</label>
                    <input type="text" class="form-input" x-model="personalData.posisiKeluarga" readonly>
                </div>
                
                <div class="flex gap-4 justify-center mt-6">
                    <button type="button" class="action-button reject-button" @click="rejectVerification()">Tolak</button>
                    <button type="button" class="action-button accept-button" @click="openWasteBinModal()">Terima</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Waste Bin Registration Modal --}}
    <div x-show="showWasteBinModal" x-transition class="modal-overlay" @click.self="closeWasteBinModal()">
        <div class="modal-content">
            <h2 class="modal-title">Pendaftaran Unit Bak Sampah</h2>
            
            <form @submit.prevent="submitWasteBinForm()">
                <div class="form-group">
                    <label class="form-label">Jenis Bak Sampah</label>
                    <input type="text" class="form-input" x-model="wasteBinData.jenisBak" placeholder="Masukkan jenis unit bak yang akan diserahkan" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">No Bak Sampah</label>
                    <input type="text" class="form-input" x-model="wasteBinData.noBak" placeholder="Masukkan no bak sampah yang akan diserahkan" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">ID Unit Bak sampah</label>
                    <input type="text" class="form-input" x-model="wasteBinData.idUnit" placeholder="Masukkan ID alat bak sampah" required>
                </div>
                
                <button type="submit" class="verify-button">Verifikasi</button>
            </form>
        </div>
    </div>
</div>

<script>
    function verifikasiNasabahApp() {
        return {
            showReviewModal: false,
            showPersonalDataModal: false,
            showWasteBinModal: false,
            reviewData: {
                email: '',
                namaLengkap: '',
                nomorTelepon: '',
                alamat: '',
                rtRw: ''
            },
            personalData: {
                tanggalLahir: '',
                jenisKelamin: '',
                nik: '',
                noKk: '',
                posisiKeluarga: ''
            },
            wasteBinData: {
                jenisBak: '',
                noBak: '',
                idUnit: ''
            },
            init() {
                console.log('Verifikasi Nasabah App initialized');
            },
            openReviewModal(nama, email, telepon, alamat, rtRw) {
                this.reviewData.namaLengkap = nama;
                this.reviewData.email = email;
                this.reviewData.nomorTelepon = telepon;
                this.reviewData.alamat = alamat;
                this.reviewData.rtRw = rtRw;
                this.showReviewModal = true;
            },
            closeReviewModal() {
                this.showReviewModal = false;
            },
            openPersonalDataModal() {
                // Set sample personal data based on the current review data
                this.personalData.tanggalLahir = '25-10-1997';
                this.personalData.jenisKelamin = 'Laki-laki';
                this.personalData.nik = '6475299382400000';
                this.personalData.noKk = '6475299382400000';
                this.personalData.posisiKeluarga = 'Kepala keluarga';
                this.showPersonalDataModal = true;
                this.closeReviewModal();
            },
            closePersonalDataModal() {
                this.showPersonalDataModal = false;
            },
            openWasteBinModal() {
                this.showWasteBinModal = true;
                this.closePersonalDataModal();
            },
            closeWasteBinModal() {
                this.showWasteBinModal = false;
            },
            submitReviewForm() {
                // Handle form submission
                console.log('Review form submitted:', this.reviewData);
                this.openPersonalDataModal();
            },
            rejectVerification() {
                alert('Verifikasi ditolak!');
                this.closePersonalDataModal();
            },
            submitWasteBinForm() {
                // Handle waste bin form submission
                console.log('Waste bin form submitted:', this.wasteBinData);
                alert('Pendaftaran unit bak sampah berhasil!');
                this.closeWasteBinModal();
            }
        }
    }
</script>
@endsection 