<?php
include "../config/koneksi.php";
session_start();
include "../user/cek-cookie.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../user/login.php");
    exit;
}

$email = $_SESSION['email'];

// ambil data user
$qUser = "SELECT nama, total FROM user WHERE email = '$email'";
$rUser = mysqli_query($conn, $qUser);
$dataUser = mysqli_fetch_assoc($rUser);

$nama = $dataUser['nama'];
$total = $dataUser['total'];

// tampilkan hadiah
$query = "SELECT * FROM hadiah";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukar Poin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <li><a href="tukar.php" class="garis-bawah">Rewards</a></li>
                <li><a href="../index/index.php#categories" class="garis-bawah">Categories</a></li>
                <li><a href="./contact.php" class="garis-bawah">Contact</a></li>
                <li><a href="../input/kelola-sampah.php" class="garis-bawah">History</a></li>
                <li><a href="../user/edit-profil.php" class="garis-bawah">Profil</a></li>
            </ul>
        </div>

        <div class="get-started">
            <a href="../input/input.php">Get Started</a>
        </div>
    </nav>

    <div class="jumlah">
        <h1>Jumlah poin <?= $nama ?> adalah <?= $total ?> poin</h1>
    </div>

    <div class="hadiah"> 
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card mb-3" >
                <div class="card-body">
                    <h5 class="card-title"><?= $row['nama_hadiah'] ?></h5>
                    <h5 class="card-title">Poin <?= $row['poin'] ?></h5>
                    <a href="prosesreedem.php?id=<?= $row['id_hadiah'] ?>" class="btn btn-primary">REDEEM NOW!</a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>