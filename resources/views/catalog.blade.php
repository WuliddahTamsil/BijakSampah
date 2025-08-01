@extends('layouts.admin')

@section('title', 'Katalog Produk')
@section('page-title', 'Katalog Produk')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Katalog Produk Daur Ulang</h1>
        <p class="text-gray-600 mt-2">Temukan produk daur ulang berkualitas untuk kebutuhan Anda</p>
    </div>

    <!-- Filter Section -->
    <div class="admin-card">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-0">
                <input type="text" placeholder="Cari produk..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Kategori</option>
                <option value="aksesoris">Aksesoris</option>
                <option value="plastik">Plastik</option>
                <option value="kertas">Kertas</option>
                <option value="logam">Logam</option>
                <option value="elektronik">Elektronik</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Urutkan</option>
                <option value="price-low">Harga Terendah</option>
                <option value="price-high">Harga Tertinggi</option>
                <option value="newest">Terbaru</option>
                <option value="popular">Terpopuler</option>
            </select>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Product Card 1 -->
        <div class="admin-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=400&q=80" 
                     alt="Tas Kreasi" class="w-full h-48 object-cover rounded-lg">
                <div class="absolute top-2 left-2">
                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Aktif</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-sm text-gray-500">@Wugis</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Tas Kreasi Daur Ulang</h3>
                <p class="text-sm text-gray-600 mb-3">Tas cantik hasil daur ulang dengan desain unik</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-blue-600">Rp 20.000</span>
                    <span class="text-sm text-gray-500">Stok: 45</span>
                </div>
            </div>
        </div>

        <!-- Product Card 2 -->
        <div class="admin-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=400&q=80" 
                     alt="Botol Plastik" class="w-full h-48 object-cover rounded-lg">
                <div class="absolute top-2 left-2">
                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Aktif</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-sm text-gray-500">@RecyclePro</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Botol Plastik Daur Ulang</h3>
                <p class="text-sm text-gray-600 mb-3">Botol plastik berkualitas tinggi hasil daur ulang</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-blue-600">Rp 15.000</span>
                    <span class="text-sm text-gray-500">Stok: 120</span>
                </div>
            </div>
        </div>

        <!-- Product Card 3 -->
        <div class="admin-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=400&q=80" 
                     alt="Kertas Bekas" class="w-full h-48 object-cover rounded-lg">
                <div class="absolute top-2 left-2">
                    <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-sm text-gray-500">@PaperCraft</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Kertas Bekas Premium</h3>
                <p class="text-sm text-gray-600 mb-3">Kertas bekas premium untuk keperluan kantor</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-blue-600">Rp 25.000</span>
                    <span class="text-sm text-gray-500">Stok: 30</span>
                </div>
            </div>
        </div>

        <!-- Product Card 4 -->
        <div class="admin-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=400&q=80" 
                     alt="Kaleng Aluminium" class="w-full h-48 object-cover rounded-lg">
                <div class="absolute top-2 left-2">
                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Aktif</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-sm text-gray-500">@MetalCraft</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Kaleng Aluminium Daur Ulang</h3>
                <p class="text-sm text-gray-600 mb-3">Kaleng aluminium berkualitas untuk berbagai keperluan</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-blue-600">Rp 18.000</span>
                    <span class="text-sm text-gray-500">Stok: 75</span>
                </div>
            </div>
        </div>

        <!-- Product Card 5 -->
        <div class="admin-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?auto=format&fit=crop&w=400&q=80" 
                     alt="Elektronik" class="w-full h-48 object-cover rounded-lg">
                <div class="absolute top-2 left-2">
                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Aktif</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-sm text-gray-500">@EcoTech</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Komponen Elektronik Daur Ulang</h3>
                <p class="text-sm text-gray-600 mb-3">Komponen elektronik berkualitas hasil daur ulang</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-blue-600">Rp 35.000</span>
                    <span class="text-sm text-gray-500">Stok: 25</span>
                </div>
            </div>
        </div>

        <!-- Product Card 6 -->
        <div class="admin-card">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=400&q=80" 
                     alt="Aksesoris" class="w-full h-48 object-cover rounded-lg">
                <div class="absolute top-2 left-2">
                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Aktif</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-sm text-gray-500">@CreativeArt</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Aksesoris Daur Ulang</h3>
                <p class="text-sm text-gray-600 mb-3">Aksesoris unik dan cantik hasil daur ulang</p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-blue-600">Rp 12.000</span>
                    <span class="text-sm text-gray-500">Stok: 60</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8">
        <nav class="flex items-center gap-2">
            <button class="px-3 py-2 text-gray-500 hover:text-gray-700 disabled:opacity-50">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-3 py-2 bg-blue-600 text-white rounded-lg">1</button>
            <button class="px-3 py-2 text-gray-500 hover:text-gray-700">2</button>
            <button class="px-3 py-2 text-gray-500 hover:text-gray-700">3</button>
            <button class="px-3 py-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-chevron-right"></i>
            </button>
        </nav>
    </div>
</div>
@endsection 