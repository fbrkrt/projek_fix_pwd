<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_POST['email'];
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi password jika diisi
if (!empty($password)) {
    if ($password !== $confirm_password) {
        echo "<script>alert('Password tidak sama!'); window.location='edit_profil.php';</script>";
        exit;
    }
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE user SET nama='$nama', password='$password_hash' WHERE email='$email'";
} else {
    $query = "UPDATE user SET nama='$nama' WHERE email='$email'";
}

if (mysqli_query($conn, $query)) {
    $_SESSION['nama'] = $nama;
    echo "<script>alert('Profil berhasil diupdate!'); window.location='berhasil.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>