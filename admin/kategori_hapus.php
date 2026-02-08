<?php
session_start();
include '../koneksi.php';

// pastikan ada id
if (!isset($_GET['id'])) {
    header("Location: kategori_atk.php");
    exit;
}

$id = intval($_GET['id']);

// ambil data foto dulu
$q = mysqli_query($conn, "SELECT foto FROM kategori_atk WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

// hapus file foto jika ada
if (!empty($data['foto'])) {
    $file = "../upload/kategori/" . $data['foto'];
    if (file_exists($file)) {
        unlink($file);
    }
}

// hapus data kategori
mysqli_query($conn, "DELETE FROM kategori_atk WHERE id='$id'");

// kembali ke master kategori
header("Location: kategori_atk.php");
exit;
?>