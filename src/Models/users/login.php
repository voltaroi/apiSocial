<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Dotenv\Dotenv;

function login($pseudo, $password){
    global $db;

    $dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
    $dotenv->load();
    $key = $_ENV['JWT_SECRET'];
    $user_pseudo = $pseudo;
    $user_password = $password;

    $checkIfUserExists = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
    $checkIfUserExists->execute(array($user_pseudo));

    if($checkIfUserExists->rowCount() > 0){

        $usersInfos = $checkIfUserExists->fetch();
        if(password_verify($user_password, $usersInfos['password'])){

            $payload = [
                "user_id" => $usersInfos['id'],
                "pseudo" => $usersInfos['pseudo'],
                "exp" => time() + (60 * 60)
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');

            setcookie("auth_token", $jwt, time() + (60 * 60), "/", "", false, true);

            return $jwt;

        } else {
            $errorMsg = "Mot de passe incorrect";
        }

    } else {
        $errorMsg = "Pseudo incorrect";
    }
}

?>
