<?php
require_once __DIR__ . '/../db/config.php';

session_start();

function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function isMainAdmin() {
    return isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'main_admin';
}

if (!isLoggedIn() || !isMainAdmin()) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $stmt = $conn->prepare("SELECT password FROM admins WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['admin_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if (!$admin || !password_verify($data['admin_password'], $admin['password'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid admin password']);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO admins (username, password, role) VALUES (?, ?, 'co_admin')");
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("ss", $data['username'], $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Username already exists or error occurred']);
    }
}
?>