<?php
$server = 'localhost:3306';       
$username = 'root';     
$password = '';              
$database = 'estacionamiento de motos itmina'; // nombre exacto de tu base de datos

try {
    $con = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica si el formulario fue enviado mediante POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Asegúrate de que los campos existan
        if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
            $nombre1 = $_POST["usuario"];
            $pwd1 = $_POST["contrasena"];

            // Preparar la consulta SQL para insertar datos
            $sql = "INSERT INTO usuarios (name, password) VALUES (:nombre, :pwd)";

            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre1);
            $stmt->bindParam(':pwd', $pwd1);

            if ($stmt->execute()) {
                echo "Datos almacenados correctamente.";
            } else {
                echo "Error al almacenar los datos.";
            }
        } else {
            echo "Faltan datos del formulario.";
        }
    }
} catch (PDOException $e) {
    die(" Error de conexión: " . $e->getMessage());
}
?>
