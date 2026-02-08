<?php
session_start();
include '../koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$query = "SELECT 
            request_atk.id, 
            users.nama as nama_user, 
            kategori_atk.nama_kategori, 
            request_atk.jumlah, 
            request_atk.tanggal_req, 
            request_atk.status, 
            request_atk.keterangan
          FROM request_atk
          JOIN users ON request_atk.user_id = users.id
          JOIN kategori_atk ON request_atk.kategori_id = kategori_atk.id
          ORDER BY request_atk.tanggal_req DESC";

$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Request ATK | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Request ATK</h4>
        <span class="badge bg-danger">Total Request: <?= mysqli_num_rows($data) ?></span>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Karyawan</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Jumlah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($data) > 0) {
                        while($row = mysqli_fetch_assoc($data)) { 
                    ?>
                    <tr class="align-middle">
                        <td><?= $no++ ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal_req'])) ?></td>
                        <td class="fw-bold text-primary"><?= $row['nama_user'] ?></td>
                        <td><?= $row['nama_kategori'] ?></td>
                        <td class="text-center"><?= $row['jumlah'] ?></td>
                        <td>
                            <?php if($row['status'] == 'Pending'): ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php elseif($row['status'] == 'Disetujui'): ?>
                                <span class="badge bg-success">Disetujui</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Ditolak</span>
                            <?php endif; ?>
                        </td>
                        <td class="small text-muted"><?= $row['keterangan'] ?: '-' ?></td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Belum ada permintaan barang.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="dashboard.php" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>