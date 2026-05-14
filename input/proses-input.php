<?php
include "../user/cek-cookie.php";

if(!isset($_SESSION['email'])){
    header("Location: ../user/login.php");
    exit;
}

include '../config/koneksi.php';

if(isset($_POST['confirm'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $berat = (float)$_POST['berat'];
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $poin = $berat * 10;
    
    if ($email != $_SESSION['email']) {
        die("Email tidak sesuai dengan akun yang login!");
    }
    
    mysqli_begin_transaction($conn);
    try {
        $query = "INSERT INTO sampah (nama, email, alamat, kategori, berat, tanggal, lokasi, poin) 
                  VALUES ('$nama', '$email', '$alamat', '$kategori', '$berat', '$tanggal', '$lokasi', '$poin')";
        
        if (!mysqli_query($conn, $query)) {
            throw new Exception(mysqli_error($conn));
        }
        
        mysqli_query($conn, "UPDATE user SET total = IFNULL(total, 0) + $poin WHERE email='$email'");
        mysqli_commit($conn);
        
        unset($_SESSION['temp_sampah']);
        
        header("Location: landing.php?status=success");
        exit;
        
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
    
} elseif(isset($_POST['submit'])) {
    $_SESSION['temp_sampah'] = [
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'alamat' => $_POST['alamat'],
        'kategori' => $_POST['kategori'],
        'berat' => (float)$_POST['berat'],
        'tanggal' => $_POST['tanggal'],
        'lokasi' => $_POST['lokasi']
    ];
    
    header("Location: konfirm.php");
    exit;
    
} else {
    header("Location: landing.php");
    exit;
}
?>