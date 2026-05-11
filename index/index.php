<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trashbank</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/index.css">
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
        <a href="../input/input.php">Get Started</a>
    </div>
</nav>

<section class="awalan-web">
    <div class="text-index">
        <h1>Turn Waste Into Rewards🌿</h1>
    </div>

    <div>
        <a href="../input/input.php">Deposit Waste</a>
    </div>
</section>

<section id="categories" class="categories">
    <h3 class="section-title">Recycle Guide</h3>
    <p class="text-center">Kategori Sampah dan Bentuk Daur Ulang</p>

    <div class="d-flex gap- flex-wrap">

        <div class="card">
            <img src="../assets/sampah-plastik.jpg" class="card-img-top">
            <div class="card-body">
                <h6>Sampah Plastik</h6>
                <p>Botol dan kemasan plastik yang bisa didaur ulang.</p>
                <a href="#popup-plastik" class="btn-card">Lihat Detail</a>
            </div>
        </div>

        <div class="card">
            <img src="../assets/sampah-kertas.jpg" class="card-img-top">
            <div class="card-body">
                <h6>Sampah Kertas</h6>
                <p>Kertas dan kardus bekas yang dapat diolah kembali.</p>
                <a href="#popup-kertas" class="btn-card">Lihat Detail</a>
            </div>
        </div>

        <div class="card">
            <img src="../assets/sampah-logam.jpg" class="card-img-top">
            <div class="card-body">
                <h6>Sampah Logam</h6>
                <p>Kaleng dan besi bekas bernilai jual tinggi.</p>
                <a href="#popup-logam" class="btn-card">Lihat Detail</a>
            </div>
        </div>

        <div class="card">
            <img src="../assets/sampah-kaca.jpg" class="card-img-top">
            <div class="card-body">
                <h6>Sampah Kaca</h6>
                <p>Botol kaca yang dapat dibentuk ulang.</p>
                <a href="#popup-kaca" class="btn-card">Lihat Detail</a>
            </div>
        </div>

        <div class="card">
            <img src="../assets/sampah-organik.jpg" class="card-img-top">
            <div class="card-body">
                <h6>Sampah Organik</h6>
                <p>Sisa makanan dan daun untuk kompos.</p>
                <a href="#popup-organik" class="btn-card">Lihat Detail</a>
            </div>
        </div>

        <div class="card">
            <img src="../assets/sampah-elektronik.jpg" class="card-img-top">
            <div class="card-body">
                <h6>Sampah Elektronik</h6>
                <p>HP, kabel, dan baterai bekas khusus.</p>
                <a href="#popup-elektronik" class="btn-card">Lihat Detail</a>
            </div>
        </div>

    </div>
</section>

<!-- POPUP PLASTIK -->
<div id="popup-plastik" class="popup">
    <a href="#!" class="popup-bg"></a>
    <div class="popup-box">
        <a href="#!" class="close">&times;</a>
        <h3>Sampah Plastik</h3>
        <p>
        Jenis: Botol minum, kantong plastik, kemasan makanan<br><br>
        Cara Daur Ulang:<br>
        - Cuci bersih dari sisa makanan/minuman<br>
        - Lepas label jika memungkinkan<br>
        - Keringkan sebelum disetor<br><br>
        Tips:<br>
        Jangan campur plastik kotor karena bisa menurunkan nilai daur ulang.
        </p>
    </div>
</div>

<!-- POPUP KERTAS -->
<div id="popup-kertas" class="popup">
    <a href="#!" class="popup-bg"></a>
    <div class="popup-box">
        <a href="#!" class="close">&times;</a>
        <h3>Sampah Kertas</h3>
        <p>
        Jenis: Kertas HVS, kardus, koran<br><br>
        Cara Daur Ulang:<br>
        - Pastikan kering<br>
        - Lipat atau ikat rapi<br>
        - Pisahkan dari kertas berminyak<br><br>
        Tips:<br>
        Kertas yang bersih punya nilai jual lebih tinggi.
        </p>
    </div>
</div>

<!-- POPUP LOGAM -->
<div id="popup-logam" class="popup">
    <a href="#!" class="popup-bg"></a>
    <div class="popup-box">
        <a href="#!" class="close">&times;</a>
        <h3>Sampah Logam</h3>
        <p>
        Jenis: Kaleng minuman, besi, aluminium<br><br>
        Cara Daur Ulang:<br>
        - Bersihkan dari sisa isi<br>
        - Pipihkan jika bisa<br><br>
        Tips:<br>
        Logam termasuk sampah dengan nilai tinggi 💰
        </p>
    </div>
</div>

<!-- POPUP KACA -->
<div id="popup-kaca" class="popup">
    <a href="#!" class="popup-bg"></a>
    <div class="popup-box">
        <a href="#!" class="close">&times;</a>
        <h3>Sampah Kaca</h3>
        <p>
        Jenis: Botol kaca, toples<br><br>
        Cara Daur Ulang:<br>
        - Pisahkan berdasarkan warna (bening, hijau, coklat)<br>
        - Cuci bersih<br><br>
        Tips:<br>
        Hati-hati pecahan kaca, gunakan sarung tangan.
        </p>
    </div>
</div>

<!-- POPUP ORGANIK -->
<div id="popup-organik" class="popup">
    <a href="#!" class="popup-bg"></a>
    <div class="popup-box">
        <a href="#!" class="close">&times;</a>
        <h3>Sampah Organik</h3>
        <p>
        Jenis: Sisa makanan, daun, kulit buah<br><br>
        Cara Daur Ulang:<br>
        - Bisa dijadikan kompos<br>
        - Simpan di wadah tertutup<br><br>
        Tips:<br>
        Jangan campur dengan plastik atau logam.
        </p>
    </div>
</div>

<!-- POPUP ELEKTRONIK -->
<div id="popup-elektronik" class="popup">
    <a href="#!" class="popup-bg"></a>
    <div class="popup-box">
        <a href="#!" class="close">&times;</a>
        <h3>Sampah Elektronik</h3>
        <p>
        Jenis: HP rusak, kabel, baterai<br><br>
        Cara Daur Ulang:<br>
        - Jangan dibuang sembarangan<br>
        - Bawa ke tempat e-waste khusus<br><br>
        Tips:<br>
        Mengandung bahan berbahaya ⚠️
        </p>
    </div>
</div>

<section class="akhiran">
    <h3>Deposit Your Waste Today!</h3>
    <a href="input.php">Deposit Now</a>

    <div class="akhir-container">
        <div class="footer-bottom">
            <p><?php echo date("Y"); ?> Trashbank. All rights reserved.</p>
        </div>
    </div>
</section>

</body>
</html>