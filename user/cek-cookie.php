<?php
// Cek apakah session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika sudah login lewat session, skip
if(isset($_SESSION['email'])){
    return;
}

// Cek apakah ada cookie remember me
if(isset($_COOKIE['remember_token']) && isset($_COOKIE['remember_email'])){
    include "../config/koneksi.php";
    
    $email = mysqli_real_escape_string($conn, $_COOKIE['remember_email']);
    $token = $_COOKIE['remember_token'];
    
    // Gunakan prepared statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        
        // Verifikasi token
        if(password_verify($token, $data['remember_token'])){
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['email'] = $data['email'];
            
            // Perpanjang token (opsional)
            $new_token = bin2hex(random_bytes(32));
            $new_token_hash = password_hash($new_token, PASSWORD_DEFAULT);
            $new_expiry = date('Y-m-d H:i:s', strtotime('+30 days'));
            
            $update_stmt = $conn->prepare("UPDATE user SET remember_token = ?, token_expiry = ? WHERE email = ?");
            $update_stmt->bind_param("sss", $new_token_hash, $new_expiry, $email);
            $update_stmt->execute();
            
            setcookie('remember_token', $new_token, time() + (86400 * 30), "/", "", true, true);
        }
    }
}
?>