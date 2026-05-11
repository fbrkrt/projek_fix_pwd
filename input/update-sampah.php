<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
    exit;
}

$id = $_POST['id'];
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = $_POST['email'];
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$kategori = $_POST['kategori'];
$berat = $_POST['berat'];
$tanggal = $_POST['tanggal'];
$lokasi = $_POST['lokasi'];
$poin_baru = $berat * 10;
$poin_lama = $_POST['poin_lama'];

// Mulai transaksi
mysqli_begin_transaction($conn);

try {
    // Update data sampah
    $query = "UPDATE sampah SET 
              nama='$nama', 
              alamat='$alamat', 
              kategori='$kategori', 
              berat='$berat', 
              tanggal='$tanggal', 
              lokasi='$lokasi', 
              poin='$poin_baru' 
              WHERE id='$id'";
    
    mysqli_query($conn, $query);
    
    // Update poin user (sesuaikan selisihnya)
    $selisih = $poin_baru - $poin_lama;
    mysqli_query($conn, "UPDATE user SET total = total + $selisih WHERE email='$email'");
    
    mysqli_commit($conn);
    echo "<script>alert('Data sampah berhasil diupdate!'); window.location='kelola_sampah.php';</script>";
    
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "<script>alert('Gagal mengupdate data: " . $e->getMessage() . "'); window.location='edit_sampah.php?id=$id';</script>";
}
?>