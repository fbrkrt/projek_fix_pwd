<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALDO E-WALLET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/hadiah.css">
</head>
<body class="p-4">
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

    <h1>E-Wallet 20.000</h1>

    <form action="landingpoin.php?id=12" method="POST">
        <div class="mb-3">
            <label class="form-label">Pilih E-wallet</label><br>
            <input type="checkbox" class="form-check-input" name="nama" value="dana"  >
            <label class="form-check-label">Dana</label> 
            <input type="checkbox" class="form-check-input" name="nama" value="ovo"  >
            <label class="form-check-label">OVO</label><br>
            <input type="checkbox" class="form-check-input" name="nama" value="gopay"  >
            <label class="form-check-label">GoPay</label> 
            <input type="checkbox" class="form-check-input" name="nama" value="shopeepay"  >
            <label class="form-check-label">Shopeepay</label><br><br>
            <label class="form-label">Nomor</label>
            <input type="number" class="form-control" name="nomor" placeholder="Masukkan nomor yang akan diisi saldo" required>
        </div>
        <button type="submit" class="btn btn-success">Redeem</button>
    </form>
</body>

</html>