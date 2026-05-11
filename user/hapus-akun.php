<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];

// Mulai transaksi
mysqli_begin_transaction($conn);

try {
    // Hapus data sampah user
    mysqli_query($conn, "DELETE FROM sampah WHERE email='$email'");
    
    // Hapus user
    $query = "DELETE FROM user WHERE email='$email'";
    
    if (mysqli_query($conn, $query)) {
        mysqli_commit($conn);
        session_destroy();
        echo "<script>alert('Akun berhasil dihapus! Terima kasih telah menggunakan Trashbank.'); window.location='register.php';</script>";
    } else {
        throw new Exception(mysqli_error($conn));
    }
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "<script>alert('Gagal menghapus akun: " . $e->getMessage() . "'); window.location='berhasil.php';</script>";
}
?>