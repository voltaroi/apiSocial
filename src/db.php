<?php

$host = 'mysql:dbname=forum;host=localhost';
$username = 'api';
$password = 'gVp0v7nqzz-Zt8bv';

try{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }    
    $db = new PDO($host, $username, $password);
}catch(Exception $e){
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
