<?php
session_start();
include '../koneksi.php';

$data = mysqli_query($conn," SELECT id, nama_kategori, satuan, stok, foto FROM kategori_atk ORDER BY id ASC ");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kategori ATK</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
<div class="container-fluid p-4">
    <a href="dashboard.php"
   class="btn btn-danger btn-sm"
   style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
   ">
   Kembali ke Dashboard
</a>

<!-- HEADER -->
<div class="d-flex justify-content-between mb-3">

    <!-- KIRI -->
    <div>
        <h5>Master | Kategori ATK</h5>
    </div>

    <!-- TAMBAH -->
    <a href="kategori_tambah.php" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
    </a>

</div>

<div class="card shadow-sm">
<div class="card-body">

<table class="table table-borderless align-middle">
<thead>
<tr>
    <th>No</th>
    <th>Nama Kategori</th>
    <th>Satuan</th>
    <th>Stok</th>
    <th width="120">Aksi</th>
</tr>
</thead>

<tbody>
<?php $no=1; while($row=mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $no++ ?></td>

    <td>
        <a href="#"
           class="fw-semibold text-primary text-decoration-none"
           data-bs-toggle="modal"
           data-bs-target="#fotoModal<?= $row['id'] ?>">
            <?= $row['nama_kategori'] ?>
        </a>
    </td>

    <td><?= $row['satuan'] ?></td>
    <td><?= $row['stok'] ?></td>

    <td>
        <a href="kategori_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i>
        </a>

        <a href="kategori_hapus.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Yakin ingin menghapus kategori ini?')"
           class="btn btn-sm btn-danger">
            <i class="bi bi-trash"></i>
        </a>
    </td>
</tr>

<!-- MODAL FOTO -->
<div class="modal fade" id="fotoModal<?= $row['id'] ?>" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?= $row['nama_kategori'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <?php
        $foto = $row['foto'];
        $folder = "../upload/kategori/";
        $path = $folder . $foto;

        if (!empty($foto) && file_exists($path)) {
        ?>
            <img src="<?= $path ?>" class="img-fluid rounded shadow" style="max-height:300px;">
        <?php } else { ?>
            <img src="../upload/no-image.png" class="img-fluid rounded" style="max-height:200px;">
            <p class="text-muted mt-2">Foto belum tersedia</p>
        <?php } ?>
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
