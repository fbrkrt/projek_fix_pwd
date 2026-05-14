<?php
session_start();
include "../config/koneksi.php";
include "../user/cek-cookie.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
    exit;
}

// Validasi method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: kelola-sampah.php");
    exit;
}

// Ambil data dari form
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
$berat = round((float)$_POST['berat'], 2);
$tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
$lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
$poin_baru = $berat * 10;
$poin_lama = (int)$_POST['poin_lama'];

// Validasi email sesuai session
if ($email != $_SESSION['email']) {
    echo "<script>alert('Email tidak sesuai dengan akun yang login!'); window.location='kelola-sampah.php';</script>";
    exit;
}

// Validasi ID
if ($id <= 0) {
    echo "<script>alert('ID tidak valid!'); window.location='kelola-sampah.php';</script>";
    exit;
}

// Mulai transaksi
mysqli_begin_transaction($conn);

try {
    // Cek apakah data sampah ada dan milik user yang login
    $checkQuery = "SELECT * FROM sampah WHERE id = '$id' AND email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) == 0) {
        throw new Exception("Data tidak ditemukan atau bukan milik Anda!");
    }
    
    // Update data sampah
    $query = "UPDATE sampah SET 
              nama = '$nama', 
              alamat = '$alamat', 
              kategori = '$kategori', 
              berat = '$berat', 
              tanggal = '$tanggal', 
              lokasi = '$lokasi', 
              poin = '$poin_baru' 
              WHERE id = '$id' AND email = '$email'";
    
    if (!mysqli_query($conn, $query)) {
        throw new Exception(mysqli_error($conn));
    }
    
    // Hitung selisih poin
    $selisih = $poin_baru - $poin_lama;
    
    // Update poin user
    $updateUser = "UPDATE user SET total = total + $selisih WHERE email = '$email'";
    if (!mysqli_query($conn, $updateUser)) {
        throw new Exception(mysqli_error($conn));
    }
    
    // Commit transaksi
    mysqli_commit($conn);
    
    echo "<script>
            alert('Data sampah berhasil diupdate!');
            window.location = 'kelola-sampah.php';
          </script>";
    exit;
    
} catch (Exception $e) {
    // Rollback jika ada error
    mysqli_rollback($conn);
    
    echo "<script>
            alert('Gagal mengupdate data: " . addslashes($e->getMessage()) . "');
            window.location = 'edit-sampah.php?id=$id';
          </script>";
    exit;
}
?>