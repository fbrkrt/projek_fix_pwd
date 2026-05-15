<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    
    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        
        if(password_verify($password, $data['password'])) {
            // Buat SESSION
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['email'] = $data['email'];
            
            // Jika centang "Remember Me", buat COOKIE
            if(isset($_POST['remember'])) {
                $token = bin2hex(random_bytes(32));
                
                // Simpan token di database
                $update = mysqli_query($conn, "UPDATE user SET remember_token='$token' WHERE email='$email'");
                
                if($update) {
                    // Buat cookie (berlaku 30 hari)
                    setcookie('remember_email', $email, time() + (86400 * 30), "/");
                    setcookie('remember_token', $token, time() + (86400 * 30), "/");
                }
            }
            
            header("Location: dashboard.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/register-login.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav class="nav-full">
        <div class="logo-web">
            <ul>
                <li><img src="../assets/logo.png" alt="logo bank sampah" style="width: 50px;"></li>
                <li><a href="../index/index.php">Trashbank</a></li>  <!-- PERBAIKAN -->
            </ul>
        </div>

        <div class="nav-container">
            <ul>
                <li><a href="../index/index.php" class="garis-bawah">Home</a></li>  <!-- PERBAIKAN -->
                <li><a href="register.php" class="garis-bawah">Registrasi</a></li>
                <li><a href="../hadiah/tukar.php" class="garis-bawah">Rewards</a></li>
                <li><a href="../index/index.php#categories" class="garis-bawah">Categories</a></li>
                <li><a href="../index/contact.php" class="garis-bawah">Contact</a></li>  <!-- PERBAIKAN -->
                <li><a href="../input/kelola-sampah.php" class="garis-bawah">History</a></li>
                <li><a href="edit-profil.php" class="garis-bawah">Profil</a></li>
            </ul>
        </div>

        <div class="get-started">
            <a href="../index/index.php">Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <h1>LOGIN AKUN</h1>
        
        <form action="proseslogin.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       placeholder="Masukkan alamat email" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" 
                       placeholder="Masukkan password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat Saya (Remember Me)</label>
            </div>
            <button type="submit" class="btn btn-success">LOGIN</button>
            <button type="reset" class="btn btn-secondary">RESET</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
    </div>
</body>
</html>