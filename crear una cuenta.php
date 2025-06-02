<?php
$server = 'localhost:3306';
$username = 'root';
$password = '';
$database = 'estacionamiento de motos itmina';

try {
    // Conexión con PDO
    $con = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar que el formulario fue enviado por método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar que todos los campos estén presentes
        if (
            !empty($_POST["nombre"]) &&
            !empty($_POST["apellido_paterno"]) &&
            !empty($_POST["apellido_materno"]) &&
            !empty($_POST["numero_control"]) &&
            !empty($_POST["edad"]) &&
            !empty($_POST["correo"])
        ) {
            // Obtener valores del formulario
            $nombre = $_POST["nombre"];
            $apellido_paterno = $_POST["apellido_paterno"];
            $apellido_materno = $_POST["apellido_materno"];
            $numero_control = $_POST["numero_control"];
            $edad = $_POST["edad"];
            $correo = $_POST["correo"];

            // Consulta preparada
            $sql = "INSERT INTO `crear una cuenta`
                        (nombre, apellido_paterno, apellido_materno, num_control, edad, `correo electrónico`)
                        VALUES (:nombre, :apellido_paterno, :apellido_materno, :numero_control, :edad, :correo)";

            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido_paterno', $apellido_paterno);
            $stmt->bindParam(':apellido_materno', $apellido_materno);
            $stmt->bindParam(':numero_control', $numero_control);
            $stmt->bindParam(':edad', $edad);
            $stmt->bindParam(':correo', $correo);

            // Ejecutar y verificar si se insertó
            if ($stmt->execute()) {
                echo "Cuenta creada exitosamente.";
            } else {
                echo "Hubo un error al crear la cuenta.";
            }
        } else {
            echo " Faltan campos obligatorios.";
        }
    }
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>