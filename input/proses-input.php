<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../user/cek-cookie.php";

if(!isset($_SESSION['email'])){
    header("Location: ../user/login.php");
    exit;
}

include '../config/koneksi.php';

// Ambil data dari form
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
$berat = (float)$_POST['berat'];
$tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
$lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);

// Hitung poin (1 kg = 10 poin)
$poin = $berat * 10;

// Validasi email sesuai session
if ($email != $_SESSION['email']) {
    die("Email tidak sesuai dengan akun yang login!");
}

// Mulai transaksi
mysqli_begin_transaction($conn);

try {
    // Simpan ke tabel sampah
    $query = "INSERT INTO sampah (nama, email, alamat, kategori, berat, tanggal, lokasi, poin) 
              VALUES ('$nama', '$email', '$alamat', '$kategori', '$berat', '$tanggal', '$lokasi', '$poin')";
    
    if (!mysqli_query($conn, $query)) {
        throw new Exception(mysqli_error($conn));
    }
    
    // PERBAIKAN: Gunakan IFNULL untuk handle user baru yang totalnya NULL
    mysqli_query($conn, "UPDATE user SET total = IFNULL(total, 0) + $poin WHERE email='$email'");
    
    mysqli_commit($conn);
    header("Location: konfirm.php");
    exit;
    
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}
?>