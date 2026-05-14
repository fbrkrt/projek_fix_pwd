<?php
include "../user/cek-cookie.php";

if(!isset($_SESSION['email'])){
    header("Location: ../user/login.php");
    exit;
}

if(!isset($_SESSION['temp_sampah'])){
    header("Location: landing.php");
    exit;
}

$data = $_SESSION['temp_sampah'];
$poin = $data['berat'] * 10;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Sampah - Trashbank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sampah.css?v=<?php echo time(); ?>">
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
        <div class="card2">
            <h5 class="card-header">Konfirmasi Data Sampah</h5>
            <div class="card-body">
                <p>Periksa kembali data Anda sebelum disimpan:</p>
                <table class="table">
                    <tr>
                        <td>Nama</th>
                        <td>:</th>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                    </tr>
                    <tr>
                        <td>Email</th>
                        <td>:</th>
                        <td><?php echo htmlspecialchars($data['email']); ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</th>
                        <td>:</th>
                        <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                    </tr>
                    <tr>
                        <td>Kategori</th>
                        <td>:</th>
                        <td><?php echo htmlspecialchars($data['kategori']); ?></td>
                    </tr>
                    <tr>
                        <td>Berat Sampah (kg)</th>
                        <td>:</th>
                        <td><?php echo $data['berat']; ?> kg</td>
                    </tr>
                    <tr>
                        <td>Tanggal Setor</th>
                        <td>:</th>
                        <td><?php echo $data['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</th>
                        <td>:</th>
                        <td><?php echo htmlspecialchars($data['lokasi']); ?></td>
                    </tr>
                    <tr>
                        <td>Poin</th>
                        <td>:</th>
                        <td><strong style="color:green"><?php echo $poin; ?> poin</strong></td>
                    </tr>
                </table>
                
                <form method="POST" action="proses-input.php" style="display: inline;">
                    <input type="hidden" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
                    <input type="hidden" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>">
                    <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($data['kategori']); ?>">
                    <input type="hidden" name="berat" value="<?php echo $data['berat']; ?>">
                    <input type="hidden" name="tanggal" value="<?php echo $data['tanggal']; ?>">
                    <input type="hidden" name="lokasi" value="<?php echo htmlspecialchars($data['lokasi']); ?>">
                    <br>
                    <button type="submit" name="confirm" class="btn btn-primary">✅ Ya, Simpan</button>
                </form>
                <a href="batal.php" class="btn btn-primary">❌ Batal</a>
            </div>
        </div>
    </section>
</body>
</html>