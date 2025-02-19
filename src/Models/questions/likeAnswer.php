<?php

require_once __DIR__ . '/../../db.php';

function likeAnswer($answer_id) {
    global $db;

    if (!isset($_SESSION['id'])) {
        return "You are not connected";
    }

    if (isset($_answer_id) && isset($_SESSION['id'])) {

        $user_id = $_SESSION['id'];

        $checkLike = $db->prepare("SELECT * FROM tolike WHERE id_answert = ? AND id_user = ?");
        $checkLike->execute([$answer_id, $user_id]);

        if ($checkLike->rowCount() > 0) {
            $deleteLike = $db->prepare("DELETE FROM tolike WHERE id_answert = ? AND id_user = ?");
            $deleteLike->execute([$answer_id, $user_id]);
        } else {
            $addLike = $db->prepare("INSERT INTO tolike (id_answert, id_user) VALUES (?, ?)");
            $addLike->execute([$answer_id, $user_id]);
        }

        return "200";
    }
}
?>
