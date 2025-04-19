<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../db/config.php';

$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

$stmt = $conn->prepare("SELECT car_id, name FROM cars WHERE name LIKE ?");
$likeTerm = "%$searchTerm%";
$stmt->bind_param("s", $likeTerm);

$stmt->execute();
$result = $stmt->get_result();
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$stmt->close();
$conn->close();
?>