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
    
    .customer-name-link {
        color: #1e40af;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .customer-name-link:hover {
        color: #f16728;
        text-decoration: underline;
    }
    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
    }
    .status.active {
        background-color: #e6f7e6;
        color: #2b8a3e;
    }
    .status.inactive {
        background-color: #fdeaea;
        color: #c0392b;
    }
</style>

<div class="flex min-h-screen" style="background-color: var(--bg-secondary);" x-data="dataNasabahApp()" x-init="init()">
    {{-- Sidebar --}}
    <aside
        x-data="{ open: false, active: 'data-nasabah' }"
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
                    <a href="{{ route('data-nasabah-banksampah') }}" class="flex items-center gap-3 p-2 rounded-lg sidebar-item-hover whitespace-nowrap w-full text-sm active" :class="active === 'data-nasabah' ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/20 text-white'">
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
                    <h1 class="text-white font-semibold text-lg">Data Nasabah</h1>
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
                <h1 class="text-3xl font-bold text-gray-900">Data Nasabah</h1>
                <p class="text-gray-600 mt-2">Kelola dan pantau semua data nasabah bank sampah</p>
            </div>

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="settings-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Nasabah</p>
                            <p class="text-2xl font-bold text-gray-900" id="totalCustomers">0</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2">⬆ 4% bulan ini</p>
                </div>

                <div class="settings-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nasabah Aktif</p>
                            <p class="text-2xl font-bold text-gray-900" id="activeCustomers">0</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-user-check text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-red-600 mt-2">⬇ 1% bulan ini</p>
                </div>

                <div class="settings-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nasabah Non-Aktif</p>
                            <p class="text-2xl font-bold text-gray-900" id="inactiveCustomers">0</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <i class="fas fa-user-times text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Customers Table --}}
            <div class="settings-card">
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Semua Nasabah</h2>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Cari nasabah..." 
                                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            <select id="sortSelect" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Nasabah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody id="customersTableBody" class="divide-y divide-gray-100">
                            <!-- Data akan dimuat dari Firebase -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dataNasabahApp() {
        return {
            init() {
                this.loadCustomersData();
            },
            loadCustomersData() {
                // Firebase configuration
                const firebaseConfig = {
                    apiKey: "AIzaSyAJhkCyNT0be2x6FSzyUz0Ye9xX-QihIBo",
                    authDomain: "bijaksampah-aeb82.firebaseapp.com",
                    databaseURL: "https://bijaksampah-aeb82-default-rtdb.asia-southeast1.firebasedatabase.app",
                    projectId: "bijaksampah-aeb82",
                    storageBucket: "bijaksampah-aeb82.appspot.com",
                    messagingSenderId: "140467230562",
                    appId: "1:140467230562:web:19a34dfefcb6f65bd7fe3b"
                };

                // Initialize Firebase
                if (!firebase.apps.length) {
                    firebase.initializeApp(firebaseConfig);
                }
                const database = firebase.database();

                // Load customers data from Firebase
                database.ref('users').orderByChild('role').equalTo('Nasabah').on('value', (snapshot) => {
                    const customersData = snapshot.val();
                    const customersArray = [];
                    let activeCount = 0;
                    let inactiveCount = 0;

                    const customersTableBody = document.getElementById('customersTableBody');
                    const totalCustomers = document.getElementById('totalCustomers');
                    const activeCustomers = document.getElementById('activeCustomers');
                    const inactiveCustomers = document.getElementById('inactiveCustomers');

                    customersTableBody.innerHTML = '';

                    if (customersData) {
                        Object.keys(customersData).forEach((key) => {
                            const customer = customersData[key];
                            customer.id = key;
                            customersArray.push(customer);

                            // Semua dianggap aktif karena tidak ada field status di data Anda
                            activeCount++;

                            // Tambahkan row ke tabel dengan struktur data yang sesuai
                            const row = document.createElement('tr');
                            row.className = 'hover:bg-gray-50';
                            row.innerHTML = `
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="/profile-nasabah?id=${customer.id}" class="customer-name-link">${customer.firstName || ''} ${customer.lastName || ''}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${customer.address || 'N/A'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${customer.city || 'N/A'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${customer.email || 'N/A'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${customer.phone || 'N/A'}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status active">Active</span>
                                </td>
                            `;
                            customersTableBody.appendChild(row);
                        });

                        totalCustomers.textContent = customersArray.length;
                        activeCustomers.textContent = activeCount;
                        inactiveCustomers.textContent = inactiveCount;
                    } else {
                        customersTableBody.innerHTML = `
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data nasabah yang tersedia
                                </td>
                            </tr>
                        `;
                    }
                }, (error) => {
                    console.error("Error membaca data:", error);
                });
            }
        }
    }

    // Add event listeners for search and sort
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('#customersTableBody tr');

            rows.forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const email = row.cells[3].textContent.toLowerCase();
                const phone = row.cells[4].textContent.toLowerCase();
                
                if (name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        sortSelect.addEventListener('change', function() {
            console.log('Sort by:', sortSelect.value);
        });
    });
</script>
@endsection