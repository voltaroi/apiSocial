<?php

require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$key = $_ENV['JWT_SECRET'];

if (isset($_COOKIE['auth_token'])) {
    try {
        $decoded = JWT::decode($_COOKIE['auth_token'], new Key($key, 'HS256'));

        $_SESSION['auth'] = true;
        $_SESSION['id'] = $decoded->user_id;
        $_SESSION['pseudo'] = $decoded->pseudo;

    } catch (Exception $e) {
        setcookie("auth_token", "", time() - 3600, "/");
        exit();
    }
} else {
    exit();
}

?>