<?php
session_start();
include "config/koneksi.php";
include "user/cek-cookie.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM sampah WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='kelola_sampah.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sampah - Trashbank</title>
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

    <form action="update-sampah.php" method="POST" class="form-input" style="margin-top: 100px;">
        <div class="judul-form">
            <label>Edit Data Sampah</label>
            <label>Silakan ubah detail sampah</label>
        </div>

        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="poin_lama" value="<?= $data['poin'] ?>">

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="alamat" value="<?= $data['alamat'] ?>" required>
            </div>
        </div>

        <div class="option-form">
            <label>Kategori Sampah</label>
            <select name="kategori" required>
                <option value="Sampah Plastik" <?= $data['kategori'] == 'Sampah Plastik' ? 'selected' : '' ?>>Sampah Plastik</option>
                <option value="Sampah Kertas" <?= $data['kategori'] == 'Sampah Kertas' ? 'selected' : '' ?>>Sampah Kertas</option>
                <option value="Sampah Logam" <?= $data['kategori'] == 'Sampah Logam' ? 'selected' : '' ?>>Sampah Logam</option>
                <option value="Sampah Kaca" <?= $data['kategori'] == 'Sampah Kaca' ? 'selected' : '' ?>>Sampah Kaca</option>
                <option value="Sampah Organik" <?= $data['kategori'] == 'Sampah Organik' ? 'selected' : '' ?>>Sampah Organik</option>
                <option value="Sampah Elektronik" <?= $data['kategori'] == 'Sampah Elektronik' ? 'selected' : '' ?>>Sampah Elektronik</option>
            </select>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Berat Sampah (kg)</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="berat" id="berat" value="<?= $data['berat'] ?>" required onchange="hitungPoin()">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Poin (otomatis)</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="poin" id="poin" value="<?= $data['poin'] ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tanggal Setor</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-5">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="lokasi" value="Bank Sampah A" <?= $data['lokasi'] == 'Bank Sampah A' ? 'checked' : '' ?>>
                    <label class="form-check-label">Bank Sampah A</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="lokasi" value="Bank Sampah B" <?= $data['lokasi'] == 'Bank Sampah B' ? 'checked' : '' ?>>
                    <label class="form-check-label">Bank Sampah B</label>
                </div>
            </div>
        </div>

        <div class="subres">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="kelola-sampah.php" class="btn btn-secondary">Batal</a>
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