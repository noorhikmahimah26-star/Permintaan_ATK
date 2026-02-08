<?php
session_start();
include '../koneksi.php';

$total_harga = 0;

if (isset($_POST['simpan'])) {
    $tanggal  = $_POST['tanggal'];
    $kategori = $_POST['kategori']; 
    $vendor = $_POST['vendor'];
    $qty      = $_POST['qty'];
    $harga    = $_POST['harga'];

    // HITUNG TOTAL
    $total_harga = $qty * $harga;

    // UPLOAD NOTA
    $nota = $_FILES['nota']['name'];
    $tmp  = $_FILES['nota']['tmp_name'];

    if (!empty($nota)) {
        move_uploaded_file($tmp, "../uploads/" . $nota);
        // Ubah bagian move_uploaded_file di pembelian_atk.php agar sinkron
move_uploaded_file($tmp, "../upload/nota/" . $nota);
    }

    // SIMPAN PEMBELIAN
    mysqli_query($conn, "INSERT INTO pembelian_atk (tanggal, kategori_id, vendor, qty, harga, total, nota)
    VALUES ('$tanggal', '$kategori', '$vendor', '$qty', '$harga', '$total_harga', '$nota')"
    );

    // ✅ UPDATE STOK KATEGORI
    mysqli_query($conn, "
        UPDATE kategori_atk 
        SET stok = stok + $qty 
        WHERE id = '$kategori'
    ");

    echo "<script>
            alert('Pembelian berhasil & stok bertambah');
            window.location='pembelian_atk.php';
          </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembelian ATK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-4">

    <h4 class="mb-3">ATK | Pembelian ATK</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <!-- TANGGAL -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Pembelian</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <!-- KATEGORI -->
                <div class="mb-3">
                    <label class="form-label">Kategori ATK</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        $kat = mysqli_query($conn, "SELECT id, nama_kategori FROM kategori_atk");
                        while ($k = mysqli_fetch_assoc($kat)) {
                        ?>
                            <option value="<?= $k['id'] ?>">
                                <?= $k['nama_kategori'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                 <!-- VENDOR -->
                 <div class="mb-3">
                    <label class="form-label">Vendor</label>
                    <input type="text" name="vendor" class="form-control" required>
                 </div>

                <!-- NOTA -->
                <div class="mb-3">
                    <label class="form-label">Upload Nota</label>
                    <input type="file" name="nota" class="form-control" accept=".jpg,.jpeg,.png">
                </div>

                <!-- JUMLAH -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Barang</label>
                    <input type="number" name="qty" class="form-control" required>
                </div>

                <!-- HARGA -->
                <div class="mb-3">
                    <label class="form-label">Harga Satuan</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>

                <!-- TOTAL -->
                <div class="mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="text" class="form-control" value="<?= $total_harga ?>" readonly>
                </div>

                <button name="simpan" class="btn btn-danger">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>
</body>
</html>