<?php

function logout(){
    $_SESSION = [];
    session_destroy();
    setcookie("auth_token", "", time() - 3600, "/");
    return 'disconnected';
}