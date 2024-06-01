<?php
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto si tienes una contraseña para tu usuario root
$dbname = "laboratorio";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consulta protegida contra SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login exitoso!";
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    $stmt->close();
} else {
    echo "Por favor, complete ambos campos.";
}

$conn->close();
?>
