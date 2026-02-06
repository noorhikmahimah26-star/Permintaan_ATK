<?php
$conn = mysqli_connect("localhost", "root", "", "permintaan_alat tulis kantor");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>