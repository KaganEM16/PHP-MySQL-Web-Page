<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user'])) {
    echo 'not_logged_in';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user']['id'];
    $index = intval($_POST['index']);

    // Kullanıcının sepetinin alınması
    $stmt = $conn->prepare("SELECT cart FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $cart = [];
    if (!empty($user['cart'])) {
        $cart = json_decode($user['cart'], true);
    }
    
    // Seçilen filmin sepetten kaldırılması
    if (isset($cart[$index])) {
        array_splice($cart, $index, 1);
        
        // Sepetin güncellenmesi
        $cart_json = json_encode($cart);
        $update_stmt = $conn->prepare("UPDATE users SET cart = ? WHERE id = ?");
        $update_stmt->bind_param("si", $cart_json, $user_id);
        
        if ($update_stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }

        $update_stmt->close();
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}
?>