<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require 'conn.php';

$sql = "SELECT citas.*, usuarios.nombre, servicios.tipo_servicio 
        FROM citas 
        JOIN usuarios ON citas.usuario_id = usuarios.id 
        JOIN servicios ON citas.servicio_id = servicios.id 
        ORDER BY fecha_cita";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Panel de Administración</h2>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Servicio</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['tipo_servicio']; ?></td>
                    <td><?php echo $row['fecha_cita']; ?></td>
                    <td><?php echo $row['estado']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="Index.php">Volver a la página principal</a>
</body>
</html>
