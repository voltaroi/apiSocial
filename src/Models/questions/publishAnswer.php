<?php

require_once __DIR__ . '/../../db.php';

function publishAnswer($question, $reponse) {
    global $db;

    if (!isset($_SESSION['id']) || !isset($_SESSION['pseudo'])) {
        return "You are not connected";
    }

    $user_answer = nl2br(htmlspecialchars($reponse));

    $insertAnswer = $db->prepare('INSERT INTO answers(id_author, pseudo_author, id_question, content)VALUE(?, ?, ?, ?)');
    $insertAnswer->execute(array($_SESSION['id'], $_SESSION['pseudo'], $question, $user_answer));

    return "200";
}