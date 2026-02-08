<?php
session_start();
include '../koneksi.php';

// Cek session admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// PROSES PERSETUJUAN ATAU PENOLAKAN
if (isset($_GET['id']) && isset($_GET['aksi'])) {
    $id_request = $_GET['id'];
    $aksi = $_GET['aksi'];

    $cek_req = mysqli_query($conn, "SELECT * FROM request_atk WHERE id = '$id_request'");
    $r = mysqli_fetch_assoc($cek_req);
    
    // Pastikan hanya data 'Pending' yang bisa diproses aksi (agar tidak double potong stok)
    if ($r['status'] == 'Pending') {
        $kategori_id = $r['kategori_id'];
        $jumlah_req  = $r['jumlah'];

        if ($aksi == 'setuju') {
            $cek_stok = mysqli_query($conn, "SELECT stok FROM kategori_atk WHERE id = '$kategori_id'");
            $s = mysqli_fetch_assoc($cek_stok);
            
            if ($s['stok'] >= $jumlah_req) {
                mysqli_query($conn, "UPDATE request_atk SET status = 'Disetujui' WHERE id = '$id_request'");
                mysqli_query($conn, "UPDATE kategori_atk SET stok = stok - $jumlah_req WHERE id = '$kategori_id'");
                echo "<script>alert('Permintaan Disetujui!'); window.location='persetujuan_atk.php';</script>";
            } else {
                echo "<script>alert('Gagal! Stok gudang tidak cukup.'); window.location='persetujuan_atk.php';</script>";
            }
        } elseif ($aksi == 'tolak') {
            mysqli_query($conn, "UPDATE request_atk SET status = 'Ditolak' WHERE id = '$id_request'");
            echo "<script>alert('Permintaan Ditolak.'); window.location='persetujuan_atk.php';</script>";
        }
    } else {
        echo "<script>alert('Data ini sudah diproses sebelumnya.'); window.location='persetujuan_atk.php';</script>";
    }
}

// QUERY TAMPIL SEMUA (Tanpa filter Pending agar riwayat terlihat)
$query = "SELECT request_atk.id, users.nama as nama_user, kategori_atk.nama_kategori, 
                 kategori_atk.stok as stok_saat_ini, request_atk.jumlah, 
                 request_atk.tanggal_req, request_atk.keterangan, request_atk.status
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
    <title>Manajemen Persetujuan ATK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="bi bi-list-check text-danger"></i> Semua Riwayat & Persetujuan</h4>
        <a href="dashboard.php" class="btn btn-danger btn-sm">Kembali ke dashboard</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>Tanggal</th>
                        <th>Karyawan</th>
                        <th>Barang</th>
                        <th class="text-center">Diminta</th>
                        <th class="text-center">Status</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($data)) { 
                        // Penentuan Warna Badge dan Baris
                        $bg_color = "";
                        $badge_class = "bg-warning text-dark"; // Default Pending

                        if($row['status'] == 'Disetujui') {
                            $badge_class = "bg-success";
                            $bg_color = "table-success-light"; // Opsional: warna baris tipis
                        } elseif($row['status'] == 'Ditolak') {
                            $badge_class = "bg-danger";
                        }
                    ?>
                    <tr class="align-middle <?= $bg_color ?>">
                        <td><?= date('d/m/y', strtotime($row['tanggal_req'])) ?></td>
                        <td class="fw-bold"><?= $row['nama_user'] ?></td>
                        <td><?= $row['nama_kategori'] ?></td>
                        <td class="text-center fw-bold"><?= $row['jumlah'] ?></td>
                        <td class="text-center">
                            <span class="badge <?= $badge_class ?>"><?= $row['status'] ?></span>
                        </td>
                        <td class="small text-muted"><?= $row['keterangan'] ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 'Pending'): ?>
                                <a href="persetujuan_atk.php?id=<?= $row['id'] ?>&aksi=approve" class="btn btn-outline-success btn-sm">approve</a>
                                <a href="persetujuan_atk.php?id=<?= $row['id'] ?>&aksi=cancel" class="btn btn-outline-danger btn-sm">Cancel</a>
                            <?php else: ?>
                                <button class="btn btn-light btn-sm" disabled><i class="bi bi-lock-fill"></i> Selesai</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>