<?php

require_once __DIR__ . '/../../db.php';

function getMyQuestion($userId) {
    global $db;

    if (!$userId || $userId <= 0) {
        return ['error' => 'ID utilisateur invalide'];
    }

    $query = $db->prepare('SELECT id, title, description FROM questions WHERE id_author = ? ORDER BY id DESC');
    $query->execute([$userId]);
    $questions = $query->fetchAll(PDO::FETCH_ASSOC);

    return $questions ?: ['error' => 'Aucune question trouvée'];
}
