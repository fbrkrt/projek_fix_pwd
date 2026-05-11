<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
    exit;
}

$id = $_GET['id'];

// Ambil data sampah dulu untuk dapat poin dan email
$query = mysqli_query($conn, "SELECT * FROM sampah WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $email = $data['email'];
    $poin = $data['poin'];
    
    // Mulai transaksi
    mysqli_begin_transaction($conn);
    
    try {
        // Hapus data sampah
        mysqli_query($conn, "DELETE FROM sampah WHERE id='$id'");
        
        // Kurangi poin user
        mysqli_query($conn, "UPDATE user SET total = total - $poin WHERE email='$email'");
        
        mysqli_commit($conn);
        echo "<script>alert('Data sampah berhasil dihapus!'); window.location='kelola-sampah.php';</script>";
        
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Gagal menghapus data: " . $e->getMessage() . "'); window.location='kelola_sampah.php';</script>";
    }
} else {
    echo "<script>alert('Data tidak ditemukan!'); window.location='kelola_sampah.php';</script>";
}
?>