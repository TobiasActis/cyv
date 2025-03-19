<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('db.php');

$sql = "
    SELECT 
        cheques.id, 
        cheques.numero, 
        clientes.nombre AS cliente, 
        bancos.nombre AS banco, 
        cheques.importe, 
        DATE_FORMAT(cheques.vencimiento, '%d/%m/%Y') AS vencimiento, 
        DATE_FORMAT(cheques.fecha_ingreso, '%d/%m/%Y') AS fecha_ingreso, 
        cheques.estado 
    FROM cheques
    JOIN clientes ON cheques.cliente = clientes.id
    JOIN bancos ON cheques.banco = bancos.id
";
$result = $conn->query($sql);

$cheques = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cheques[] = $row;
    }
}

$conn->close();

echo json_encode($cheques);
?>