<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include('db.php');

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

$response = [];

if ($username && $password) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if ($password === $user['password']) {
            $response['success'] = true;
            $response['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['name']
            ];
        } else {
            $response['success'] = false;
            $response['message'] = 'Contraseña incorrecta';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Usuario no encontrado';
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = 'Faltan datos';
}

$conn->close();
echo json_encode($response);
?>