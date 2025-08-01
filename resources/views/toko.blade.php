@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

@section('content')
<div x-data="productApp()">
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
                <h2 class="text-lg font-semibold text-gray-900">Daftar Produk</h2>
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
                            <button @click="editProduct(1)" class="btn-warning mr-2">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button @click="deleteProduct(1)" class="btn-danger">
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
                            <button @click="editProduct(2)" class="btn-warning mr-2">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button @click="deleteProduct(2)" class="btn-danger">
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
                            <button @click="editProduct(3)" class="btn-warning mr-2">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button @click="deleteProduct(3)" class="btn-danger">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal-overlay" :class="{ 'active': showAddProduct }" @click.away="showAddProduct = false">
        <div class="modal-content">
            <button @click="showAddProduct = false" class="modal-close">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-900">Tambah Produk Baru</h3>
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

    <!-- Edit Product Modal -->
    <div class="modal-overlay" :class="{ 'active': showEditProduct }" @click.away="showEditProduct = false">
        <div class="modal-content">
            <button @click="showEditProduct = false" class="modal-close">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-900">Edit Produk</h3>
            </div>
            
            <form @submit.prevent="updateProduct()">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                        <input type="text" x-model="editingProduct.name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select x-model="editingProduct.category" required
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
                            <input type="number" x-model="editingProduct.price" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                            <input type="number" x-model="editingProduct.stock" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea x-model="editingProduct.description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                        <input type="url" x-model="editingProduct.image" placeholder="https://example.com/image.jpg"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="submit" class="btn-primary flex-1">
                        <i class="fas fa-save mr-2"></i>Update Produk
                    </button>
                    <button type="button" @click="showEditProduct = false" class="btn-danger flex-1">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function productApp() {
        return {
            // Modal States
            showAddProduct: false,
            showEditProduct: false,
            
            // Form Data
            newProduct: {
                name: '',
                category: '',
                price: '',
                stock: '',
                description: '',
                image: ''
            },
            
            editingProduct: {
                id: null,
                name: '',
                category: '',
                price: '',
                stock: '',
                description: '',
                image: ''
            },
            
            // Methods
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
            
            editProduct(productId) {
                // Simulate loading product data
                this.editingProduct = {
                    id: productId,
                    name: 'Produk ' + productId,
                    category: 'Aksesoris',
                    price: '20000',
                    stock: '45',
                    description: 'Deskripsi produk...',
                    image: 'https://example.com/image.jpg'
                };
                this.showEditProduct = true;
            },
            
            updateProduct() {
                if (!this.editingProduct.name || !this.editingProduct.price || !this.editingProduct.stock) {
                    alert('Mohon lengkapi semua field yang diperlukan!');
                    return;
                }
                
                // Simulate updating product
                console.log('Updating product:', this.editingProduct);
                alert('Produk berhasil diperbarui!');
                this.showEditProduct = false;
                this.resetEditingForm();
            },
            
            deleteProduct(productId) {
                if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                    // Simulate deleting product
                    console.log('Deleting product:', productId);
                    alert('Produk berhasil dihapus!');
                }
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
            },
            
            resetEditingForm() {
                this.editingProduct = {
                    id: null,
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
@endpush
@endsection 