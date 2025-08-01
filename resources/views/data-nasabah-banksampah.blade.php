<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - Bijak Sampah</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://www.gstatic.com/firebasejs/9.6.0/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.0/firebase-auth-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.0/firebase-database-compat.js"></script>
  <style>
    :root {
      --primary-color: #05445E;
      --secondary-color: #75E6DA;
      --accent-color: #f16728;
      --success-color: #2b8a3e;
      --danger-color: #c0392b;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }
    
    body {
      background: #f8f9fc;
      color: #333;
      min-height: 100vh;
      display: flex;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 250px;
      background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 30%, var(--primary-color) 100%);
      color: white;
      padding: 20px 0;
      min-height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      transition: width 0.3s;
      overflow: hidden;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      z-index: 100;
    }

    .sidebar.collapsed {
      width: 80px;
    }

    .logo-container {
      padding: 0 20px;
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      height: 60px;
      justify-content: space-between;
      flex-shrink: 0;
    }

    .logo {
      font-size: 22px;
      font-weight: bold;
      color: white;
      white-space: nowrap;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo span {
      color: #4ADE80;
    }

    .toggle-collapse {
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
      padding: 5px;
      min-width: 24px;
    }

    .menu-container {
      flex-grow: 1;
      overflow-y: auto;
      padding-bottom: 20px;
    }

    .menu-items {
      list-style: none;
    }

    .menu-item {
      padding: 12px 20px;
      display: flex;
      align-items: center;
      cursor: pointer;
      transition: all 0.3s;
      white-space: nowrap;
      position: relative;
    }

    .menu-item:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    .menu-item.active {
      background: rgba(255, 255, 255, 0.2);
      border-left: 4px solid var(--accent-color);
    }

    .sub-menu-item {
      padding: 10px 20px 10px 50px;
      display: flex;
      align-items: center;
      cursor: pointer;
      transition: all 0.3s;
      white-space: nowrap;
      font-size: 14px;
      position: relative;
    }

    .sub-menu-item:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    .sub-menu-item.active {
      background: rgba(255, 255, 255, 0.15);
    }

    .menu-icon {
      width: 24px;
      height: 24px;
      margin-right: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .menu-text {
      font-size: 15px;
      transition: opacity 0.3s;
    }

    .sidebar.collapsed .menu-text,
    .sidebar.collapsed .sub-menu-item {
      opacity: 0;
      width: 0;
      height: 0;
      padding: 0;
      margin: 0;
      overflow: hidden;
    }

    .sidebar.collapsed .logo-text {
      display: none;
    }

    .sidebar.collapsed .logo-icon {
      font-size: 22px;
    }

    .sidebar-footer {
      padding: 0;
      border-top: 1px solid rgba(255,255,255,0.1);
      margin-top: auto;
      flex-shrink: 0;
    }

    /* Main Content Styles */
    .main-content {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 30px;
      transition: margin-left 0.3s, width 0.3s;
    }

    .sidebar.collapsed ~ .main-content {
      margin-left: 80px;
      width: calc(100% - 80px);
    }

    /* Header Styles */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .header h1 {
      color: var(--primary-color);
      font-size: 28px;
    }

    /* Stats Cards */
    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .stat-card h2 {
      font-size: 28px;
      margin: 10px 0;
    }

    .stat-card p {
      color: #666;
    }

    /* Customers Table */
    .customers-container {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .search-sort {
      display: flex;
      gap: 15px;
    }

    .search {
      position: relative;
    }

    .search input {
      padding: 10px 15px 10px 35px;
      border: 1px solid #ddd;
      border-radius: 8px;
      width: 250px;
    }

    .search i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
    }

    .sort select {
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      font-weight: 600;
      color: var(--primary-color);
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .status {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      display: inline-block;
    }

    /* Link styling untuk nama nasabah */
    .customer-name-link {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .customer-name-link:hover {
      color: var(--accent-color);
      text-decoration: underline;
    }
    }

    .status.active {
      background-color: #e6f7e6;
      color: var(--success-color);
    }

    .status.inactive {
      background-color: #fdeaea;
      color: var(--danger-color);
    }

    /* Profile Dropdown */
    .profile-dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: #fff;
      min-width: 160px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      z-index: 1;
      border-radius: 8px;
      overflow: hidden;
    }

    .dropdown-content a {
      color: #333;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      transition: background-color 0.3s;
    }

    .dropdown-content a:hover {
      background-color: #f5f5f5;
    }

    .dropdown-content.show {
      display: block;
    }

    .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--primary-color);
      cursor: pointer;
      transition: all 0.3s;
    }

    .avatar:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(5, 68, 94, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .sidebar {
        width: 80px;
      }
      
      .sidebar .menu-text,
      .sidebar .sub-menu-item {
        display: none;
      }
      
      .sidebar .logo-text {
        display: none;
      }
      
      .sidebar .logo-icon {
        font-size: 22px;
      }
      
      .main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
      }
      
      .search input {
        width: 200px;
      }
    }

    @media (max-width: 768px) {
      .stats {
        grid-template-columns: 1fr;
      }
      
      .search-sort {
        flex-direction: column;
        gap: 10px;
      }
      
      .search input {
        width: 100%;
      }
      
      table {
        display: block;
        overflow-x: auto;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="logo-container">
      <div class="logo">
        <span class="logo-icon"><i class="fas fa-recycle"></i></span>
        <span class="logo-text">Bijak<span>Sampah</span></span>
      </div>
      <button class="toggle-collapse" id="toggleCollapse">
        <i class="fas fa-chevron-left"></i>
      </button>
    </div>
    
    <div class="menu-container">
      <ul class="menu-items">
        <li class="menu-item active">
          <div class="menu-icon"><i class="fas fa-home"></i></div>
          <span class="menu-text">Dashboard</span>
        </li>
        <li class="menu-item">
          <div class="menu-icon"><i class="fas fa-users"></i></div>
          <span class="menu-text">Nasabah</span>
        </li>
        <li class="sub-menu-item">
          <div class="menu-icon"><i class="fas fa-user-check"></i></div>
          <span class="menu-text">Verifikasi Nasabah</span>
        </li>
        <li class="sub-menu-item">
          <div class="menu-icon"><i class="fas fa-database"></i></div>
          <span class="menu-text">Data Nasabah</span>
        </li>
        <li class="menu-item">
          <div class="menu-icon"><i class="fas fa-truck"></i></div>
          <span class="menu-text">Penjemputan Sampah</span>
        </li>
        <li class="menu-item">
          <div class="menu-icon"><i class="fas fa-weight-hanging"></i></div>
          <span class="menu-text">Penimbangan</span>
        </li>
        <li class="sub-menu-item">
          <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
          <span class="menu-text">Input Setoran</span>
        </li>
        <li class="menu-item">
          <div class="menu-icon"><i class="fas fa-trash-alt"></i></div>
          <span class="menu-text">Data Sampah</span>
        </li>
        <li class="menu-item">
          <div class="menu-icon"><i class="fas fa-shopping-cart"></i></div>
          <span class="menu-text">Penjualan Sampah</span>
        </li>
        <li class="menu-item">
          <div class="menu-icon"><i class="fas fa-cog"></i></div>
          <span class="menu-text">Setting</span>
        </li>
      </ul>
    </div>

    <div class="sidebar-footer">
      <div class="menu-item" id="logoutBtn">
        <div class="menu-icon"><i class="fas fa-sign-out-alt"></i></div>
        <span class="menu-text">Logout</span>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="header">
      <h1>Nasabah</h1>
      <div class="profile-dropdown">
        <img id="userAvatar" class="avatar" src="https://ui-avatars.com/api/?name=Admin&background=75E6DA&color=05445E" alt="User" onclick="toggleDropdown()">
        <div id="dropdownMenu" class="dropdown-content">
          <a href="#" id="profileLink"><i class="fas fa-user-circle"></i> Profil Saya</a>
          <a href="#" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>

    <div class="stats">
      <div class="stat-card">
        <p>Total Nasabah</p>
        <h2 id="totalCustomers">0</h2>
        <p style="color: var(--success-color)">⬆ 4% bulan ini</p>
      </div>
      <div class="stat-card">
        <p>Nasabah Aktif</p>
        <h2 id="activeCustomers">0</h2>
        <p style="color: var(--danger-color)">⬇ 1% bulan ini</p>
      </div>
      <div class="stat-card">
        <p>Nasabah Non-Aktif</p>
        <h2 id="inactiveCustomers">0</h2>
      </div>
    </div>

    <div class="customers-container">
      <div class="table-header">
        <h2>Semua Nasabah</h2>
        <div class="search-sort">
          <div class="search">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nasabah..." onkeyup="searchCustomers()">
          </div>
          <div class="sort">
            <select id="sortSelect" onchange="sortCustomers()">
              <option value="newest">Terbaru</option>
              <option value="oldest">Terlama</option>
              <option value="active">Aktif</option>
              <option value="inactive">Non-Aktif</option>
            </select>
          </div>
        </div>
      </div>
      
      <table id="customersTable">
        <thead>
          <tr>
            <th>Nama Nasabah</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="customersTableBody">
          <!-- Data akan dimuat dari Firebase -->
        </tbody>
      </table>
    </div>
  </div>

  <script>
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
    const app = firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();
    const database = firebase.database();

    // DOM Elements
    const sidebar = document.getElementById('sidebar');
    const toggleCollapse = document.getElementById('toggleCollapse');
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutLink = document.getElementById('logoutLink');
    const profileLink = document.getElementById('profileLink');
    const userAvatar = document.getElementById('userAvatar');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const customersTableBody = document.getElementById('customersTableBody');
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const totalCustomers = document.getElementById('totalCustomers');
    const activeCustomers = document.getElementById('activeCustomers');
    const inactiveCustomers = document.getElementById('inactiveCustomers');

    // Initialize the page
    document.addEventListener('DOMContentLoaded', () => {
      initSidebar();
      initAuth();
      initDropdown();
    });

    // Sidebar functionality
    function initSidebar() {
      toggleCollapse.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        const icon = toggleCollapse.querySelector('i');
        if (sidebar.classList.contains('collapsed')) {
          icon.classList.remove('fa-chevron-left');
          icon.classList.add('fa-chevron-right');
        } else {
          icon.classList.remove('fa-chevron-right');
          icon.classList.add('fa-chevron-left');
        }
      });
    }

    // Authentication
    function initAuth() {
      auth.onAuthStateChanged((user) => {
        if (user) {
          updateUserProfile(user);
          loadCustomersData();
        }
      });
    }

    // Update user profile in UI
    function updateUserProfile(user) {
      if (user.photoURL) {
        userAvatar.src = user.photoURL;
      } else {
        const name = user.displayName || 'Admin';
        userAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=75E6DA&color=05445E`;
      }
    }

    // Dropdown functionality
    function initDropdown() {
      userAvatar.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('show');
      });

      document.addEventListener('click', () => {
        dropdownMenu.classList.remove('show');
      });

      profileLink.addEventListener('click', (e) => {
        e.preventDefault();
        dropdownMenu.classList.remove('show');
        window.location.href = 'profile.html';
      });

      logoutBtn.addEventListener('click', logout);
      logoutLink.addEventListener('click', (e) => {
        e.preventDefault();
        logout();
      });
    }

    // Load customers data from Firebase
    function loadCustomersData() {
      // Mengambil data dari path 'users' dan filter hanya yang role 'Nasabah'
      database.ref('users').orderByChild('role').equalTo('Nasabah').on('value', (snapshot) => {
        const customersData = snapshot.val();
        const customersArray = [];
        let activeCount = 0;
        let inactiveCount = 0;

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
            row.innerHTML = `
              <td><a href="/profile-nasabah?id=${customer.id}" class="customer-name-link">${customer.firstName || ''} ${customer.lastName || ''}</a></td>
              <td>${customer.address || 'N/A'}</td>
              <td>${customer.city || 'N/A'}</td>
              <td>${customer.email || 'N/A'}</td>
              <td>${customer.phone || 'N/A'}</td>
              <td><span class="status active">Active</span></td>
            `;
            customersTableBody.appendChild(row);
          });

          totalCustomers.textContent = customersArray.length;
          activeCustomers.textContent = activeCount;
          inactiveCustomers.textContent = inactiveCount;
        } else {
          customersTableBody.innerHTML = `
            <tr>
              <td colspan="6" style="text-align: center; padding: 30px;">
                Tidak ada data nasabah yang tersedia
              </td>
            </tr>
          `;
        }
      }, (error) => {
        console.error("Error membaca data:", error);
      });
    }

    // Search customers
    function searchCustomers() {
      const searchTerm = searchInput.value.toLowerCase();
      const rows = customersTableBody.getElementsByTagName('tr');

      for (let row of rows) {
        const name = row.cells[0].textContent.toLowerCase();
        const email = row.cells[3].textContent.toLowerCase();
        const phone = row.cells[4].textContent.toLowerCase();
        
        if (name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    }

    // Sort customers
    function sortCustomers() {
      // Implementasi sorting sesuai kebutuhan
      console.log('Sort by:', sortSelect.value);
    }

    // Logout function
    function logout() {
      auth.signOut().then(() => {
        window.location.href = 'login.html';
      }).catch((error) => {
        console.error('Logout error:', error);
        alert('Gagal logout. Silakan coba lagi.');
      });
    }

    // Toggle dropdown
    function toggleDropdown() {
      dropdownMenu.classList.toggle('show');
    }
  </script>
</body>
</html>