<?php
session_start();
include "config/koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: user/login.php");
    exit;
}

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM sampah WHERE email='$email' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Sampah - Trashbank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sampah.css">
</head>
<body>
<nav class="nav-full">
    <div class="logo-web">
        <ul>
            <li><img src="../assets/logo.png" alt="logo bank sampah" style="width: 50px;"></li>
            <li><a href="index.php">Trashbank</a></li>
        </ul>
    </div>

    <div class="nav-container">
        <ul>
            <li><a href="index.php" class="garis-bawah">Home</a></li>
            <li><a href="../user/register.php" class="garis-bawah">Registrasi</a></li>
            <li><a href="../hadiah/tukar.php" class="garis-bawah">Rewards</a></li>
            <li><a href="#categories" class="garis-bawah">Categories</a></li>
            <li><a href="./contact.php" class="garis-bawah">Contact</a></li>
            <li><a href="../input/kelola-sampah.php" class="garis-bawah">History</a></li>
            <li><a href="../user/edit-profil.php" class="garis-bawah">Profil</a></li>
        </ul>
    </div>

    <div class="get-started">
        <a href="../index/index.php">Dashboard</a>
    </div>
</nav>


    <div class="container" style="margin-top: 100px; width:1000px;">
        <h1>Riwayat Setor Sampah</h1>
        <a href="input.php" class="btn btn-success mb-3">+ Setor Sampah Baru</a>
        
        <div class="table-responsive">
            <table class="table table-bordered" style="background: #CFBB99; border-radius: 10px;">
                <thead style="background: #354024; color: white;">
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Berat (kg)</th>
                        <th>Poin</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['kategori'] ?></td>
                        <td><?= $row['berat'] ?></td>
                        <td><?= $row['poin'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['lokasi'] ?></td>
                        <td>
                            <a href="edit-sampah.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus-sampah.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data sampah ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (mysqli_num_rows($query) == 0) { ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data sampah</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>