<?php
session_start();
include "../user/cek-cookie.php";  // Tambahkan baris ini

// Rest of your code...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Sampah - Trashbank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sampah.css">
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
        <a href="../index/index.php">Dashboard</a>
    </div>
</nav>

    
    <section class="card-info">
        <?php
        include '../config/koneksi.php';
        
        $data = mysqli_query($conn, "SELECT * FROM sampah ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($data);
        ?>
    
    <div class="card2">
        <h5 class="card-header">Detail Input Sampah</h5>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $row['nama'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $row['email'] ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                <td><?php echo $row['alamat'] ?></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td><?php echo $row['kategori'] ?></td>
            </tr>
            <tr>
                <td>Berat Sampah (kg)</td>
                <td>:</td>
                <td><?php echo $row['berat'] . "kg" ?></td>
            </tr>
            <tr>
                <td>Tanggal Setor</td>
                <td>:</td>
                <td><?php echo $row['tanggal'] ?></td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>:</td>
                <td><?php echo $row['lokasi'] ?></td>
            </tr>
        </table>
        <a href="landing.php" class="btn btn-primary">Konfirmasi</a>
    </div>
    </section>
</body>
</html>