<?php

require_once __DIR__ . '/../../db.php';

function getQuestionContentById($id) {
    global $db;

    if (!$id || $id <= 0) {
        return "400";
    }

    $query = $db->prepare('SELECT * FROM questions WHERE id = ?');
    $query->execute([$id]);

    if ($query->rowCount() > 0) {
        return $query->fetch();
    } else {
        return "404";
    }
}
