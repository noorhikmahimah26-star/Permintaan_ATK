<?php
session_start();
include '../koneksi.php';

if ($_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$q_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM request_atk WHERE user_id = '$id_user'");
$total_req = mysqli_fetch_assoc($q_total)['total'];

$q_setuju = mysqli_query($conn, "SELECT COUNT(*) as total FROM request_atk WHERE user_id = '$id_user' AND status = 'Disetujui'");
$total_setuju = mysqli_fetch_assoc($q_setuju)['total'];

$q_pending = mysqli_query($conn, "SELECT COUNT(*) as total FROM request_atk WHERE user_id = '$id_user' AND status = 'Pending'");
$total_pending = mysqli_fetch_assoc($q_pending)['total'];

$q_tolak = mysqli_query($conn, "SELECT COUNT(*) as total FROM request_atk WHERE user_id = '$id_user' AND status = 'Ditolak'");
$total_tolak = mysqli_fetch_assoc($q_tolak)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
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
    </div>
</nav>

<div class="container mt-4">
    <div class="mb-4">
        <h4>Selamat Datang, <?= $_SESSION['username']; ?>!</h4>
        <p class="text-muted">Berikut adalah ringkasan permintaan alat tulis kantor Anda.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card info-box bg-primary">
                <div class="icon"><i class="bi bi-file-earmark-text"></i></div>
                <p>Total Pengajuan</p>
                <h2><?= $total_req; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card info-box" style="background-color: #20c997;">
                <div class="icon"><i class="bi bi-check-circle"></i></div>
                <p>Disetujui</p>
                <h2><?= $total_setuju; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card info-box bg-warning">
                <div class="icon"><i class="bi bi-clock-history text-white"></i></div>
                <p>Menunggu (Pending)</p>
                <h2><?= $total_pending; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card info-box" style="background-color: #dc3545;">
                <div class="icon"><i class="bi bi-x-circle"></i></div>
                <p>Ditolak</p>
                <h2><?= $total_tolak; ?></h2>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <p class="text-muted">Butuh alat tulis kantor baru?</p>
        <a href="permintaan_atk.php" class="btn btn-danger px-5 py-2 fw-bold">
            <i class="bi bi-plus-lg"></i> Buat Permintaan Sekarang
        </a>
    </div>
</div>

<a href="../logout.php" class="logout-fixed">Logout</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
