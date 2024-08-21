<?php
require 'vendor/autoload.php'; // Incluye el autoloader de Composer
require 'conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificar si el email existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Genera un token de recuperación y guárdalo en la base de datos
        $token = bin2hex(random_bytes(16)); // Genera un token seguro

        // Guarda el token en la base de datos
        $sql_token = "INSERT INTO recovery_tokens (email, token) VALUES ('$email', '$token')";
        $conn->query($sql_token);

        // Configura PHPMailer para enviar el email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com'; // Cambia esto por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@example.com'; // Cambia esto por tu dirección de correo
            $mail->Password = 'your-email-password'; // Cambia esto por tu contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // Puerto para TLS

            // Configura el destinatario y el contenido del email
            $mail->setFrom('your-email@example.com', 'Your Name'); // Cambia esto por tu email y nombre
            $mail->addAddress($email);
            $mail->Subject = 'Recuperación de Contraseña';
            $mail->Body = 'Para recuperar tu contraseña, haz clic en el siguiente enlace: 
                            <a href="http://localhost/reset_password.php?token=' . $token . '">Recuperar Contraseña</a>';
            $mail->isHTML(true);

            $mail->send();
            $message = "<p class='success-message'>Se ha enviado un enlace de recuperación a tu email.</p>";
        } catch (Exception $e) {
            $message = "<p class='error-message'>Error al enviar el email: {$mail->ErrorInfo}</p>";
        }
    } else {
        $message = "<p class='error-message'>El email no está registrado.</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="forgot_password.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Recuperar Contraseña</h2>
        <form method="post" action="forgot_password.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Enviar enlace de recuperación</button>
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
