<?php
session_start();
include '../koneksi.php';

if($_SESSION['role'] != 'admin'){
    header("location:../login.php");
}

$q_jenis = mysqli_query($conn, "SELECT COUNT(*) as total FROM kategori_atk");
$total_jenis = mysqli_fetch_assoc($q_jenis)['total'];

$q_stok = mysqli_query($conn, "SELECT SUM(stok) as total FROM kategori_atk");
$total_stok = mysqli_fetch_assoc($q_stok)['total'] ?? 0;

$q_pending = mysqli_query($conn, "SELECT COUNT(*) as total FROM request_atk WHERE status = 'Pending'");
$total_pending = mysqli_fetch_assoc($q_pending)['total'];

$q_beli = mysqli_query($conn, "SELECT COUNT(*) as total FROM pembelian_atk");
$total_beli = mysqli_fetch_assoc($q_beli)['total'];

$q_setuju = mysqli_query($conn, "SELECT COUNT(*) as total FROM request_atk WHERE status = 'Disetujui'");
$total_setuju = mysqli_fetch_assoc($q_setuju)['total'];

$q_tolak = mysqli_query($conn, "SELECT COUNT(*) as total FROM request_atk WHERE status = 'Ditolak'");
$total_tolak = mysqli_fetch_assoc($q_tolak)['total'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* Info Box Style */
        .info-box {
            border-radius: 10px;
            color: white;
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
            border: none;
            height: 130px;
        }
        .info-box:hover {
            transform: translateY(-5px);
        }
        .info-box .icon {
            position: absolute;
            right: 15px;
            top: 15px;
            font-size: 3rem;
            opacity: 0.3;
        }
        .info-box h2 {
            font-weight: bold;
            font-size: 2.2rem;
            margin-bottom: 0;
        }
        .info-box p {
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 500;
        }
        
        /* Logout Button */
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
        .logout-fixed:hover { background-color: #b02a37; color: #fff; }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold me-5" href="dashboard.php">Gadgetmart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Master</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="kategori_atk.php">Kategori ATK</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">ATK</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="daftar_pembelian_atk.php">Pembelian ATK</a></li>
                        <li><a class="dropdown-item" href="persetujuan_atk.php">Persetujuan ATK</a></li>
                        <li><a class="dropdown-item" href="request_atk.php">Request ATK</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="mb-4">
        <h3>Dashboard</h3>
        <p class="text-muted">Halo Admin, berikut ringkasan data alat tulis kantor saat ini.</p>
    </div>

    <div class="row g-4">
    <div class="col-md-4">
        <div class="card info-box bg-primary">
            <div class="icon"><i class="bi bi-box-seam"></i></div>
            <p>Jenis ATK</p>
            <h2><?= $total_jenis ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card info-box bg-success">
            <div class="icon"><i class="bi bi-stack"></i></div>
            <p>Total Stok (Gudang)</p>
            <h2><?= $total_stok ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card info-box bg-info text-white">
            <div class="icon"><i class="bi bi-cart-plus"></i></div>
            <p>Transaksi Pembelian</p>
            <h2><?= $total_beli ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card info-box bg-warning">
            <div class="icon"><i class="bi bi-hourglass-split text-white"></i></div>
            <p>Request Pending</p>
            <h2><?= $total_pending ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card info-box" style="background-color: #20c997;">
            <div class="icon"><i class="bi bi-check-circle"></i></div>
            <p>Request Disetujui</p>
            <h2><?= $total_setuju ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card info-box" style="background-color: #dc3545;">
            <div class="icon"><i class="bi bi-x-circle"></i></div>
            <p>Request Ditolak</p>
            <h2><?= $total_tolak ?></h2>
        </div>
    </div>
</div>
</div>

<a href="../logout.php" class="logout-fixed">Logout</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>