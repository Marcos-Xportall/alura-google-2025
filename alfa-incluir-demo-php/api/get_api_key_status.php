<?php
// api/get_api_key_status.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');

$is_set = isset($_SESSION['user_gemini_api_key']) && !empty(trim($_SESSION['user_gemini_api_key']));

echo json_encode(['is_set' => $is_set]);
?>