<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
    exit;
}

// ambil total poin user dari database
$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT total FROM user WHERE email='$email'");
$data = mysqli_fetch_assoc($query);

$total = $data['total'] ?? 0;
$_SESSION['total'] = $total;

header("Location: ../hadiah/tukar.php");
exit;
?>