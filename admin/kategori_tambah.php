<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama_kategori'];
    $satuan = $_POST['satuan'];

    /* =====================
       UPLOAD FOTO
    ===================== */
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp  = $_FILES['foto']['tmp_name'];
    $ext       = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));

    $allowed = ['jpg','jpeg','png'];

    if (!in_array($ext, $allowed)) {
        echo "<script>alert('Foto harus JPG / JPEG / PNG');</script>";
    } else {

        $nama_foto = time().'_'.$foto_name;
        move_uploaded_file($foto_tmp, "../upload/kategori/".$nama_foto);

        mysqli_query($conn,"
            INSERT INTO kategori_atk (nama_kategori, satuan, stok, foto)
            VALUES ('$nama','$satuan',0,'$nama_foto')
        ");

        header("Location: kategori_atk.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Kategori ATK</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
<h4>Tambah Kategori ATK</h4>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" class="form-control" required>
</div>

<div class="mb-3">
    <label>Satuan</label>
    <input type="text" name="satuan" class="form-control" required>
</div>

<div class="mb-3">
    <label>Foto Barang</label>
    <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png" required>
    <small class="text-muted">Format JPG / JPEG</small>
</div>

<button name="simpan" class="btn btn-danger">Simpan</button>
<a href="kategori_atk.php" class="btn btn-secondary">Kembali</a>

</form>
</div>
</body>
</html>
