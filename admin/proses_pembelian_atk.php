<?php
include '../koneksi.php';

$tanggal    = $_POST['tanggal'];
$kategori_id = $_POST['kategori']; // ID kategori
$qty        = $_POST['qty'];
$harga      = $_POST['harga'];
$total      = $qty * $harga;


$nota = $_FILES['nota']['name'];
$tmp  = $_FILES['nota']['tmp_name'];

if (!empty($nota)) {
    move_uploaded_file($tmp, "../uploads/".$nota);
}

mysqli_query($conn, "INSERT INTO pembelian_atk (tanggal, kategori_id, vendor, qty, harga, total, nota)
    VALUES ('$tanggal','$kategori_id','$vendor', '$qty','$harga','$total','$nota')");

mysqli_query($conn, "
    UPDATE kategori_atk 
    SET stok = stok + $qty 
    WHERE id = '$kategori_id'
");

header("Location: pembelian_atk.php");