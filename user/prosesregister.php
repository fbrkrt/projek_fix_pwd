<?php
include "../config/koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$conf = $_POST['confirmpass'];

if($pass != $conf){
    echo "<script>alert('Password tidak sama!'); window.location='register.php';</script>";
    exit;
}

$password_hash = password_hash($pass, PASSWORD_DEFAULT);

$cek = mysqli_query($conn,"SELECT * from user where email='$email'");
if(mysqli_num_rows($cek) > 0){
    header("Location: login.php");
    exit;
}

$query = "INSERT INTO user (nama, email, password) values ('$nama', '$email', '$password_hash')";
if(mysqli_query($conn, $query)){
    header("Location: login.php");
    exit;
}else{
    echo"Regitrasi gagal!";
}
?>