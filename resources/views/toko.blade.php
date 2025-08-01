<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Daur Ulang - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html, body { 
            overflow-x: hidden; 
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }
        
        /* Sidebar Styles */
        .sidebar-gradient { 
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .sidebar-hover { 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .sidebar-item-hover { 
            transition: all 0.2s ease-in-out; 
        }
        .sidebar-item-hover:hover { 
            background-color: rgba(255, 255, 255, 0.1); 
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
        
        /* Header/Topbar Styles */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        /* Main Content Styles */
        .main-content-wrapper {
            min-height: 100vh;
            background: #f8fafc;
            padding-top: 90px;
            padding-left: 280px;
            transition: all 0.3s ease;
        }
        
        .content-container { 
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Card Styles */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Table Styles */
        .admin-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        
        .admin-table th {
            background: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }
        
        /* Button Styles */
        .btn-primary {
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: #2563eb;
        }
        
        .btn-success {
            background: #10b981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-success:hover {
            background: #059669;
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
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
        .status-active { background: #dcfce7; color: #166534; }
        .status-inactive { background: #fee2e2; color: #991b1b; }
        .status-pending { background: #fef3c7; color: #92400e; }
        
        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
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
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content-wrapper { padding-left: 80px; }
            .content-container { padding: 1.5rem; }
        }
        
        @media (max-width: 768px) {
            .main-content-wrapper { padding-left: 0; padding-top: 70px; }
            .content-container { padding: 1rem; }
            .topbar { padding: 0 1rem; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen" x-data="adminApp()" x-init="init()">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-40">
            <div class="flex flex-col h-full">
                <!-- Logo Section -->
                <div class="flex items-center justify-center h-16 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-recycle text-white text-sm"></i>
                        </div>
                        <span class="text-lg font-bold text-gray-900">Toko Daur Ulang</span>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-home text-lg"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-blue-600 bg-blue-50 rounded-lg">
                        <i class="fas fa-box text-lg"></i>
                        <span>Produk</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span>Pesanan</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-users text-lg"></i>
                        <span>Pelanggan</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-chart-line text-lg"></i>
                        <span>Analitik</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <i class="fas fa-cog text-lg"></i>
                        <span>Pengaturan</span>
                    </a>
                </nav>
                
                <!-- User Profile -->
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center space-x-3">
                        <img src="https://via.placeholder.com/40x40/3b82f6/ffffff?text=A" alt="Admin" class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Admin Toko</p>
                            <p class="text-xs text-gray-500">admin@tokodaurulang.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content-wrapper">
            <!-- Topbar -->
            <div class="topbar">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold text-gray-900">Dashboard Admin</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Cari produk, pesanan..." 
                               class="w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <!-- Notifications -->
                    <button @click="showNotifications = true" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    
                    <!-- Admin Profile -->
                    <div class="flex items-center space-x-3">
                        <img src="https://via.placeholder.com/32x32/3b82f6/ffffff?text=A" alt="Admin" class="w-8 h-8 rounded-full">
                        <span class="text-sm font-medium text-gray-900">Admin</span>
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Content Container -->
            <div class="content-container">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Produk</p>
                                <p class="text-2xl font-bold text-gray-900">247</p>
                                <p class="text-xs text-green-600">+12% dari bulan lalu</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pesanan Hari Ini</p>
                                <p class="text-2xl font-bold text-gray-900">89</p>
                                <p class="text-xs text-green-600">+8% dari kemarin</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pendapatan Bulan Ini</p>
                                <p class="text-2xl font-bold text-gray-900">Rp 12.5M</p>
                                <p class="text-xs text-green-600">+15% dari bulan lalu</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pelanggan Aktif</p>
                                <p class="text-2xl font-bold text-gray-900">1,247</p>
                                <p class="text-xs text-green-600">+23% dari bulan lalu</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Kelola Produk</h2>
                            <button @click="showAddProduct = true" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>Tambah Produk
                            </button>
                        </div>
                    </div>
                    
                    <!-- Products Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=60&q=80" 
                                                 alt="Tas Kreasi" class="w-12 h-12 rounded-lg object-cover">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Tas Kreasi Daur Ulang</div>
                                                <div class="text-sm text-gray-500">@Wugis</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Aksesoris</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 20.000</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">45</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-active">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="btn-warning mr-2">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        <button class="btn-danger">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=60&q=80" 
                                                 alt="Botol Plastik" class="w-12 h-12 rounded-lg object-cover">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Botol Plastik Daur Ulang</div>
                                                <div class="text-sm text-gray-500">@RecyclePro</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Plastik</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 15.000</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">120</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-active">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="btn-warning mr-2">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        <button class="btn-danger">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=60&q=80" 
                                                 alt="Kertas Bekas" class="w-12 h-12 rounded-lg object-cover">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Kertas Bekas Premium</div>
                                                <div class="text-sm text-gray-500">@PaperCraft</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Kertas</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 25.000</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">30</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-pending">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="btn-warning mr-2">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        <button class="btn-danger">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div x-show="showAddProduct" class="modal-overlay" @click.away="showAddProduct = false">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Tambah Produk Baru</h3>
                <button @click="showAddProduct = false" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form @submit.prevent="addProduct()">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                        <input type="text" x-model="newProduct.name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
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
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <input type="number" x-model="newProduct.price" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                            <input type="number" x-model="newProduct.stock" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea x-model="newProduct.description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                        <input type="url" x-model="newProduct.image" placeholder="https://example.com/image.jpg"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
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

    <!-- Notifications Modal -->
    <div x-show="showNotifications" class="modal-overlay" @click.away="showNotifications = false">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Notifikasi</h3>
                <button @click="showNotifications = false" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Pesanan baru diterima</p>
                        <p class="text-xs text-gray-600 mt-1">2 menit yang lalu</p>
                    </div>
                </div>
                
                <div class="flex items-start p-4 bg-green-50 rounded-lg border border-green-200">
                    <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Pembayaran berhasil</p>
                        <p class="text-xs text-gray-600 mt-1">5 menit yang lalu</p>
                    </div>
                </div>
                
                <div class="flex items-start p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Stok produk menipis</p>
                        <p class="text-xs text-gray-600 mt-1">10 menit yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function adminApp() {
            return {
                // Modal States
                showAddProduct: false,
                showNotifications: false,
                
                // Form Data
                newProduct: {
                    name: '',
                    category: '',
                    price: '',
                    stock: '',
                    description: '',
                    image: ''
                },
                
                // Methods
                init() {
                    console.log('Admin app initialized');
                },
                
                addProduct() {
                    if (!this.newProduct.name || !this.newProduct.price || !this.newProduct.stock) {
                        alert('Mohon lengkapi semua field yang diperlukan!');
                        return;
                    }
                    
                    // Simulate adding product
                    console.log('Adding product:', this.newProduct);
                    alert('Produk berhasil ditambahkan!');
                    this.showAddProduct = false;
                    this.resetProductForm();
                },
                
                resetProductForm() {
                    this.newProduct = {
                        name: '',
                        category: '',
                        price: '',
                        stock: '',
                        description: '',
                        image: ''
                    };
                }
            }
        }
    </script>
</body>
</html> 