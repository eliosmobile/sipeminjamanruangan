<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Poliban')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css" />
    @yield('styles')
    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #004080;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            transition: transform 0.3s ease;
            transform: translateX(-100%);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 60px;
            z-index: 999;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 1rem;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar a .icon {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .main-content {
            flex-grow: 1;
            padding: 1rem;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .toggle-button-icon {
            font-size: 1.5rem;
            cursor: pointer;
            color: white;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer .social-icons {
            margin: 10px 0;
        }

        .footer .social-icons a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar .logo {
                margin-bottom: 1rem;
            }

            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 0.5rem;
            }
        }

        /* Ensure proper alignment for the login button in sidebar */
        @media (max-width: 768px) {
            .sidebar .login-button {
                display: block;
                margin-top: auto; /* Move login button to the bottom */
            }
        }

        /* Responsive Content Styling */
        .container {
            max-width: 100%;
        }

        .row {
            margin: 0;
        }

        .col {
            padding: 0.5rem;
        }

        .card {
            margin-bottom: 1rem;
        }

        .card img {
            max-width: 100%;
            height: auto;
        }

        /* Utility classes */
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="d-flex align-items-center">
            <span class="toggle-button-icon" onclick="toggleSidebar()"><i class="fas fa-bars"></i></span>
            <div class="logo ml-5">
                <img src="{{ asset('img/poliban.jpeg') }}" alt="Poliban Logo">
                <span><b>SIPEMINJAM POLIBAN</b></span>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profile
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
                <a class="dropdown-item" href="#">{{ Auth::user()->role }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="sidebar mt-5" id="sidebar">
        <a href="{{ route('superadmin.dashboard') }}">
            <i class="fas fa-home   icon"> </i> Dashboard
        </a>
        <a href="{{ route('superadmin.create_admin_ruangan') }}">
            <i class="fas fa-user-plus"> </i> Create Admin Ruangan
        </a>
        <a href="{{ route('superadmin.create_super_admin') }}">
            <i class="fas fa-user-shield"> </i> Create Super Admin
        </a>
        
        <a href="{{ route('superadmin.list_admin_ruangan') }}">
            <i class="fas fa-users"> </i> View Admin Ruangan
        </a>
        <a href="{{ route('superadmin.list_mahasiswa') }}">
            <i class="fas fa-user-graduate"> </i> View Mahasiswa
        </a>
        <a href="{{ route('superadmin.list_super_admin') }}">
            <i class="fas fa-users-cog"> </i> View Super Admin
        </a>
    </div>
    

    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
    @yield('scripts')
</body>
</html>
