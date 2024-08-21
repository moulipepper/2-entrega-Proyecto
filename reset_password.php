<?php
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar el token
    $sql = "SELECT user_id FROM password_reset WHERE token='$token' AND TIMESTAMPDIFF(HOUR, created_at, NOW()) < 24"; // El token es válido por 24 horas
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        // Actualizar la contraseña
        $sql = "UPDATE usuarios SET password='$new_password' WHERE id='$user_id'";
        $conn->query($sql);

        // Eliminar el token usado
        $sql = "DELETE FROM password_reset WHERE token='$token'";
        $conn->query($sql);

        echo "Tu contraseña ha sido actualizada. <a href='Index.php'>Iniciar sesión</a>";
    } else {
        echo "El token de recuperación es inválido o ha expirado.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="forgot_password.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Restablecer Contraseña</h2>
        <form method="post" action="reset_password.php">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Actualizar Contraseña</button>
        </form>
        <button type="button" class="back-btn" onclick="window.location.href='Index.php'">Volver a la página principal</button>
    </div>
</body>
</html>
