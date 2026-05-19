<?php
session_start();
include "../config/koneksi.php";
include "../user/cek-cookie.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/sampah.css">
    <link rel="stylesheet" href="../css/edit-sampah.css?v=<?php echo time(); ?>">
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
                <li><a href="kelola-sampah.php" class="garis-bawah">History</a></li>
                <li><a href="../user/edit-profil.php" class="garis-bawah">Profil</a></li>
            </ul>
        </div>

        <div class="get-started">
            <a href="../user/logout.php">Logout</a>
        </div>
    </nav>

    <form action="update-sampah.php" method="POST" class="form-input">
        <div class="judul-form">
            <label><i class="fas fa-edit"></i> Edit Data Sampah</label>
            <label>Silakan ubah detail sampah di bawah ini</label>
        </div>

        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="poin_lama" value="<?= $data['poin'] ?>">

        <!-- Nama -->
        <div class="row">
            <div class="col-label">
                <label>Nama Lengkap</label>
            </div>
            <div class="col-input">
                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>
        </div>

        <!-- Email -->
        <div class="row">
            <div class="col-label">
                <label>Email</label>
            </div>
            <div class="col-input">
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($data['email']) ?>" readonly>
            </div>
        </div>

        <!-- Alamat -->
        <div class="row">
            <div class="col-label">
                <label>Alamat</label>
            </div>
            <div class="col-input">
                <input type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required>
            </div>
        </div>

        <!-- Kategori -->
        <div class="row">
            <div class="col-label">
                <label>Kategori Sampah</label>
            </div>
            <div class="col-input">
                <select name="kategori" class="form-control" required>
                    <option value="Sampah Plastik" <?= $data['kategori'] == 'Sampah Plastik' ? 'selected' : '' ?>>Sampah Plastik</option>
                    <option value="Sampah Kertas" <?= $data['kategori'] == 'Sampah Kertas' ? 'selected' : '' ?>>Sampah Kertas</option>
                    <option value="Sampah Logam" <?= $data['kategori'] == 'Sampah Logam' ? 'selected' : '' ?>>Sampah Logam</option>
                    <option value="Sampah Kaca" <?= $data['kategori'] == 'Sampah Kaca' ? 'selected' : '' ?>>Sampah Kaca</option>
                    <option value="Sampah Organik" <?= $data['kategori'] == 'Sampah Organik' ? 'selected' : '' ?>>Sampah Organik</option>
                    <option value="Sampah Elektronik" <?= $data['kategori'] == 'Sampah Elektronik' ? 'selected' : '' ?>>Sampah Elektronik</option>
                </select>
            </div>
        </div>

        <!-- Berat -->
        <div class="row">
            <div class="col-label">
                <label>Berat Sampah (kg)</label>
            </div>
            <div class="col-input">
                <input type="number" class="form-control" name="berat" id="berat" value="<?= $data['berat'] ?>" required onchange="hitungPoin()" step="0.1">
                <small class="text-muted">1 kg = 10 Poin</small>
            </div>
        </div>

        <!-- Poin -->
        <div class="row">
            <div class="col-label">
                <label>Poin (otomatis)</label>
            </div>
            <div class="col-input">
                <input type="number" class="form-control" name="poin" id="poin" value="<?= $data['poin'] ?>" readonly>
            </div>
        </div>

        <!-- Tanggal -->
        <div class="row">
            <div class="col-label">
                <label>Tanggal Setor</label>
            </div>
            <div class="col-input">
                <input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>" required>
            </div>
        </div>

        <!-- Lokasi -->
        <div class="row">
            <div class="col-label">
                <label>Lokasi Cabang</label>
            </div>
            <div class="col-input">
                <div class="radio-group-custom">
                    <label class="radio-custom" style="display: flex; flex-direction: row;">
                        <input type="radio" name="lokasi" value="Bank Sampah A" <?= ($data['lokasi'] == 'Bank Sampah A') ? 'checked' : '' ?>>
                        <span class="radio-btn"></span>
                        Bank Sampah A
                    </label>
                    <label class="radio-custom" style="display: flex; flex-direction: row;">
                        <input type="radio" name="lokasi" value="Bank Sampah B" <?= ($data['lokasi'] == 'Bank Sampah B') ? 'checked' : '' ?>>
                        <span class="radio-btn"></span>
                        Bank Sampah B
                    </label>
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="subres">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="kelola-sampah.php" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>

    <script>
        function hitungPoin() {
            let berat = document.getElementById('berat').value;
            let poin = parseFloat(berat) * 10;
            if (!isNaN(poin)) {
                document.getElementById('poin').value = poin;
            } else {
                document.getElementById('poin').value = 0;
            }
        }
    </script>
</body>
</html>