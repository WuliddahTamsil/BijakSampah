<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/kontakld', function () {
    return view('kontakld');
})->name('kontakld');

Route::get('/profil', function () {
    return view('aboutbj');
})->name('profil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard-banksampah', function () {
    return view('dashboard-banksampah');
})->name('dashboard-banksampah');

Route::get('/notifikasi', function () {
    return view('notifikasi');
})->name('notifikasi');

Route::get('/notif-banksampah', function () {
    return view('notif-banksampah');
})->name('notif-banksampah');

Route::get('/profile-banksampah', function () {
    return view('profile-banksampah');
})->name('profile-banksampah');

Route::get('/bank-sampah', function () {
    return view('bank-sampah');
})->name('bank-sampah');

Route::get('/bank-sampah/{id}', function ($id) {
    return view('bank-sampah-detail');
})->name('bank-sampah-detail');

Route::get('/toko', function () {
    return view('toko');
})->name('toko');

Route::get('/product-detail/{id}', function ($id) {
    return view('product-detail', compact('id'));
})->name('product-detail');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/komunitas', function () {
    return view('komunitas');
})->name('komunitas');

Route::get('/komunitas/pesan-baru', function () {
    return view('komunitas-pesan-baru');
})->name('komunitas-pesan-baru');

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/berita/{id}', function ($id) {
    return view('berita-detail');
})->name('berita-detail');

Route::get('/keuangan', function () {
    return view('keuangan');
})->name('keuangan');

Route::get('/pesan', function () {
    return view('pesan');
})->name('pesan');

Route::get('/chat', function () {
    return view('chat');
})->name('chat');

Route::get('/umpan-balik', function () {
    return view('umpan-balik');
})->name('umpan-balik');

Route::get('/feedback', function () {
    return view('feedback');
})->name('feedback');

Route::post('/feedback', function (Request $request) {
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'rating' => 'required|integer|between:1,5',
        'message' => 'required|string|max:1000',
    ]);

    // Simpan feedback ke database atau kirim email di sini jika ingin
    // Untuk dummy, cukup tampilkan pesan sukses
    
    // Jika request AJAX, kembalikan JSON
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas umpan balik Anda!'
        ]);
    }
    
    // Jika bukan AJAX, redirect dengan flash message
    return redirect('/feedback')->with('success', 'Terima kasih atas umpan balik Anda!');
});

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/logout', function () {
    // Logika logout bisa ditambahkan di sini
    return redirect('/')->with('success', 'Berhasil logout!');
})->name('logout');

Route::get('/test-theme', function () {
    return view('test-theme');
})->name('test-theme');

Route::get('/demo-theme', function () {
    return view('demo-theme');
})->name('demo-theme');

Route::get('/poin-nasabah', function () {
    return view('poin-nasabah');
})->name('poin-nasabah');

Route::get('/non-nasabah-register', function () {
    return view('non-nasabah-register');
})->name('non-nasabah-register');

Route::get('/non-nasabah-dashboard', function () {
    return view('non-nasabah-dashboard');
})->name('non-nasabah-dashboard');

Route::get('/poin-non-nasabah', function () {
    return view('poin-non-nasabah');
})->name('poin-non-nasabah');

Route::get('/pilihan-login', function () {
    return view('pilihan-login');
})->name('pilihan-login');

Route::get('/dashboard-banksampah', function () {
    return view('dashboard-banksampah');
})->name('dashboard-banksampah');

Route::get('/data-nasabah-banksampah', function () {
    return view('data-nasabah-banksampah');
})->name('data-nasabah-banksampah');

Route::get('/profile-nasabah', function () {
    return view('profile-nasabah');
})->name('profile-nasabah');

Route::get('/penjemputan-sampah-banksampah', function () {
    return view('penjemputan-sampah-banksampah');
})->name('penjemputan-sampah-banksampah');

// Bank Sampah Management Routes
Route::get('/nasabah', function () {
    return view('nasabahdashboard');
})->name('nasabah');

Route::get('/nasabah-komunitas', function () {
    return view('nasabahkomunitas');
})->name('nasabah-komunitas');

Route::get('/nasabah-register', function () {
    return view('nasabahregister');
})->name('nasabah-register');

Route::get('/riwayat-transaksi-nasabah', function () {
    return view('riwayattransaksinasabah');
})->name('riwayat-transaksi-nasabah');

Route::get('/verifikasi-nasabah', function () {
    return view('verifikasi-nasabah');
})->name('verifikasi-nasabah');

Route::get('/data-nasabah', function () {
    return view('data-nasabah-banksampah');
})->name('data-nasabah');

Route::get('/penjemputan-sampah', function () {
    return view('penjemputan-sampah-banksampah');
})->name('penjemputan-sampah');

Route::get('/penimbangan', function () {
    return view('dashboard-banksampah');
})->name('penimbangan');

Route::get('/input-setoran', function () {
    return view('input-setoran');
})->name('input-setoran');

Route::get('/input-setoran1', function () {
    return view('input-setoran1');
})->name('input-setoran1');

Route::get('/data-sampah', function () {
    return view('data-sampah');
})->name('data-sampah');

Route::get('/penjualan-sampah', function () {
    return view('penjualan-sampah');
})->name('penjualan-sampah');

Route::get('/input-penjualan-sampah', function () {
    return view('inputpenjualansampah');
})->name('input-penjualan-sampah');

Route::get('/settings-banksampah', function () {
    return view('settings-banksampah');
})->name('settings-banksampah');

// Admin Panel Routes
Route::get('/admin/orders', function () {
    return view('admin.orders');
})->name('orders');

Route::get('/admin/customers', function () {
    return view('admin.customers');
})->name('customers');

Route::get('/admin/analytics', function () {
    return view('admin.analytics');
})->name('analytics');

// Catalog Route
Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');
