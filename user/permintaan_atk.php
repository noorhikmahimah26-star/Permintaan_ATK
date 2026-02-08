<?php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login
if ($_SESSION['role'] != 'user') {
    header("location:../login.php");
    exit;
}

if (isset($_POST['kirim'])) {
    $user_id     = $_SESSION['id_user'];
    $kategori_id = $_POST['kategori_id'];
    $jumlah      = $_POST['jumlah'];
    $keterangan  = $_POST['keterangan'];

    // Simpan ke tabel request_atk dengan status default 'Pending'
    $query = mysqli_query($conn, "INSERT INTO request_atk (user_id, kategori_id, jumlah, status, keterangan) 
                                  VALUES ('$user_id', '$kategori_id', '$jumlah', 'Pending', '$keterangan')");

    if ($query) {
        echo "<script>alert('Permintaan berhasil dikirim!'); window.location='dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ajukan Permintaan ATK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h4 class="mb-4">Form Permintaan ATK</h4>
            <form method="POST">
                <div class="mb-3">
                    <label>Pilih Barang</label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <?php
                        $barang = mysqli_query($conn, "SELECT * FROM kategori_atk WHERE stok > 0");
                        while($b = mysqli_fetch_assoc($barang)) {
                            echo "<option value='$b[id]'>$b[nama_kategori] (Stok: $b[stok])</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label>Keterangan/Keperluan</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>
                <button name="kirim" class="btn btn-danger w-100">Kirim Permintaan</button>
                <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>