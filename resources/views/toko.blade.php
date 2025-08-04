@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Toko</h1>
                <p class="text-gray-600 mt-2">Kelola toko dan produk Anda</p>
            </div>
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-box text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Produk</p>
                            <p class="text-2xl font-bold text-gray-900">247</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-shopping-cart text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pesanan Hari Ini</p>
                            <p class="text-2xl font-bold text-gray-900">89</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="fas fa-dollar-sign text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pendapatan</p>
                            <p class="text-2xl font-bold text-gray-900">Rp45.2M</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <i class="fas fa-users text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pelanggan Aktif</p>
                            <p class="text-2xl font-bold text-gray-900">1,234</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="bg-white rounded-lg shadow p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Selamat Datang di Toko</h2>
                <p class="text-gray-600 mb-8">Halaman ini telah dioptimalkan untuk performa yang lebih baik.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-blue-50 rounded-lg">
                        <i class="fas fa-box text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Kelola Produk</h3>
                        <p class="text-gray-600">Tambah, edit, dan hapus produk</p>
                    </div>
                    
                    <div class="text-center p-6 bg-green-50 rounded-lg">
                        <i class="fas fa-shopping-cart text-4xl text-green-600 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Kelola Pesanan</h3>
                        <p class="text-gray-600">Lihat dan proses pesanan</p>
                    </div>
                    
                    <div class="text-center p-6 bg-purple-50 rounded-lg">
                        <i class="fas fa-users text-4xl text-purple-600 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Kelola Pelanggan</h3>
                        <p class="text-gray-600">Lihat data pelanggan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Toko page loaded successfully');
});
</script>
@endsection 