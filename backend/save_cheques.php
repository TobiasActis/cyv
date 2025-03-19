<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Responder a las solicitudes OPTIONS
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data)) {
    echo json_encode(['error' => 'No data received']);
    exit;
}

foreach ($data as $cheque) {
    // Insertar cliente si no existe
    $stmt = $conn->prepare("INSERT INTO clientes (nombre) VALUES (?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
    $stmt->bind_param("s", $cheque['cliente']);
    $stmt->execute();
    $cliente_id = $stmt->insert_id;
    $stmt->close();

    // Insertar banco si no existe
    $stmt = $conn->prepare("INSERT INTO bancos (nombre) VALUES (?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
    $stmt->bind_param("s", $cheque['banco']);
    $stmt->execute();
    $banco_id = $stmt->insert_id;
    $stmt->close();

    // Insertar cheque
    $stmt = $conn->prepare("INSERT INTO cheques (numero, cliente, banco, importe, vencimiento, fecha_ingreso, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siidsss", $cheque['numero'], $cliente_id, $banco_id, $cheque['importe'], $cheque['vencimiento'], $cheque['fecha_ingreso'], $cheque['estado']);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

echo json_encode(['success' => true]);
?>