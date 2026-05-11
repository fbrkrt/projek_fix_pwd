<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "cek-cookie.php";

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berhasil Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
    <link rel="stylesheet" href="../css/register-login.css">
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
            <li><a href="#categories" class="garis-bawah">Categories</a></li>
            <li><a href="./contact.php" class="garis-bawah">Contact</a></li>
            <li><a href="../input/kelola-sampah.php" class="garis-bawah">History</a></li>
            <li><a href="../user/edit-profil.php" class="garis-bawah">Profil</a></li>
        </ul>
    </div>

    <div class="get-started">
        <a href="logout.php">Logout</a>
    </div>
</nav>

    <div class="card text-center" style="margin-top: 100px;">
        <div class="bg-succes" style="background:#355f2e; color:white; height:60px; padding-top:20px;">
            <i class="fa-solid fa-user-check"></i>
            LOGIN SUCCESSFUL 
        </div>
        <div class="card-body">
            <h2 class="card-title">Selamat datang di Trashbank <?= htmlspecialchars($_SESSION['nama']); ?></h2>
            <h3 class="card-text">Kamu mau apa?</h3><br>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card border-warning">
                        <div class="card-header">Input Sampah</div>
                        <div class="card-body1">
                            <p class="card-text">Masukkan sampahmu sekarang dan tukarkan poinmu!</p>
                            <a href="../input/input.php" class="btn btn-primary">Input Sampah Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-success">
                        <div class="card-header">Kembali ke Home</div>
                        <div class="card-body2">
                            <p class="card-text">Kembali ke halaman utama dan lihat fitur lainnya</p>
                            <a href="../index/index.php" class="btn btn-primary">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-body-secondary">
            "Trash Today, Cash Tomorrow"
        </div>
    </div>
</body>
</html>