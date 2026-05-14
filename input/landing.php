<?php
session_start();
include "../user/cek-cookie.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berhasil Input - Trashbank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

    <section class="success-landing">
        <div class="success-card">
            <div class="success-icon">
                <i class="bi bi-recycle"></i>
                <i class="bi bi-trash3-fill"></i>
                <i class="bi bi-leaf-fill"></i>
            </div>
            
            <?php
            include '../config/koneksi.php';
            
            $data = mysqli_query($conn, "SELECT * FROM sampah ORDER BY id DESC LIMIT 1");
            $row = mysqli_fetch_assoc($data);
            $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : "Pengguna";
            ?>

            <h1>Selamat, <?php echo $nama; ?>! 🎉</h1>
            
            <div class="poin-box">
                <span class="poin-label">Kamu mendapatkan</span>
                <div class="poin-amount"><?php echo $row['poin']; ?> Poin</div>
            </div>
            
            <p class="thanks-message">Terima kasih sudah berkontribusi dalam merawat alam 🌿</p>
            <p class="eco-message">Setiap sampah yang kamu setor membantu menjaga bumi tetap hijau!</p>
            
            <div class="action-buttons">
                <a href="../index/index.php" class="btn-home">
                    <i class="bi bi-house-fill"></i> Kembali ke Home
                </a>

                <a href="../hadiah/tukar.php" class="btn-redeem">
                    <i class="bi bi-gift-fill"></i> Tukar Poin Sekarang
                </a>

                <a href="input.php" class="btn-deposit">
                    <i class="bi bi-trash-fill"></i> Setor Lagi
                </a>
            </div>
        </div>
    </section>
</body>
</html>