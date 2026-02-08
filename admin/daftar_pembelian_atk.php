<?php
session_start();
include '../koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$query = "SELECT pembelian_atk.*, kategori_atk.nama_kategori 
          FROM pembelian_atk 
          JOIN kategori_atk ON pembelian_atk.kategori_id = kategori_atk.id 
          ORDER BY pembelian_atk.id DESC";

$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pembelian ATK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container-fluid p-4">

    <div class="d-flex justify-content-between mb-3">
        <h5>ATK | Daftar Pembelian ATK</h5>

        <a href="pembelian_atk.php" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Pembelian
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Kategori</th>
                        <th>Vendor</th>
                        <th class="text-center">Qty</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                        <th class="text-center">Nota</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1; 
                while($row = mysqli_fetch_assoc($data)) { 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td class="fw-semibold"><?= $row['nama_kategori'] ?></td>
                    <td><?= $row['vendor'] ?></td>
                    <td class="text-center"><?= $row['qty'] ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td class="fw-bold">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>

                    <td class="text-center">
                        <?php if(!empty($row['nota'])): ?>
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#notaModal<?= $row['id'] ?>">
                                <i class="bi bi-file-earmark-image"></i> Lihat
                            </button>
                        <?php else: ?>
                            <span class="text-muted small">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                </tr>

                <div class="modal fade" id="notaModal<?= $row['id'] ?>" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Nota Pembelian - <?= $row['nama_kategori'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img src="../upload/nota/<?= $row['nota'] ?>" class="img-fluid rounded shadow">
                      </div>
                    </div>
                  </div>
                </div>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>