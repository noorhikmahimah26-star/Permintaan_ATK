<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE -->
    <style>

        /* logout pojok kanan bawah */
        .logout-fixed {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background-color: #df1e32;
            color: #fff;
            padding: 10px 18px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            z-index: 999;
        }

        .logout-fixed:hover {
            background-color: #b02a37;
            color: #fff;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid px-4">

        <!-- BRAND -->
        <a class="navbar-brand fw-bold me-5" href="dashboard.php">
            Gadgetmart
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- MASTER -->
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle menu-utama active"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        Master
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="kategori_atk.php">
                                Kategori ATK
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ATK -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle menu-utama active"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        ATK
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="pembelian_atk.php">Pembelian ATK</a></li>
                        <li><a class="dropdown-item" href="persetujuan_atk.php">Persetujuan ATK</a></li>
                        <li><a class="dropdown-item" href="request_atk.php">Request ATK</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">
    <h3>Dashboard</h3>
    <p class="text-muted">Selamat datang Admin</p>
</div>

<!-- LOGOUT -->
<a href="../logout.php" class="logout-fixed">
    Logout
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
