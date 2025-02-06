<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('db.php');

$sql = "SELECT * FROM cheques";
$result = $conn->query($sql);

$cheques = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cheques[] = $row;
    }
} else {
    echo json_encode(['mensaje' => 'No se encontraron cheques']);
    exit();
}

echo json_encode($cheques);

$conn->close();
?>