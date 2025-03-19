<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('db.php');

// Aquí debes agregar la lógica para leer el archivo Excel y extraer los datos
// Por simplicidad, asumiremos que los datos ya están en un array

$cheques = [
    [
        'numero' => '5283109',
        'cliente' => 'Mascimino Adriana Gianotti',
        'banco' => 'Standard Bank',
        'importe' => 22000.00,
        'vencimiento' => '2023-01-05',
        'estado' => 'Pendiente'
    ],
    [
        'numero' => '25541',
        'cliente' => 'Boscarol Electricidad S.A.',
        'banco' => 'Nacion Argentina',
        'importe' => 11370.00,
        'vencimiento' => '2024-03-14',
        'estado' => 'Pendiente'
    ]
    // Agrega más cheques según sea necesario
];

foreach ($cheques as $cheque) {
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
    $stmt = $conn->prepare("INSERT INTO cheques (numero, cliente, banco, importe, vencimiento, estado) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siidss", $cheque['numero'], $cliente_id, $banco_id, $cheque['importe'], $cheque['vencimiento'], $cheque['estado']);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

echo json_encode(['success' => true]);
?>