<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario']['id'];
    $servicio_id = $_POST['servicio_id'];
    $fecha_cita = $_POST['fecha_cita'] . ' ' . $_POST['hora_cita'];

    $sql = "INSERT INTO citas (usuario_id, servicio_id, fecha_cita) VALUES ('$usuario_id', '$servicio_id', '$fecha_cita')";

    if ($conn->query($sql) === TRUE) {
        echo "Cita confirmada. <a href='Index.php'>Volver a la página principal</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
