<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM kategori_atk WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama   = $_POST['nama_kategori'];
    $satuan = $_POST['satuan'];
    $stok   = $_POST['stok'];

    mysqli_query($conn,"
        UPDATE kategori_atk SET
        nama_kategori='$nama',
        satuan='$satuan',
        stok='$stok'
        WHERE id='$id'
    ");

    header("Location: kategori_atk.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Kategori ATK</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
<h4>Edit Kategori ATK</h4>

<form method="POST">
<div class="mb-3">
    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" class="form-control"
           value="<?= $row['nama_kategori'] ?>" required>
</div>

<div class="mb-3">
    <label>Satuan</label>
    <input type="text" name="satuan" class="form-control"
           value="<?= $row['satuan'] ?>" required>
</div>

<div class="mb-3">
    <label>Stok</label>
    <input type="number" name="stok" class="form-control"
           value="<?= $row['stok'] ?>" required>
</div>

<button name="update" class="btn btn-danger">Update</button>
<a href="kategori_atk.php" class="btn btn-secondary">Kembali</a>
</form>
</div>
</body>
</html>
