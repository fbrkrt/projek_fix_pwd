<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/koneksi.php";

$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = $_POST['pass'];
$remember = isset($_POST['remember']) ? true : false;

$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

if(mysqli_num_rows($query) > 0){
    $data = mysqli_fetch_assoc($query);

    if(password_verify($pass, $data['password'])){
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['email'] = $data['email'];
        
        // Jika Remember Me dicentang
        if($remember){
            // Buat token acak (BUKAN password)
            $token = bin2hex(random_bytes(32));
            
            // Simpan token di database
            mysqli_query($conn, "UPDATE user SET remember_token='$token' WHERE email='$email'");
            
            // Simpan token di cookie (BUKAN password)
            setcookie('remember_email', $email, time() + (30 * 24 * 3600), "/");
            setcookie('remember_token', $token, time() + (30 * 24 * 3600), "/");
        } else {
            // Hapus cookie jika tidak centang
            setcookie('remember_email', '', time() - 3600, "/");
            setcookie('remember_token', '', time() - 3600, "/");
            
            // Hapus token di database
            mysqli_query($conn, "UPDATE user SET remember_token=NULL WHERE email='$email'");
        }
        
        header("Location: berhasil.php");
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Email tidak ditemukan!'); window.location='login.php';</script>";
}
?>