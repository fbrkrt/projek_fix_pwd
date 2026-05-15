<?php
include "../config/koneksi.php";
session_start();
include "../user/cek-cookie.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
    exit;
}

// VALIDASI ID
if (!isset($_GET['id'])) {
    header("Location: tukar.php");
    exit;
}

$id_hadiah = $_GET['id'];
$email = $_SESSION['email'];

// ambil hadiah
$qHadiah = mysqli_query($conn, "SELECT * FROM hadiah WHERE id_hadiah='$id_hadiah'");
$hadiah = mysqli_fetch_assoc($qHadiah);

if (!$hadiah) {
    die("Hadiah tidak ditemukan");
}

$nama_hadiah = $hadiah['nama_hadiah'];
$poin_hadiah = $hadiah['poin'];

// ambil user TERBARU
$qUser = mysqli_query($conn, "SELECT total FROM user WHERE email='$email'");
$user = mysqli_fetch_assoc($qUser);

$poin_user = $user['total']; // sisa poin terbaru
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Redeem Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/hadiah.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav class="nav-full">
        <div class="logo-web">
            <ul>
                <li><img src="../assets/logo.png" alt="logo bank sampah" style="width: 50px;"></li>
                <li><a href="../index/index.php">Trashbank</a></li>
            </ul>
        </div>

        <div class="nav-container">
            <ul>
                <li><a href="../index/index.php" class="garis-bawah">Home</a></li>
                <li><a href="../user/register.php" class="garis-bawah">Registrasi</a></li>
                <li><a href="../hadiah/tukar.php" class="garis-bawah">Rewards</a></li>
                <li><a href="../index/index.php#categories" class="garis-bawah">Categories</a></li>
                <li><a href="../index/contact.php" class="garis-bawah">Contact</a></li>
                <li><a href="../input/kelola-sampah.php" class="garis-bawah">History</a></li>
                <li><a href="../user/edit-profil.php" class="garis-bawah">Profil</a></li>
            </ul>
        </div>

        <div class="get-started">
            <a href="../input/input.php">Get Started</a>
        </div>
    </nav>

    <div class="landing">
        <h2>Selamat!</h2>
        <p>Kamu berhasil menukarkan <b><?php echo $nama_hadiah; ?></b></p>
        <p>Poin berhasil dipotong: <b><?php echo $poin_hadiah; ?></b></p>
        <p>Sisa poin kamu: <b><?php echo $poin_user; ?></b></p>

        <a href="tukar.php" class="btn btn-secondary">Mau Tukar Lagi</a>
        <a href="../index/index.php" class="btn btn-secondary">Kembali ke Home</a>
    </div>
</body>
</html>