<?php
session_start();
if ($_SESSION['role'] != 'admin') {
  header("Location: login.php");
}
echo "Halo Admin";
