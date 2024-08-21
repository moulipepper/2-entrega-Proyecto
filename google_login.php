<?php
require 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('580197150165-aqlf3kcce6skl73odsbqs08lmrlu55e8.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/google_callback.php');
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();
header("Location: " . $login_url);
exit();
?>
