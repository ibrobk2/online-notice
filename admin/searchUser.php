<?php
include '../connection.php';

$searchTerm = $_POST['search'];
$searchTerm = $conn->real_escape_string($searchTerm);

$query = "SELECT * FROM user WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR regid LIKE '%$searchTerm%'";
$result = $conn->query($query);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode(['status' => 'success', 'users' => $users]);
} else {
    echo json_encode(['status' => 'no_results']);
}

$conn->close();
?>
