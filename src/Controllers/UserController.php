<?php

require_once __DIR__ . '/../Models/users/login.php';
require_once __DIR__ . '/../Models/users/register.php';
require_once __DIR__ . '/../Models/users/logout.php';
require_once __DIR__ . '/../Models/users/getUserProfile.php';
require_once __DIR__ . '/../Models/users/editProfile.php';

class UserController {
    public function login($pseudo, $password) {
        return login($pseudo, $password);
    }

    public function register($pseudo, $password) {
        return register($pseudo, $password);
    }

    public function logout() {
        return logout();
    }

    public function getUserProfile($id) {
        return getUserProfile($id);
    }

    public function editProfile() {
        return editProfile();
    }
}
