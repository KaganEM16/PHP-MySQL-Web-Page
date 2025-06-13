<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT cart FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$movies = [];
if (!empty($user['cart'])) {
    $movies = json_decode($user['cart'], true);
}

header('Content-Type: application/json');
echo json_encode($movies);
?>