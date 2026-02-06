<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <a class="navbar-brand fw-bold me-5" href="dashboard_user.php">
            Gadgetmart
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- permintaan ATK -->
        <div class="collapse navbar-collapse" id="navbarUser">
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle menu-utama active"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        Permintaan ATK
                    </a>
                     <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="kategori_atk.php">
                                Ajukan Permintaan
                            </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">
    <h4>Dashboard User</h4>
    <p>Selamat datang</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<a href="../logout.php" class="logout-fixed">
    Logout
</a>
</body>
</html>
