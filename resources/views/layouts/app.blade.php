<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon"
    href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 512 512%22><path fill=%22%23435ebe%22 d=%22M464 32H48C21.5 32 0 53.5 0 80v320c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-83.6 290.5c4.8 4.8 4.8 12.6 0 17.4l-40.5 40.5c-4.8 4.8-12.6 4.8-17.4 0L209 267.1l-53.5 53.5c-4.8 4.8-12.6 4.8-17.4 0l-40.5-40.5c-4.8-4.8-4.8-12.6 0-17.4l111.4-111.4c4.8-4.8 12.6-4.8 17.4 0l153.4 153.4z%22/></svg>">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistem Agenda Akademik - @yield('title')</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #435ebe;
      --bg-body: #f3f4f6;
      --sidebar-width: 260px;
      --header-height: 70px;
      --footer-height: 50px;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg-body);
      overflow: hidden;
      height: 100vh;
    }

    .wrapper {
      display: flex;
      width: 100%;
      height: 100vh;
    }

    #sidebar {
      min-width: var(--sidebar-width);
      max-width: var(--sidebar-width);
      background: #fff;
      color: #25396f;
      transition: all 0.3s;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
      z-index: 999;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .sidebar-content {
      flex-grow: 1;
      overflow-y: auto;
      scrollbar-width: thin;
    }

    #sidebar.active {
      margin-left: calc(var(--sidebar-width) * -1);
    }

    #right-panel {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      height: 100vh;
      width: calc(100% - var(--sidebar-width));
      transition: all 0.3s;
    }

    header {
      flex-shrink: 0;
      height: auto;
      background: #fff;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
      z-index: 900;
    }

    #main-content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 1.5rem;
      position: relative;
    }

    #main-content::-webkit-scrollbar {
      width: 8px;
    }

    #main-content::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    #main-content::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 4px;
    }

    #main-content::-webkit-scrollbar-thumb:hover {
      background: #aaa;
    }

    footer {
      flex-shrink: 0;
      background: #fff;
      border-top: 1px solid #e0e0e0;
    }

    @media (max-width: 768px) {
      #sidebar {
        position: fixed;
        left: -260px;
        margin-left: 0;
      }

      #sidebar.active {
        left: 0;
      }

      #right-panel {
        width: 100%;
      }

      #sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 998;
      }

      #sidebar-overlay.active {
        display: block;
      }
    }

    #sidebar .sidebar-header {
      padding: 1.5rem;
      border-bottom: 1px solid #eee;
    }

    #sidebar ul li a {
      padding: 12px 20px;
      display: block;
      text-decoration: none;
      color: #555;
      font-weight: 500;
      transition: 0.3s;
      border-radius: 5px;
      margin: 0 10px;
    }

    #sidebar ul li a:hover {
      background: #f0f2f5;
      color: var(--primary-color);
    }

    #sidebar ul li.active>a {
      background: var(--primary-color);
      color: #fff;
      box-shadow: 0 5px 10px rgba(67, 94, 190, 0.3);
    }

    .dropdown-menu.animate-slide {
      animation: slideIn 0.2s ease forwards;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>

  <div class="wrapper">
    @include('layouts.sidebar')

    <div id="right-panel">

      <div id="sidebar-overlay"></div>

      <header>
        @include('layouts.navbar')
      </header>

      <main id="main-content">
        <div class="container-fluid px-0">
          @yield('content')
        </div>
      </main>

      <footer>
        @include('layouts.footer')
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebar-overlay');
      const sidebarCollapseBtn = document.getElementById('sidebarCollapse');

      if (sidebarCollapseBtn) {
        sidebarCollapseBtn.addEventListener('click', function () {
          sidebar.classList.toggle('active');
          overlay.classList.toggle('active');
        });
      }

      overlay.addEventListener('click', function () {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
      });
    });
  </script>
</body>

</html>