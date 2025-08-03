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
    
    /* Dark theme overrides for input setoran1 page */
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

    /* Notification badge */
    .notification-badge {
        background: white;
        color: #059669;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
    }

    /* Form styles */
    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: border-color 0.2s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .waste-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .waste-checkbox {
        width: 1rem;
        height: 1rem;
        border: 2px solid #d1d5db;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    .waste-weight-input {
        width: 4rem;
        padding: 0.25rem;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        text-align: center;
        font-size: 0.75rem;
    }

    .deposit-button {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .deposit-button:hover {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    /* Success Modal Styles */
    .success-modal {
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

    .success-modal-content {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .success-icon {
        width: 60px;
        height: 60px;
        background: #dcfce7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .success-icon i {
        color: #16a34a;
        font-size: 24px;
    }

    .amount-display {
        margin-bottom: 1rem;
    }

    .currency-symbol {
        font-size: 1rem;
        color: #6b7280;
        vertical-align: top;
    }

    .amount-value {
        font-size: 2rem;
        font-weight: bold;
        color: #1e40af;
    }

    .success-message {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.5;
    }
</style>

<div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="inputSetoran1App()" x-init="init()">
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'penimbangan' }"
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
                    <i class="fas fa-map-marker-alt text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Penjemputan Sampah</span>
                </a>
                
                {{-- Penimbangan Section --}}
                <div class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full cursor-pointer active" :class="open ? (active === 'penimbangan' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penimbangan' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')" @click="active = active === 'penimbangan' ? '' : 'penimbangan'">
                    <i class="fas fa-weight-hanging text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Penimbangan</span>
                    <i x-show="open" class="fas fa-chevron-down text-xs ml-auto transition-transform" :class="active === 'penimbangan' ? 'rotate-180' : ''"></i>
                </div>
                
                {{-- Sub-menu Penimbangan --}}
                <div x-show="open && active === 'penimbangan'" x-transition class="ml-4 space-y-1">
                    <a href="{{ route('input-setoran1') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm active" :class="active === 'input-setoran1' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
                        <i class="fas fa-plus text-sm"></i>
                        <span class="text-xs font-medium">Input Setoran</span>
                    </a>
                </div>
                
                                 {{-- Data Sampah Link --}}
                 <a href="{{ route('data-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'data-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'data-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                     <i class="fas fa-list text-lg"></i>
                     <span x-show="open" class="text-xs font-medium">Data Sampah</span>
                 </a>
                
                {{-- Penjualan Sampah Link --}}
                <a href="{{ route('penjualan-sampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'penjualan-sampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'penjualan-sampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-store text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Penjualan Sampah</span>
                </a>
                
                {{-- Settings Link --}}
                <a href="{{ route('settings-banksampah') }}" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-hover whitespace-nowrap w-full" :class="open ? (active === 'settings-banksampah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white') : (active === 'settings-banksampah' ? 'bg-white/20 text-white justify-center' : 'hover:bg-white/20 text-white justify-center')">
                    <i class="fas fa-cog text-lg"></i>
                    <span x-show="open" class="text-xs font-medium">Settings</span>
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
                    <h1 class="text-white font-semibold text-lg">Setoran Nasabah</h1>
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
            {{-- Page Title --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Input Setoran Nasabah</h1>
            </div>

            {{-- Form Section --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form x-data="setoranForm()" @submit.prevent="submitForm()">
                    {{-- Customer Information --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" x-model="formData.namaLengkap" class="form-input" placeholder="Masukkan nama nasabah">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No Rekening</label>
                            <input type="text" x-model="formData.noRekening" class="form-input" placeholder="Masukkan rekening nasabah">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <input type="text" x-model="formData.alamat" class="form-input" placeholder="Masukkan alamat nasabah">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ID Unit Bak Sampah</label>
                            <input type="text" x-model="formData.idUnitBakSampah" class="form-input" placeholder="Masukkan ID Bak Sampah">
                        </div>
                    </div>

                    {{-- Waste Categories --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Jenis Sampah</h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            {{-- Plastik Column --}}
                            <div class="space-y-2">
                                <h4 class="font-medium text-gray-700 mb-3">Plastik</h4>
                                <template x-for="item in wasteItems.plastik" :key="item.id">
                                    <div class="waste-item">
                                        <input type="checkbox" x-model="item.checked" class="waste-checkbox">
                                        <span class="text-sm flex-1" x-text="item.name"></span>
                                        <input type="number" x-model="item.weight" class="waste-weight-input" placeholder="0">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </template>
                            </div>

                            {{-- Logam Column --}}
                            <div class="space-y-2">
                                <h4 class="font-medium text-gray-700 mb-3">Logam</h4>
                                <template x-for="item in wasteItems.logam" :key="item.id">
                                    <div class="waste-item">
                                        <input type="checkbox" x-model="item.checked" class="waste-checkbox">
                                        <span class="text-sm flex-1" x-text="item.name"></span>
                                        <input type="number" x-model="item.weight" class="waste-weight-input" placeholder="0">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </template>
                            </div>

                            {{-- Kertas Column --}}
                            <div class="space-y-2">
                                <h4 class="font-medium text-gray-700 mb-3">Kertas</h4>
                                <template x-for="item in wasteItems.kertas" :key="item.id">
                                    <div class="waste-item">
                                        <input type="checkbox" x-model="item.checked" class="waste-checkbox">
                                        <span class="text-sm flex-1" x-text="item.name"></span>
                                        <input type="number" x-model="item.weight" class="waste-weight-input" placeholder="0">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Lain-lain Section --}}
                        <div class="mt-6">
                            <h4 class="font-medium text-gray-700 mb-3">Lain-lain</h4>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <template x-for="item in wasteItems.lainLain" :key="item.id">
                                    <div class="waste-item">
                                        <input type="checkbox" x-model="item.checked" class="waste-checkbox">
                                        <span class="text-sm flex-1" x-text="item.name"></span>
                                        <input type="number" x-model="item.weight" class="waste-weight-input" placeholder="0">
                                        <span class="text-xs text-gray-500">gram</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- Summary Section --}}
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Total Setoran Sampah</h4>
                                <div class="text-2xl font-bold text-green-600" x-text="totalWeight + ' gr'"></div>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Nominal Harga Setoran</h4>
                                <div class="text-2xl font-bold text-blue-600" x-text="totalPrice"></div>
                            </div>
                        </div>
                    </div>

                                         {{-- Submit Button --}}
                     <div class="flex justify-center">
                         <button type="submit" class="deposit-button">
                             Setorkan
                         </button>
                     </div>

                     {{-- Success Modal --}}
                     <div x-show="showSuccessModal" x-transition class="success-modal" @click.self="closeSuccessModal()">
                         <div class="success-modal-content">
                             <div class="success-icon">
                                 <i class="fas fa-check"></i>
                             </div>
                             <div class="amount-display">
                                 <span class="currency-symbol">Rp</span>
                                 <span class="amount-value" x-text="successAmount">00,00</span>
                             </div>
                             <div class="success-message">
                                 Telah berhasil masuk rekening nasabah <span x-text="formData.namaLengkap || 'Jane Copper'">Jane Copper</span> dengan konversi poin sebesar <span x-text="successPoints">10</span> poin.
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

<script>
function inputSetoran1App() {
    return {
        sidebarOpen: false,
        init() {
            console.log('Input Setoran1 App initialized');
        }
    };
}

function setoranForm() {
    return {
        showSuccessModal: false,
        successAmount: '00,00',
        successPoints: 10,
        formData: {
            namaLengkap: '',
            noRekening: '',
            alamat: '',
            idUnitBakSampah: ''
        },
        wasteItems: {
            plastik: [
                { id: 1, name: 'Plastik Botol Bening', checked: false, weight: 0 },
                { id: 2, name: 'Plastik Botol Warna', checked: false, weight: 0 },
                { id: 3, name: 'Plastik Gelas Kecil', checked: false, weight: 0 },
                { id: 4, name: 'Plastik Kerasan', checked: false, weight: 0 },
                { id: 5, name: 'Plastik Emberan', checked: false, weight: 0 },
                { id: 6, name: 'Plastik Kacas', checked: false, weight: 0 }
            ],
            logam: [
                { id: 7, name: 'Aluminium Kaleng Minuman', checked: false, weight: 0 },
                { id: 8, name: 'Aluminium Biasa', checked: false, weight: 0 },
                { id: 9, name: 'Besi Putih', checked: false, weight: 0 },
                { id: 10, name: 'Baut Motor', checked: false, weight: 0 }
            ],
            kertas: [
                { id: 11, name: 'Kertas Koran', checked: false, weight: 0 },
                { id: 12, name: 'Kertas HVS', checked: false, weight: 0 },
                { id: 13, name: 'Kertas Duplex', checked: false, weight: 0 }
            ],
            lainLain: [
                { id: 14, name: 'Botol Kaca', checked: false, weight: 0 },
                { id: 15, name: 'Minyak Jelantah', checked: false, weight: 0 }
            ]
        },
        get totalWeight() {
            let total = 0;
            Object.values(this.wasteItems).flat().forEach(item => {
                if (item.checked && item.weight) {
                    total += parseFloat(item.weight) || 0;
                }
            });
            return total.toFixed(1);
        },
        get totalPrice() {
            const weight = parseFloat(this.totalWeight);
            const pricePerGram = 0.05; // Rp 0.05 per gram
            const total = weight * pricePerGram;
            return 'Rp ' + total.toFixed(2).replace('.', ',');
        },
        submitForm() {
            console.log('Form submitted:', this.formData);
            console.log('Waste items:', this.wasteItems);
            console.log('Total weight:', this.totalWeight);
            console.log('Total price:', this.totalPrice);
            
            // Set success modal data
            this.successAmount = this.totalPrice.replace('Rp ', '');
            this.successPoints = Math.floor(parseFloat(this.totalWeight) / 10); // 1 point per 10 grams
            
            // Show success modal
            this.showSuccessModal = true;
        },
        closeSuccessModal() {
            this.showSuccessModal = false;
        }
    };
}
</script>
@endsection
