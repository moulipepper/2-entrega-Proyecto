<?php
require 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('580197150165-aqlf3kcce6skl73odsbqs08lmrlu55e8.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/google_callback.php');
$client->addScope('email');
$client->addScope('profile');

if (!isset($_GET['code'])) {
    // Si no hay código en la URL, redirige al usuario para autenticarse con Google
    $auth_url = $client->createAuthUrl();
    header('Location: ' . $auth_url);
    exit();
} else {
    // Si hay un código, intercámbialo por un token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth2 = new Google_Service_Oauth2($client);
    $google_user_info = $oauth2->userinfo->get();

    // Verifica si el usuario ya existe en tu base de datos
    $email = $google_user_info->email;

    require 'conn.php';
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['usuario'] = $user;
        header("Location: home.php");
        exit();
    } else {
        // Si el usuario no existe, podrías registrar al usuario o mostrar un error
        echo "No se encontró un usuario con ese email.";
    }

    $conn->close();
}
?>
