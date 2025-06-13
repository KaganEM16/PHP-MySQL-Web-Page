<?php
$servername = "localhost";
$username = "#";
$password = "#";
$database = "#"; 
// Bilgiler gizli olduğundan silinmiştir.

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

$sql = "ALTER TABLE users ADD COLUMN IF NOT EXISTS cart TEXT DEFAULT NULL";
mysqli_query($conn, $sql);
?>