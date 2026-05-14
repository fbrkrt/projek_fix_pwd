<?php
include "../config/koneksi.php";
session_start();
include "../user/cek-cookie.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
    exit;
}

$id_hadiah = $_GET['id'];
$email = $_SESSION['email'];

// Ambil data hadiah
$queryHadiah = "SELECT * FROM hadiah WHERE id_hadiah = '$id_hadiah'";
$resultHadiah = mysqli_query($conn, $queryHadiah);
$hadiah = mysqli_fetch_assoc($resultHadiah);

if (!$hadiah) {
    die("Hadiah tidak ditemukan");
}

$poin_hadiah = $hadiah['poin'];
$nama_hadiah = $hadiah['nama_hadiah'];

// Ambil data user
$queryUser = "SELECT id_user, total FROM user WHERE email = '$email'";
$resultUser = mysqli_query($conn, $queryUser);
$user = mysqli_fetch_assoc($resultUser);

$id_user = $user['id_user'];
$poin_user = $user['total'];

// Cek poin cukup atau tidak
if ($poin_user < $poin_hadiah) {
    echo "<script>alert('Poin tidak cukup!'); window.location='tukar.php';</script>";
    exit;
}

// Mulai transaksi
mysqli_begin_transaction($conn);

try {
    // Insert ke tabel tukar
    $queryInsert = "INSERT INTO tukar (id_user, id_hadiah, datetime) 
                    VALUES ('$id_user', '$id_hadiah', NOW())";
    
    if (!mysqli_query($conn, $queryInsert)) {
        throw new Exception("Gagal menyimpan data penukaran");
    }
    
    // Kurangi poin user
    $poin_baru = $poin_user - $poin_hadiah;
    $queryUpdate = "UPDATE user SET total = '$poin_baru' WHERE id_user = '$id_user'";
    
    if (!mysqli_query($conn, $queryUpdate)) {
        throw new Exception("Gagal mengupdate poin");
    }
    
    mysqli_commit($conn);
    
    // Redirect ke form sesuai hadiah
    if ($nama_hadiah == "Pulsa 5000" || $nama_hadiah == "Pulsa 5.000") {
        header("Location: pulsa5.php?id=$id_hadiah");
    } else if ($nama_hadiah == "OVO 20.000") {
        header("Location: ovo.php?id=$id_hadiah");
    } else if ($nama_hadiah == "Pulsa 10.000") {
        header("Location: pulsa10.php?id=$id_hadiah");
    } else if ($nama_hadiah == "Paket data 10GB") {
        header("Location: paket_data.php?id=$id_hadiah");
    } else if ($nama_hadiah == "E-Wallet 20.000") {
        header("Location: ewallet.php?id=$id_hadiah");
    } else if ($nama_hadiah == "Voucher Gojek") {
        header("Location: gojek.php?id=$id_hadiah");
    } else if ($nama_hadiah == "Saldo GoPay 200.000") {
        header("Location: gopay.php?id=$id_hadiah");
    } else if ($nama_hadiah == "Spotify Premium 3 hari") {
        header("Location: valid-email-spoty.php?id=$id_hadiah");
    } else if ($nama_hadiah == "Voucher Belanja Shopee 5000") {
        header("Location: valid-email-spay.php?id=$id_hadiah");
    } else {
        header("Location: landingpoin.php?id=$id_hadiah");
    }
    exit;
    
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='tukar.php';</script>";
    exit;
}
?>