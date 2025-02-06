<?php
$servername = "localhost";  // Nombre del servidor, si estás usando XAMPP es localhost
$username = "root";         // Tu nombre de usuario de MySQL, por defecto es root
$password = "";             // Tu contraseña de MySQL, por defecto está vacía
$dbname = "cyv";            // Nombre de la base de datos que creaste en phpMyAdmin

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos!";
}
?>