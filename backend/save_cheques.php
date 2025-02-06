<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include('db.php');

$data = json_decode(file_get_contents('php://input'), true);

$response = [];

if (is_array($data)) {
    $stmt = $conn->prepare("INSERT INTO cheques (numero, cliente, banco, importe, vencimiento, estado) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $numero, $cliente, $banco, $importe, $vencimiento, $estado);

    foreach ($data as $cheque) {
        $numero = $cheque['numero'] ?? '';
        $cliente = $cheque['cliente'] ?? '';
        $banco = $cheque['banco'] ?? '';
        $importe = $cheque['importe'] ?? 0;
        $vencimiento = $cheque['vencimiento'] ?? '';
        $estado = $cheque['estado'] ?? '';

        if (!$stmt->execute()) {
            $response['error'] = "Error: " . $stmt->error;
            echo json_encode($response);
            exit();
        }
    }
    $response['success'] = "Datos guardados con éxito";
    $stmt->close();
} else {
    $response['error'] = "Datos inválidos";
}

$conn->close();
echo json_encode($response);
?>