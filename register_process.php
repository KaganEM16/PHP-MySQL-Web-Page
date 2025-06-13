<?php
session_start();
include 'database.php'; // Veritabanına bağlantı dosyam

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Şifreyi hashleme kodu

// Veritabanında aynı kullanıcı adı veya e-posta olmasının kontrolü
$check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
if (mysqli_num_rows($check) > 0) {
    header("Location: register.php?error=1");
    exit();
}

// Kayıt işlemi
$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
if (mysqli_query($conn, $query)) {
    $_SESSION['username'] = $username;
    header("Location: index.php"); // Kayıttan sonra ana sayfaya gidilmesi için
    exit();
} else {
    header("Location: register.php?error=2");
    exit();
}
?>