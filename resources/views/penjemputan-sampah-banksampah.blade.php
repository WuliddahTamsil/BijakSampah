<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penjemputan Sampah - Bijak Sampah</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #05445E;
      --secondary-color: #75E6DA;
      --accent-color: #f16728;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }
    
    body {
      background-color: #f8f9fc;
      display: flex;
      min-height: 100vh;
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

    /* [Rest of your CSS remains the same] */
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
        <li class="menu-item">
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
        <li class="menu-item active">
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
          <span class="menu-text">Settings</span>
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

  <!-- [Rest of your HTML and JavaScript remains the same] -->
  
  <script>
    // Sidebar toggle functionality
    const sidebar = document.getElementById('sidebar');
    const toggleCollapse = document.getElementById('toggleCollapse');

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

    // Logout functionality
    document.getElementById('logoutBtn').addEventListener('click', function() {
      // Add your logout logic here
      alert('Anda akan logout');
      // window.location.href = 'login.html';
    });
  </script>
</body>
</html><!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penjemputan Sampah - Bijak Sampah</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #05445E;
      --secondary-color: #75E6DA;
      --accent-color: #f16728;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }
    
    body {
      background-color: #f8f9fc;
      display: flex;
      min-height: 100vh;
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

    /* [Rest of your CSS remains the same] */
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
        <li class="menu-item">
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
        <li class="menu-item active">
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
          <span class="menu-text">Settings</span>
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

  <!-- [Rest of your HTML and JavaScript remains the same] -->
  
  <script>
    // Sidebar toggle functionality
    const sidebar = document.getElementById('sidebar');
    const toggleCollapse = document.getElementById('toggleCollapse');

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

    // Logout functionality
    document.getElementById('logoutBtn').addEventListener('click', function() {
      // Add your logout logic here
      alert('Anda akan logout');
      // window.location.href = 'login.html';
    });
  </script>
</body>
</html>