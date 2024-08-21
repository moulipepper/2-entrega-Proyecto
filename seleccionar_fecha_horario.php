<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servicio_id = $_POST['servicio_id'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Fecha y Horario</title>
    <link rel="stylesheet" href="seleccionar_fecha_horario.css">
</head>
<body>
    <h2>Seleccionar Fecha y Horario</h2>
    <form action="confirmacion.php" method="post">
        <input type="hidden" name="servicio_id" value="<?php echo $servicio_id; ?>">
        <label for="fecha_cita">Fecha:</label>
        <input type="date" id="fecha_cita" name="fecha_cita" required>
        <label for="hora_cita">Hora:</label>
        <input type="time" id="hora_cita" name="hora_cita" required>
        <button type="submit">Confirmar</button>
    </form>
    <a href="seleccionar_servicio.php">Volver a seleccionar servicio</a>
</body>
</html>
