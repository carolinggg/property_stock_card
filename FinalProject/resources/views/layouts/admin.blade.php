<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - Admin</title>

    <!-- Add Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Apply Poppins globally */
        * {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            background-color: #2c3e50;
            color: #fff;
            padding-top: 20px;
            transition: width 0.3s ease;
        }

        .sidebar a {
            color: #bdc3c7;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #34495e;
            color: #ecf0f1;
        }

        .sidebar h2 {
            font-size: 20px;
            color: #ecf0f1;
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
.content-small {
            margin-left: 50px;
            padding: 10px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .navbar {
            background-color: #34495e;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }

        .navbar-brand {
            font-size: 22px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            .sidebar.active {
                width: 220px;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
     <div class="container-fluid justify-content-center">
            <a class="navbar-brand" href="#">
                <img src="assets/psu.png" alt="Stock Management System Logo" class="img-fluid" style="max-width: 150px;">
            </a>
        </div>
    <h2>Stock Management</h2>
    <a href="{{ route('stocks.index') }}" class="{{ request()->is('stocks*') ? 'active' : '' }}">Stocks</a>
    <a href="{{ route('items.index') }}" class="{{ request()->is('items*') ? 'active' : '' }}">Items</a>
    <a href="{{ route('issuances.index') }}" class="{{ request()->is('issuances*') ? 'active' : '' }}">Issuances</a>
    <a href="{{ route('inventory.index') }}" class="{{ request()->is('inventory*') ? 'active' : '' }}">Inventory</a>
    <a href="{{ route('monthly_report.index') }}" class="{{ request()->is('monthly_report*') ? 'active' : '' }}">Monthly Report</a>

    <!-- Logout Link with Confirmation -->
    <a href="#" onclick="event.preventDefault(); confirmLogout();" class="text-light mt-3">Logout</a>

    <!-- Hidden Form for Logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<div class="content">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand" href="#">{{ $pageTitle ?? 'Inventory Management' }}</a>
        </div>
    </nav>

    @yield('content-small')
    @yield('content')
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Confirm logout with a popup
    function confirmLogout() {
        if (confirm('Are you sure you want to log out?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>

</body>
</html>
