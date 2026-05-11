<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../user/cek-cookie.php";

if(!isset($_SESSION['email'])){
    header("Location: ../user/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Sampah - Trashbank</title>
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


    <form action="proses-input.php" method="POST" class="form-input" style="margin-top: 100px; max-width: 600px; margin-left: auto; margin-right: auto;">
        <div class="judul-form text-center mb-4">
            <h2>Input Sampah</h2>
            <p>Silakan isi detail sampah yang akan disetorkan</p>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($_SESSION['nama'] ?? '') ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" required>
        </div>
        
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Sampah</label>
            <select name="kategori" id="kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Sampah Plastik">Sampah Plastik</option>
                <option value="Sampah Kertas">Sampah Kertas</option>
                <option value="Sampah Logam">Sampah Logam</option>
                <option value="Sampah Kaca">Sampah Kaca</option>
                <option value="Sampah Organik">Sampah Organik</option>
                <option value="Sampah Elektronik">Sampah Elektronik</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="berat" class="form-label">Berat Sampah (kg)</label>
            <input type="number" class="form-control" id="berat" name="berat" placeholder="Masukkan berat sampah" required onchange="hitungPoin()">
            <small class="text-muted">1 kg = 10 Poin</small>
        </div>
        
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Setor</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Lokasi Cabang</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="lokasi" value="Bank Sampah A" required>
                <label class="form-check-label">Bank Sampah A</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="lokasi" value="Bank Sampah B">
                <label class="form-check-label">Bank Sampah B</label>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck1" required>
            <label class="form-check-label" for="gridCheck1">
                Saya setuju dengan syarat dan ketentuan yang berlaku
            </label>
        </div>
        
        <div class="subres text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>

    <script>
        function hitungPoin() {
            let berat = document.getElementById('berat').value;
            let poin = berat * 10;
            document.getElementById('poin').value = poin;
        }
    </script>
</body>
</html>