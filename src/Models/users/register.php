<?php

require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Dotenv\Dotenv;

function register($pseudo, $password) {
    global $db;

    $dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
    $dotenv->load();
    $key = $_ENV['JWT_SECRET'];

    $user_pseudo = $pseudo;
    $user_password = password_hash($password, PASSWORD_BCRYPT);


    $checkIfUserAlreadyExist = $db->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
    $checkIfUserAlreadyExist->execute(array($user_pseudo));

    if ($checkIfUserAlreadyExist->rowCount() == 0) {

        $inserUserOnWebsite = $db->prepare('INSERT INTO users(pseudo, password) VALUES(?, ?)');
        if ($inserUserOnWebsite->execute(array($user_pseudo, $user_password))) {

            $getInfosOfThisUserReq = $db->prepare('SELECT id, pseudo FROM users WHERE pseudo = ?');
            $getInfosOfThisUserReq->execute(array($user_pseudo));

            $usersInfos = $getInfosOfThisUserReq->fetch();

            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['pseudo'] = $usersInfos['pseudo'];

            $payload = [
                "user_id" => $usersInfos['id'],
                "pseudo" => $usersInfos['pseudo'],
                "exp" => time() + (60 * 60)
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');

            setcookie("auth_token", $jwt, time() + (60 * 60), "/", "", false, true);

            return $jwt;
        } else {
            return "Erreur lors de l'insertion de l'utilisateur";
        }
    } else {
        return "L'utilisateur existe déjà";
    }
}
