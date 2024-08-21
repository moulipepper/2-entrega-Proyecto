<?php
session_start();
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario'] = $user;
            header("Location: home.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No se encontró un usuario con ese email.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="Index.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Inicio de sesión</h2>
            <?php if (isset($error)): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="post" action="Index.php">
                <label for="email">Usuario:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Iniciar sesión</button>
                <button type="button" class="google-btn" onclick="window.location.href='google_login.php'">Iniciar sesión con Google</button>
                <button type="button" class="register-btn" onclick="window.location.href='register.php'">¿No tenés cuenta? Regístrate</button>
                <a href="forgot_password.php" class="forgot-password-link">¿Olvidaste tu contraseña?</a>
            </form>
        </div>
    </div>
</body>
</html>
