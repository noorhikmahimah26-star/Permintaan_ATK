<?php
session_start();
include 'koneksi.php';

$nama     = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']); // enkripsi
$role     = 'user';

// cek username
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Username sudah digunakan!');
        window.location='register.php';
    </script>";
    exit;
}

// simpan user baru
$query = mysqli_query($conn, "
    INSERT INTO users (nama, username, password, role)
    VALUES ('$nama', '$username', '$password', '$role')
");

if ($query) {
    echo "<script>
        alert('Registrasi berhasil, silakan login');
        window.location='login.php';
    </script>";
} else {
    echo "<script>
        alert('Registrasi gagal');
        window.location='register.php';
    </script>";
}