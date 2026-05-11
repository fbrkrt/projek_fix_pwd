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

$queryHadiah = "SELECT * FROM hadiah WHERE id_hadiah = '$id_hadiah'";
$resultHadiah = mysqli_query($conn, $queryHadiah);
$hadiah = mysqli_fetch_assoc($resultHadiah);

if (!$hadiah) {
    die("Hadiah tidak ditemukan");
}

$poin_hadiah = $hadiah['poin'];
$nama_hadiah = $hadiah['nama_hadiah'];

// ambil user
$queryUser = "SELECT * FROM user WHERE email = '$email'";
$resultUser = mysqli_query($conn, $queryUser);
$user = mysqli_fetch_assoc($resultUser);

$poin_user = $user['total'];

// cek poin cukup apa tidak
if ($poin_user < $poin_hadiah) {
    echo "<script>alert('Poin tidak cukup!'); window.location='tukar.php';</script>";
    exit;
}

// potong poin
mysqli_query($conn, "UPDATE user SET total = total - $poin_hadiah WHERE email='$email'");

// redirect ke form sesuai hadiah
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
?>