<?php
require 'conn.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el email ya existe
    $sql_check = "SELECT * FROM usuarios WHERE email='$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $message = "<p class='error-message'>El email ya está registrado. Por favor, utiliza otro email.</p>";
    } else {
        $sql = "INSERT INTO usuarios (nombre, email, telefono, password) VALUES ('$nombre', '$email', '$telefono', '$password')";

        if ($conn->query($sql) === TRUE) {
            $message = "<p class='success-message'>Registro exitoso. Serás redirigido a la página de inicio.</p>";
            echo "<meta http-equiv='refresh' content='3;url=Index.php'>";
        } else {
            $message = "<p class='error-message'>Error: " . $conn->error . "</p>";
            echo "<meta http-equiv='refresh' content='3'>";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register-container">
        <h2>Registrarse</h2>
        <form method="post" action="register.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Registrarse</button>
            <button type="button" class="back-btn" onclick="window.location.href='Index.php'">Volver a la página principal</button>
        </form>
        <?php if (!empty($message)): ?>
            <div class="message-container">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
