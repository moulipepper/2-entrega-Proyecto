<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
require 'conn.php';

$sql = "SELECT * FROM servicios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Servicio</title>
    <link rel="stylesheet" href="seleccionar_servicio.css">
</head>
<body>
    <h2>Seleccionar Servicio</h2>
    <form action="seleccionar_fecha_horario.php" method="post">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div>
                <input type="radio" id="servicio_<?php echo $row['id']; ?>" name="servicio_id" value="<?php echo $row['id']; ?>" required>
                <label for="servicio_<?php echo $row['id']; ?>"><?php echo $row['tipo_servicio']; ?> - $<?php echo $row['precio']; ?></label>
            </div>
        <?php endwhile; ?>
        <button type="submit">Seleccionar</button>
    </form>
    <a href="home.php">Volver a la página principal</a>
</body>
</html>
